<?php

namespace App\Helpers\External;

use App\Helpers\CurlHelper;
use App\Helpers\FileHelper;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use stdClass;

class ZohoHelper
{
    private $headers;


    public function __construct()
    {
        $this->headers = ['X-API-Key: ' . env('API_KEY')];
    }

    public function fetchPaymentSettings(): bool
    {
        $endpoint = '/payment-settings';
        $cacheTime = 60 * 60 * 24;
        return $this->fetchData($endpoint, 'payment-settings', $cacheTime);
    }

    public function fetchEurRates($cacheKey): bool
    {
        $endpoint = '/eur-rates';
        $cacheTime = 60 * 60 * 24;
        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProducts(
        string $cacheKey,
        int $limit = 20,
        int $offset = 0,
        $order = null,
        $category = null,
        $pricePoint = null,
        $newProducts = null,
        $mostPopular = null
    ): bool {
        $endpoint = "/products?limit=$limit&offset=$offset&newProducts=$newProducts&mostPopular=$mostPopular";
        
        if(is_array($category)) {
            $category = implode(',', $category);
        }

        if ($order) {
            $endpoint .= "&order=$order";
        }
        if ($category) {
            $endpoint .= "&category=$category";
        }
        if ($pricePoint) {
            $endpoint .= "&pricePoint=$pricePoint";
        }

        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchCategories(string $cacheKey, string $countryCode): bool
    {
        $endpoint = "/available-categories/$countryCode?multiLevel=1";
        $cacheTime = 60 * 60;
      
        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductData(string $cacheKey, string $slug, $pricePoint = null, $utmContent = null, $utm_pod = null): bool
    {
        $endpoint = "/product/$slug/general?type=longSlug";
        if ($pricePoint) {
            $endpoint .= "&pricePoint=$pricePoint";
        }
        if($utmContent){
            $utmContent = urlencode($utmContent);
            $endpoint .= "&utm_content=$utmContent";
        }
        if($utm_pod){
            $endpoint .= "&utm_pod=$utm_pod";
        }

        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductContent(string $cacheKey, string $slug): bool
    {
        $endpoint = "/product/$slug/render?type=longSlug";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductProperties(string $cacheKey, string $sku): bool
    {
        $endpoint = "/product/$sku/properties";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductContainers(string $cacheKey, string $sku, string $block, $template = false, $version = false): bool
    {
        $endpoint = "/product/$sku/block/$block/containers?template=$template&version=$version";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchSurpriseProduct(string $cacheKey): bool
    {
        $endpoint = "/surprise-product";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchAllProductContainers(string $cacheKey, string $sku, $template = false, $version = false): bool
    {
        $endpoint = "/product/$sku/block/0/containers?template=$template&version=$version";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchDynamicContainers(string $cacheKey, string $sku, string $wildcard, $template = false, $version = false): bool
    {
        $endpoint = "/product/$sku/wildcard/$wildcard?template=$template&version=$version";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductJson(string $cacheKey, string $sku): bool
    {
        $endpoint = "/product-jsons?sku=$sku";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchProductSearch(string $cacheKey, string $query): bool
    {
        $endpoint = "/search/$query";
        $cacheTime = 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchCrossellData(string $cacheKey): bool
    {
        $endpoint  = "/crossell?domain=".env('APP_URL');
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchTosLinks(string $cacheKey): bool
    {
        $endpoint = "/tos-links";
        $cacheTime = 24 * 60 * 60;

        return $this -> fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchStaticContent(string $cacheKey): bool
    {
        $endpoint = "/static-content";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchStaticTexts(string $cacheKey): bool
    {
        $endpoint = "/texts";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchDeliveryDate(string $cacheKey): bool
    {
        $endpoint = "/delivery-date";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    public function fetchBanners(string $cacheKey): bool
    {
        $endpoint = "/banners";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, $cacheKey, $cacheTime);
    }

    private function fetchData(string $endpoint, string $cacheKey, int $cacheTime): bool
    {
       
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'development' || request()->input('no-cache') == "true") {
            $endpoint = $endpoint . (strpos($endpoint, '?') === false ? '?' : '&') . 'no-cache=true';
        }

        $apiResponse = CurlHelper::request(env('API_BASE_URL') . $endpoint, 'GET', null, $this->headers);

        if ($apiResponse->curlError) {
            Log::critical("API cURL error: {$apiResponse->curlError} \nendpoint: $endpoint", (array)$apiResponse);
            return false;
        }

        $responseBody = @json_decode($apiResponse->body);
        if (!@$responseBody->success || !isset($responseBody->data)) {
            Log::critical("API response error: {$apiResponse->curlError} \nendpoint: $endpoint", (array)$apiResponse);
            return false;
        }

        if (isset($responseBody->images)) {
            FileHelper::storeImagesLocally((array)$responseBody->images);
        }

        if (isset($responseBody->data->mainImage)) {
            FileHelper::storeImagesLocally([$responseBody->data->mainImage]);
        }

        return Cache::put(
            $cacheKey,
            json_decode(json_encode($responseBody->data), true),
            $cacheTime
        );
    }

    public function fetchContactInfo(): bool
    {
        $endpoint = "/contact-info";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, 'contact-info', $cacheTime);
    }

    public function fetchTrackingCodes(): bool
    {
        $endpoint = "/tracking-codes";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, 'tracking-codes', $cacheTime);
    }

    public function fetchUpsellProduct(): bool
    {
        $endpoint = "/upsell-product";
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, 'upsell-product', $cacheTime);
    }

    public static function validateCoupon(string $code, array $cartValues): stdClass
    {
        try {
            $response = json_decode(
                CurlHelper::request(
                    env('ZOHO_COUPONS_API_URL') . '/validate',
                    'POST',
                    [
                        'key' => env('ZOHO_COUPONS_API_KEY'),
                        'code' => $code,
                        'currency' => env('CURRENCY_CODE'),
                        'cartValues' => $cartValues
                    ]
                )->body
            );

            if (!$response->success || !$response->valid) {
                return (object)[
                    'success' => false
                ];
            }

            return (object)[
                'success' => true,
                'discountedPrices' => $response->discountedValues,
                'name' => $response->name,
                'type' => $response->couponType,
                'value' => $response->couponValue,
                'discount' => $response->couponDiscount
            ];
        } catch (Exception $exception) {
            return (object)[
                'success' => false
            ];
        }
    }

    public static function applyCoupon(string $code): bool
    {

        try {
            $apiResponse = CurlHelper::request(
                env('ZOHO_COUPONS_API_URL') . '/apply',
                'POST',
                [
                    'key' => env('ZOHO_COUPONS_API_KEY'),
                    'code' => $code
                ]
            );

            return json_decode($apiResponse->body)->success;
        } catch (Exception $exception) {
            return false;
        }
    }

    public static function fetchFeesData(): bool
    {
        $CACHE_TIME = 60 * 60 * 24;

        $apiResponse = @json_decode(
            CurlHelper::request(
                str_replace('{countryCode}', env('COUNTRY_CODE'), env('FEES_API_URL'))
            )->body
        );
        if (!@$apiResponse->success || !isset($apiResponse->data)) {
            return false;
        }

        return Cache::put('feesData', json_decode(json_encode($apiResponse->data), true), $CACHE_TIME);
    }

    public function fetchFreeShippingData(): bool
    {
        $endpoint = '/free-shipping';
        $cacheTime = 24 * 60 * 60;

        return $this->fetchData($endpoint, 'freeShippingData', $cacheTime);
    }

    public function fetchBundleProduct($cacheKey, $countryCode, $sku)
    {
        $endpoint = "/api/v1/core/zoho/product-jsons/$countryCode/$sku?key=1234";
        $cacheTime = 60 * 60;

         return $this->fetchBundleData($endpoint, $cacheKey, $cacheTime);
    }

    private function fetchBundleData($endpoint, $cacheKey, $cacheTime)
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') {
            $endpoint = $endpoint . (strpos($endpoint, '?') === false ? '?' : '&') . 'no-cache=true';
        }

        $apiResponse = CurlHelper::request(env('CMS_URL') . $endpoint, 'GET', null, $this->headers);

        if ($apiResponse->curlError) {
            Log::critical("API cURL error: {$apiResponse->curlError} \nendpoint: $endpoint", (array)$apiResponse);
            return false;
        }

        $responseBody = @json_decode($apiResponse->body);

        return Cache::put(
            $cacheKey,
            json_decode(json_encode($responseBody), true),
            $cacheTime
        );
    }

}
