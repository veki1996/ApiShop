<div id="products-holder" class="container">
    @foreach (array_chunk($products, 4, true) as $productsChunk)
        @foreach ($productsChunk as $product)
            @include('components.shared.products.product-box', [
                'name' => $product->name,
                'title' => $product->shortDescription,
                'longDesc' => $product->longDescription,
                'sku' => $product->longSku,
                'image' => $product->image,
                'oldPrice' =>
                    round(
                        $product->prices->undiscounted,
                        $numOfDecimals[env('COUNTRY_CODE')] ?? 2) .
                    ' ' .
                    env('CURRENCY'),
                'newPrice' => $product->prices->forOne . env('CURRENCY'),
                'link' => $product->pageLink,
                'discount' => $product->prices->discount,
            ])
        @endforeach
    @endforeach
</div>