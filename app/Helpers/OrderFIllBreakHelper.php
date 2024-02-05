<?php

namespace App\Helpers;


use Exception;
use Illuminate\Support\Facades\Cache;

class OrderFIllBreakHelper
{
    public static $SETTINGS_CACHE_TIME = 60 * 60;

    /**
     * Returns relevant OFB settings
     *
     * @return array
     */
    public static function getSettings(): array
    {
        $brandId = env('BRAND_ID');
        $countryCode = env('COUNTRY_CODE');

        $cacheKey = "ofb.settings.$brandId.$countryCode";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true") {
            $apiResponse = CurlHelper::request(
                strtr(
                    env('OFB_ZOHO_API_URL'),
                    [
                        '{brandId}' => env('BRAND_ID'),
                        '{countryCode}' => env('COUNTRY_CODE')
                    ]
                )
            );

            try {
                Cache::put($cacheKey, json_decode($apiResponse->body, true)['data'], self::$SETTINGS_CACHE_TIME);
            } catch (Exception $e) {
            }
        }

        return Cache::get($cacheKey) ?? [];
    }
}
