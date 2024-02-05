<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class UserAuthHelper
{
   
    public static function goZoho($userData, $link)
    {   
        $endpoint = self::getEndpoint($link);
        $headers  = self::getHeaders();
        $res      = CurlHelper::request($endpoint, 'POST', $userData, $headers);

        if ($res->curlError) {
            Log::critical("API cURL error: {$res->curlError} \nendpoint: $endpoint", (array)$res);
            return false;
        }
        
       return @json_decode($res->body);
    }

    public static function getUser($userData, $link)
    {   
        $endpoint = self::getEndpoint($link);
        $headers  = self::getHeaders();
        $res      = CurlHelper::request($endpoint, 'POST', $userData, $headers);
        
        if ($res->curlError) {
            Log::critical("API cURL error: {$res->curlError} \nendpoint: $endpoint", (array)$res);
            return false;
        }
       
       return @json_decode($res->body);
    }

    public static function logout($session_key) {

        if (isset($_COOKIE[$session_key])) {
            setcookie($session_key, '', time() - 3600, '/');
            unset($_COOKIE[$session_key]);
        }
    }

    public static function parseJWT($credentialFromGoogleResponse)
    {
        $jwtToken       = $credentialFromGoogleResponse;
        list($header, $payload, $signature) = explode('.', $jwtToken);
        $decodedPayload = base64_decode($payload);
        $payloadData    = json_decode($decodedPayload);

        return  [
            'email' => $payloadData->email,
            'name'  => $payloadData->name,
            "isGoogle" => 1,
        ];
    }

    public static function proccessImagesForOrders($userOrders)
    {
        foreach($userOrders->data as $order)
        {
            foreach($order->data as $product)
            {
                if($product->image)
                {
                    if (strpos($product->image, 'ourshopcdn') === false) {
                        $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$product->image"));
            
                        if (!is_file($imagePath)) {
                            @file_put_contents(
                                $imagePath,
                                file_get_contents("https://zoho-site.com/$product->image")
                            );
                        }
                    }
                    
                    $product->image = env('APP_URL') . "/$product->image";
                }
            }
        }
    }

    private static function getHeaders()
    {
        return ['X-API-Key: ' . env('API_KEY')];
    }

    private static function getEndpoint($link)
    {
        return 'https://zoho-site.com/api/wsaccount' . $link;
    }
}
