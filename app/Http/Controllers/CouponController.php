<?php

namespace App\Http\Controllers;

use App\Helpers\External\InstanioHelper;
use App\Helpers\External\ZohoHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponController
{
    // NOTE: called before sending order to OMG
    public function validate(Request $request): JsonResponse
    {
        $cartValues = $request->input('cartValues');
        $code = $request->input('code');

        if (!$code || !$cartValues) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Missing parameters'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (InstanioHelper::couponWasUsed($request->input('phoneNumber'))) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Invalid coupon'
            ]);
        }

        $validation = ZohoHelper::validateCoupon($code, $cartValues);
        if (!$validation->success || empty($validation->discountedPrices)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Invalid coupon'
            ]);
        }

        return new JsonResponse($validation);
    }

    // NOTE: called on successful order response from OMG
    public function apply(Request $request): JsonResponse
    {
        $code = $request->input('code');
      
        if (!$code) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Missing parameters'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse([
            'success' => ZohoHelper::applyCoupon($code)
        ]);
    }
}
