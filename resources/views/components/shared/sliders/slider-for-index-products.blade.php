@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/products.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/sliders.css">
@endpush
<div id="splideIndexProducts" class="splide {{$customClass ?? ''}}">
    <div class="splide__track">
        <div class="splide__list">
            @foreach ($products as $product)
                <div class="splide__slide">
                    @include('components.shared.products.product-box', [
                        'name' => $product->name,
                        'title' => $product->shortDescription,
                        'sku' => $product->shortSku,
                        'image' => $product->image,
                        'oldPrice' => $product->prices->undiscounted . ' ' . env('CURRENCY'),
                        'newPrice' => $product->prices->forOne . ' ' . env('CURRENCY'),
                        'link' => $product->pageLink,
                        'customClass' => 'full-size',
                    ])
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('body-js')
<script src="{{env('APP_URL')}}/js/products/product-grid.js"></script>
@endpush