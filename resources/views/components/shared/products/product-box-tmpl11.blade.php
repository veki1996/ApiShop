@php
    use \App\Helpers\ContentHelper;
@endphp

<div data-name="{{$name}}" data-sku="{{$sku}}" class="productBox {{$customClass ?? ''}}">
    @include('components.shared.products.product-box-discount')
    @include('components.shared.products.product-box-image')
   <div class="product-box-info">
    @include('components.shared.products.product-box-name')
   <div class="productBoxBottomInfo">
    @include('components.shared.products.product-box-prices')
    @include('components.shared.products.product-box-stars')
    @include('components.shared.buttons.add-to-cart', ['customClass' => 'add-to-cart-products black', 'icon' => 'add-to-cart-gold'])
    @include('components.shared.buttons.go-to-checkout', ['icon' => 'buy-now-white', 'text' => ContentHelper::staticText('shopNow'), 'customClass' => 'buy-now'])
   </div>
   </div>
</div>
