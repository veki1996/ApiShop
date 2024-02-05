<?php

namespace App\Helpers;

use App\Entities\Product;
use App\Helpers\CacheHelper;
use App\Helpers\External\ZohoHelper;
use Illuminate\Support\Facades\Cache;


class ProductHelper
{
    public static function getProductFromSlug(string $slug, $pricePoint = null, $utmContent = null, $utm_pod = null): ?Product
    {
        $cacheKey = "product.slug.$slug.$pricePoint.$utmContent.$utm_pod";
    
        if (!Cache::has($cacheKey) || (request()->input('no-cache') == "true")) {
            (new ZohoHelper)->fetchProductData($cacheKey, $slug, $pricePoint, $utmContent, $utm_pod);
        }
       
        return Product::fromApiData(Cache::get($cacheKey));
    }

    public static function getProductJson(string $sku): array
    {
        $cacheKey = "product.json.$sku";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchProductJson($cacheKey, $sku);
        }

        return Cache::get($cacheKey);
    }

    public static function getProductContent(string $slug): string
    {
        $cacheKey = "product.content.$slug";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchProductContent($cacheKey, $slug);
        }

        return Cache::get($cacheKey);
    }

    public static function getProductProperties(string $sku): array
    {
        $cacheKey = "product.properties.$sku";
       
        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            $data =  (new ZohoHelper)->fetchProductProperties($cacheKey, $sku);
        } else {
            $data = Cache::has($cacheKey);
        }

        return $data ? self::processImages(Cache::get($cacheKey), 'combinations') : [];

    }

    public static function getProducts(
        int $limit = 20,
        int $offset = 0,
        $order = null,
        $category = null,
        $pricePoint = null,
        $newProducts = null,
        $mostPopular = null
    ): array {

        $categoryString = is_array($category) ? implode(',' , $category) : $category;
        $cacheKey = "products.$limit.$offset.$order.$categoryString.$pricePoint.$newProducts.$mostPopular";
        
        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchProducts($cacheKey, $limit, $offset, $order, $category, $pricePoint, $newProducts, $mostPopular);
        }
        
        return array_map(
            function ($productData) {
                return Product::fromApiData($productData);
            },
            Cache::get($cacheKey) ?? []
        );
    }

    public static function processImages(array $data, string $type = 'products'): array
    {
        if ($type === 'containers') {
            foreach ($data as $i => $container) {
                if ($container['type'] === 'image') {
                    if (strpos($container['text'], 'ourshopcdn') !== false) {
                        continue;
                    }

                    if($container['text'] === null )
                    {
                        unset($data[$i]);
                        continue;
                    }

                    $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$container[text]"));
                    if (!is_file($imagePath)) {
                        $stored = @file_put_contents(
                            $imagePath,
                            file_get_contents("https://zoho-site.com/$container[text]")
                        );
                        if (!$stored) {
                            unset($data[$i]);
                        }
                    }
                }
            }

            return $data;
        }

        if ($type === 'combinations') {
            foreach ($data['combinations'] as $sku => $combination) {
                if (strpos($combination['image'], 'ourshopcdn') !== false) {
                    continue;
                }

                $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$combination[image]"));
                if (!is_file($imagePath)) {
                    @file_put_contents(
                        $imagePath,
                        file_get_contents("https://zoho-site.com/$combination[image]")
                    );
                }
            }

            return $data;
        }


        // skips products without image and stores images locally
        foreach ($data as $sku => $product) {
            if (!$product['mainImage']) {
                unset($data[$sku]);
                continue;
            }

            if (strpos($product['mainImage'], 'ourshopcdn') !== false) {
                continue;
            }

            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$product[mainImage]"));

            if (!is_file($imagePath)) {
                $stored = @file_put_contents(
                    $imagePath,
                    file_get_contents("https://zoho-site.com/$product[mainImage]")
                );
                if (!$stored) {
                    unset($data[$sku]);
                }
            }
        }

        return $data;
    }

    public static function getProductPrices(string $sku): array
    {
        return [
            $sku => [
                'default' => [
                    'price_01' => 49,
                    'price_02' => 99.99,
                    'price_03' => 139.99
                ]
            ]
        ];
    }

    public static function searchProducts(string $query): array
    {
        $cacheKey = "products.search.$query";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchProductSearch($cacheKey, $query);
        }

        $filteredProducts = Cache::get($cacheKey);

        return array_map(
            function ($filteredProducts) {

                return Product::fromApiData($filteredProducts);
            },
            self::processImages($filteredProducts)
        );
    }

    public static function getSurpriseProduct(): array
    {
        $cacheKey = "surpriseProduct";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchSurpriseProduct($cacheKey);
        }

        return Cache::get($cacheKey);
    }

    public static function getContainers(string $sku, string $block): array
    {
        $tmpl = request() -> input('tmpl');
        $version = request() -> input('version');

        $cacheKey = "product.$sku.containers.$block.$tmpl.$version";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            (new ZohoHelper)->fetchProductContainers($cacheKey, $sku, $block, $tmpl, $version);
        }

        $data = Cache::get($cacheKey);

        return self::processImages($data, 'containers');
    }

    public static function getCategories(string $countryCode): array
    {
        $cacheKey = "categories.$countryCode";
        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
          (new ZohoHelper)->fetchCategories($cacheKey, $countryCode); // return true
        }

        return array_map(
            function ($category) {
                return (object)$category;
            },
            Cache::get($cacheKey) ?: []
        );
    }

    public static function getSimilarForProduct(Product $product) {
        return self::getProducts(10, 0, null, array_key_first($product->categories), null);
    }

    public static function getBundleProduct($fullSku)
    {
            $parts = explode('-', $fullSku);
            $cc    = env('COUNTRY_CODE');
            $sku   = '';
            if(isset($parts[1])) $sku   = $parts[0] . '-' . $parts[1];
            $cacheKey = "bundle.$sku";

            if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
                (new ZohoHelper)->fetchBundleProduct($cacheKey, $cc, $sku);
            }

            $getProduct    = Cache::get($cacheKey);
            $bundleProduct = [];

            if (isset($getProduct[$cc][$sku]['combinations'])) {
                foreach ($getProduct[$cc][$sku]['combinations'] as $variation) {

                    if ($variation['sku'] == $fullSku) {
                        if ($variation['stockQuantity'] >= 100) {
                            $bundleProduct = [
                                'bundleSku'  => $getProduct[$cc][$sku]['sku'],
                                'name'       => $getProduct[$cc][$sku]['name'],
                                'long_desc'  => $getProduct[$cc][$sku]['long_desc'],
                                'image'      => $variation['image'],
                            ];

                            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/".$variation['image']));

                            if (!is_file($imagePath)) {
                                $stored = @file_put_contents( $imagePath, file_get_contents("https://zoho-site.com/".$variation['image']));
                            }
                        }
                    }
                }
            }

            return $bundleProduct;

    }
}
