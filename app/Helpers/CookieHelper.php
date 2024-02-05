<?php

namespace App\Helpers;

class CookieHelper
{
    public static function setCookies($customerData)
    {
        $cookieData = [
            'name'      => $customerData['name'],
            'telephone' => $customerData['telephone'],
            'email'     => $customerData['email'],
            'address'   => $customerData['address'],
            'houseno'   => $customerData['houseno'],
            'postcode'  => $customerData['postcode'],
            'city'      => $customerData['city'],
        ];
        $jsonCustomerData = json_encode($cookieData);
        $encryptedCustomerData = openssl_encrypt($jsonCustomerData, 'AES-256-CBC', "apiShops", 0, self::getIV());
        setcookie('order-object', $encryptedCustomerData, strtotime('now + 6 months'), '/');
    }

    public static function getCookies()
    {
        $encrypted  = isset($_COOKIE['order-object']) ? $_COOKIE['order-object'] : false;
        $cookieData = openssl_decrypt($encrypted, 'AES-256-CBC', "apiShops", 0, self::getIV());
        $cookieData = json_decode($cookieData, true);
        return $cookieData;
    }

    private static function getIV()
    {   
        return base64_decode('e8guzwmeLk/7vT+9h1yL+w==');
    }
}
