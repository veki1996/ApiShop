<?php

namespace App\Http\Controllers;

use App\Helpers\CurlHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbandonedOrderController
{
    /**
     * Creates abandoned order
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {   

        $countryCode = $request->input('countryCode');
        $brandId = $request->input('brandId');
        $page = $request->input('page');
        $phone = $request->input('phone');
        $data = $request->input('data');
        $key = '1234'; 

        return new JsonResponse(
            json_decode(
                CurlHelper::request(env('AO_API_BASE_URL') . '/store', 'POST', compact('countryCode', 'brandId', 'page', 'phone', 'data', 'key'))->body,
                true
            )
        );
    }

    /**
     * Cancels abandoned order
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function cancel(Request $request): JsonResponse
    {
        $page = $request->input('page');
        $phone = $request->input('phone');
        $key = '1234';

        return new JsonResponse(
            json_decode(
                CurlHelper::request(env('AO_API_BASE_URL') . '/cancel', 'POST', compact('page', 'phone', 'key'))->body,
                true
            )
        );
    }
}
