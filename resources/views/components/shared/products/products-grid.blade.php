@php
    use App\Entities\Product;
    /**
     * @var Product $product
     */
    $numOfDecimals = ['HU' => 0, 'PL' => 0, 'CZ' => 0, 'RO' => 0, 'BG' => 0, 'RS' => 0, 'BA' => 0];
@endphp
@php use App\Helpers\ContentHelper; @endphp

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/products.css">
@endpush

<div class="verticalScroll">
    <div class="ws-frilla-products-box parent row" style="margin: auto">
        <div class="ws-frilla-wrapper-full parent column">
            <div class="product-row parent h-center row mrg-bottom-large wrap product-wrapper">
            @include('components.shared.products.all-products')
            </div>
        </div>
    </div>
</div>

@push('body-js')
<script src="{{env('APP_URL')}}/js/products/product-grid.js"></script>
@endpush