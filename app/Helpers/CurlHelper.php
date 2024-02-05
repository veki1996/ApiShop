<?php

namespace App\Helpers;

use stdClass;

class CurlHelper
{
    /**
     * Simple wrapper for making HTTP requests.
     * Returns response body, headers, HTTP code, as well as cURL error, if it occurs.
     *
     * @param string $url
     * @param string $method
     * @param mixed|null $body
     * @param array $headers
     * @param array $curlOptions
     * @return stdClass
     */
    public static function request(
        string $url,
        string $method = 'GET',
        $body = null,
        array $headers = [],
        array $curlOptions = []
    ): stdClass {
        $ch = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers
        ];
        if (env('APP_ENV') === 'local') {
            $options[CURLOPT_SSL_VERIFYHOST] = 0;
            $options[CURLOPT_SSL_VERIFYPEER] = 0;
        }

        if ($body) {
            $options[CURLOPT_POSTFIELDS] =
                in_array('content-type: application/json', array_map('strtolower', $headers)) ?
                    json_encode($body) : http_build_query($body);
        }

        if ($curlOptions) {
            $options = array_replace($options, $curlOptions);
        }

        curl_setopt_array($ch, $options);


        $responseHeaders = [];
        curl_setopt(
            $ch, CURLOPT_HEADERFUNCTION,
            function ($ch, $header) use (&$responseHeaders) {
                $bytes = strlen($header);

                if (str_contains($header, ':')) {
                    $responseHeaders[] = trim($header);
                }

                return $bytes;
            }
        );

        $responseBody = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);


        curl_close($ch);


        return (object)[
            'body' => $responseBody,
            'headers' => $responseHeaders,
            'code' => $responseCode,
            'curlError' => $curlError
        ];
    }

}
