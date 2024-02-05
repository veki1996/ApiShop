<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\View\View;
use App\Helpers\FeeHelper;
use App\Helpers\MBRLHelper;
use App\Helpers\RouteHelper;
use Illuminate\Http\Request;
use App\Helpers\CookieHelper;
use App\Helpers\ContentHelper;
use App\Helpers\ProductHelper;
use App\Helpers\CrossellHelper;
use Illuminate\Support\Facades\URL;
use App\Helpers\External\ZohoHelper;
use App\Exceptions\CrossellException;
use App\Helpers\OrderFIllBreakHelper;
use Illuminate\Support\Facades\Cache;

/**
 * Handles routing to pages (index, product, cart, checkout,...)
 */
class PageController extends Controller
{
    public function index(Request $request): View

    {
        // for alozzi.. filter categories only on shop page
        $category = null;
        if (str_contains(URL::current(), '/shop') && $request->input('category')) {
            $category = 'wsa' . $request->input('category');
        }
        
        $products = ProductHelper::getProducts(
            20,
            0,
            $request->input('order'),
            $category,
            MBRLHelper::decode($request->input('mbrl', ''))
        );
        
        if(!str_contains(URL::current(), '/shop'))
        {   
            shuffle($products);
            $products = array_slice($products, 0, 4);
        }

        if ($request->input('q') && str_contains(URL::current(), '/shop')) {
            $query    = strtolower($request->input('q'));
            $products = ProductHelper::searchProducts($query);
        }

        foreach ($products as $i => $product) {
            if (rtrim($product->image, '/') === env('APP_URL')) {
                unset($products[$i]);
            }
        }

        $mostPopular = ProductHelper::getProducts(
            20,
            0,
            $request->input('order'),
            $request->input('category'),
            MBRLHelper::decode($request->input('mbrl', '')),
            null,
            'mostPopular'
        );

        $productOfTheDay = count($products)
            ? $products[array_keys($products)[date('d') % count($products)]]
            : null;

        $sliderImages = ContentHelper::banners() && isset(ContentHelper::banners()[0]) ? ContentHelper::banners() :
            array_map(
                function ($image) {
                    return env('APP_URL') . '/static/slider/' . $image;
                },
                array_diff(
                    scandir(str_replace('/', DIRECTORY_SEPARATOR, app()->basePath('public/static/slider'))),
                    ['.', '..']
                )
            );

        $staticImages = ContentHelper::banners();

        return view(
            str_contains(URL::current(), '/shop') ? 'pages.shop' : 'pages.index',
            compact(
                'products',
                'mostPopular',
                'productOfTheDay',
                'sliderImages',
                'staticImages'
            )
        );
    }


    // production-ready for one template, built using components
    public function product(string $slug, Request $request)
    {
        // external products use slug in the form of 'actual-slug_full-sku'
        $slugParts = explode('_', $slug);
        if (count($slugParts) > 1) {
            $slug = $slugParts[1];
        }

        $product = ProductHelper::getProductFromSlug(
            $slug,
            MBRLHelper::decode($request->input('mbrl', '')),
            $request->input('utm_content'),
            $request->input('utm_pod')
        );
       
        if (!$product) {
            return redirect()->to(route('page.index'));
        }
        
        $feeHelper       = new FeeHelper();
        $bundleProduct   = ($request->input('bundle')) ? ProductHelper::getBundleProduct($request->input('bundle')) : false;
        $propertiesData  = ProductHelper::getProductProperties($product->shortSku);
        $ofbSettings     = OrderFIllBreakHelper::getSettings();
        $subtemplate     =  RouteHelper::setTemplateForProductAndAddParametersToReq($product->subtemplate, $product->hasContent, $request);
        $subtemplate     =  RouteHelper::setTemplateIfDontHaveReqParOrBPsubtemplateAndHasContent($subtemplate, $request);
        $similarProducts = ProductHelper::getSimilarForProduct($product);
        $phoneOrderCode  = $this->setPhoneOrderCode($product->longSku);
        $staticImages    = ContentHelper::banners();
        
        return view(
            'pages.product' ,
            compact(
                'product',
                'propertiesData',
                'subtemplate',
                'similarProducts',
                'ofbSettings',
                'bundleProduct',
                'staticImages',
                'feeHelper',
                'phoneOrderCode'
            )
        );
    }

