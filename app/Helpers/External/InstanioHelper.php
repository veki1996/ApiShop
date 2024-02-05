<?php

namespace App\Helpers\External;

use App\Helpers\CurlHelper;
use Exception;
use stdClass;

class InstanioHelper
{
    public static function couponWasUsed(string $phoneNumber): bool
    {
        try {
            $apiResponse = self::getOrders($phoneNumber);

            return $apiResponse->status === 'success' && intval($apiResponse->couponUsed) === 1;
        } catch (Exception $exception) {
            return false;
        }
    }

    public static function getOrders(string $phoneNumber): stdClass
    {
        return json_decode(
            CurlHelper::request(
                env('INSTANIO_API_URL'),
                'POST',
                [
                    'stateCode' => env('COUNTRY_CODE'),
                    'APIKey' => env('INSTANIO_API_KEY'),
                    'action' => 'getorders',
                    'phone' => $phoneNumber
                ]
            )->body
        );
    }
}
