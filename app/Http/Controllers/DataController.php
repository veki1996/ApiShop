<?php

namespace App\Http\Controllers;

use App\Helpers\HtmlHelper;
use App\Helpers\ProductHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DataController extends Controller
{
    public function products(Request $request): JsonResponse
    {
        $limit = $request->input('limit', 20);
        $offset = $request->input('offset', 0);
        $category = $request->input('category');

        // order does nothing for now, since there's no easy way
        // to determine which products sell best etc.
        $order = $request->input('order');

        $data = ProductHelper::getProducts($limit, $offset, $order, $category);

        if ($request->input('render')) {
            $data = $this->renderProducts($data);
        }

        return new JsonResponse([
            'success' => boolval($data),
            'data'    => $data
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('query');
        if (!$query) {
            return $this->products($request);
        }

        $data = ProductHelper::searchProducts($query);

        if ($request->input('render')) {
            $data = $this->renderProducts($data);
        }

        return new JsonResponse([
            'success' => boolval($data),
            'data'    => $data
        ]);
    }

    private function renderProducts(array $data): string
    {
        $output = View::make('components.index.products-grid', ['products' => $data, 'newProducts' => [], 'mostPopular' => []])->render();


        // products-grid wraps everything in a div, so we have to strip it off
        return HtmlHelper::getTagContent('products-holder', $output, 'id');
    }
}