    public function cart(Request $request): View
    {
        if (!Cache::has('upsell-product') || request()->input('no-cache') == "true") {
            (new ZohoHelper())->fetchUpsellProduct();
        }

        $upsellProduct = (object)Cache::get('upsell-product');

        if (!Cache::has('contact-info') || request()->input('no-cache') == "true") {
            (new ZohoHelper())->fetchContactInfo();
        }

        $feeHelper       = new FeeHelper();
        $similarProducts = ProductHelper::getProducts();
       
       
        return view(
            'pages.cart',
            compact(
                'upsellProduct',
                'feeHelper',
                'similarProducts'
            )
        );
    }

    public function checkout(Request $request): View
    {
        $surpriseProduct = ProductHelper::getSurpriseProduct();
        $ofbSettings     = OrderFIllBreakHelper::getSettings();
        $customerData    = CookieHelper::getCookies();
        $feeHelper       = new FeeHelper();

        return view(
            'pages.checkout',
            compact(
                'feeHelper',
                'ofbSettings',
                'surpriseProduct',
                'customerData'
            )
        );
    }

    public function thanks(Request $request): View
    {
        $similarProducts = ProductHelper::getProducts();
        return view('pages.thanks',compact('similarProducts'));
    }

    public function tos(string $link, Request $request): View
    {
        $tosData = ContentHelper::tosLinks()[$link]['link'] ?? null;

        try {
            $tosData = file_get_contents($tosData);
        } catch (Exception $exception) {
            $tosData = '';
        }

        $sliderImages = ContentHelper::banners() && isset(ContentHelper::banners()[0]) ? ContentHelper::banners() :
            array_map(
                function ($image) {
                    return env('APP_URL') . '/static/slider/' . $image;
                },
                array_diff(
                    scandir(str_replace('/', DIRECTORY_SEPARATOR, app()->basePath('public/static/slider'))),
                    ['.', '..']
                )
            );
        return view('pages.tos',compact('sliderImages','tosData'));
    }


    public function crossell(Request $request)
    {
        $cacheKey = "crossell-data-" . env('APP_URL');
        try {
            $ch = new CrossellHelper($cacheKey);
        } catch (CrossellException $e) {
            return redirect()->route('page.thanks');
        }
        $products        = $ch->products;
        $crossellType    = $ch->type;

        if (!is_file(resource_path('/views/pages/crossells/' . $crossellType . '.blade.php'))) {
            return redirect()->route('page.thanks');
        }

        $similarProducts = ProductHelper::getProducts();
        $feeHelper       = new FeeHelper();

        return view('pages.crossells.' . $crossellType,compact('similarProducts','feeHelper','products'));
    }

    private function setProductsImages($products)
    {
        foreach ($products as $product) {
            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/" . $product['mainImage']));

            if (!is_file($imagePath)) {
                $stored = @file_put_contents($imagePath, file_get_contents("https://zoho-site.com/" . $product['mainImage']));
            }
        }
    }

    public function about(Request $request)
    {
        return view('pages.about');
    }

    public function getProducts(Request $request)
    {
        $categories = $request->input('categories') ?? null;
        $offset = $request->input('offset') ?? 0;

        $products = ProductHelper::getProducts(
            20,
            $offset,
            $request->input('order'),
            $categories,
            MBRLHelper::decode($request->input('mbrl', ''))
        );

        return $products;
    }

    public function blog(string $slug, Request $request)
    {
        // external products use slug in the form of 'actual-slug_full-sku'
        $slugParts = explode('_', $slug);
        if (count($slugParts) > 1) {
            $slug = $slugParts[1];
        }

        $product = ProductHelper::getProductFromSlug(
            $slug,
            MBRLHelper::decode($request->input('mbrl', '')),
            $request->input('utm_content')
        );
        if (!$product) {
            return redirect()->to(route('page.index'));
        }

        $salesLink = str_replace(
            '/blog',
            '',
            (env('APP_URL') . $request->getRequestUri())
        );

        return view('pages.blog',compact('product','salesLink'));
    }

    private function setPhoneOrderCode($sku)
    {
        $skuParts = explode('-', $sku);

        if (count($skuParts) > 3) {
            $sku = $skuParts[0] . '-' . end($skuParts);
        } else {
            $sku = $skuParts[0];
        }
        return $sku;
    }

    public function error404(Request $request)
    {       
        $products = ProductHelper::getProducts(
            30,
            0,
            $request->input('order'),
            MBRLHelper::decode($request->input('mbrl', ''))
        );
        shuffle($products);
        $products = array_slice($products, 0, 6);
        return view('errors.404.404', compact('products'));
    }
}
