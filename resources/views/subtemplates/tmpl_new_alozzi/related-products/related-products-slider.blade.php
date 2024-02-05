@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;
    use App\Helpers\ProductHelper;
    /**
    * @var Product $product
    */
@endphp

@push('head-css')
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/products.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/sliders.css">
@endpush
<div class="related-products-wrapper" id="cart-wrapper">
    <div class="productsAsThis line">{{$text}}</div>
    @include('components.shared.sliders.slider-for-related-products')
</div>

@push('body-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{env('APP_URL')}}/js/categories/categories.js"></script>
@endpush