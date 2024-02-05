<?php

namespace App\Http\Controllers;

use App\Helpers\CurlHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class OrderFillBreakController
{
    /**
     * Stores order fill break data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = [
            'APIKey' => env('OFB_API_KEY'),
            'action' => 'sendoutbounddata',
            'type' => 'OUTOC',
            'ecommerce' => 1
        ];
       
        $parameters = [
            'name',
            'surname',
            'telephone',
            'address',
            'houseno',
            'postcode',
            'city',
            'email',
            'state',
            'randomID',
            'ip',
            'product',
            'multiproduct',
            'multiproductPrice',
            'price',
            'postage',
            
        ];
        foreach ($parameters as $parameter) {
            $data[$parameter] = $request->input($parameter);
        }

        return new JsonResponse(
            json_decode(
                CurlHelper::request(env('OFB_API_URL'), 'POST', $data)->body,
                true
            )
        );
}
}
