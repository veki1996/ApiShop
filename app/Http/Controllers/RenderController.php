<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RenderController extends Controller
{
    public function cartTable(Request $request): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'render'  => View::make(
                'components.cart.table',
                [
                    'product' => ContentHelper::staticText('product'),
                    'amount' => ContentHelper::staticText('amount'),
                    'total' => ContentHelper::staticText('total'),
                    'products' => $request->input('products', [])
                ]
            )->render()
        ]);
    }
}
