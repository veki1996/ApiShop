@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/header-cart/header-cart.css">
@endpush
<a href="{{env('APP_URL')}}/cart{{ \App\Helpers\RouteHelper::appendParameters() }}" class="cartHref">
    <div class="relative">
        <div class="dialogbox">
            <div class="body" id="emptyCartMsg">
                <span class="tip tip-right"></span>
                <div class="message">
                    <span>{{\App\Helpers\ContentHelper::staticText('yourCartIsEmpty') }}</span>
                </div>
            </div>
        </div>
        <div class="dialogbox">
            <div class="body" id="productAlredyInCart">
                <span class="tip tip-right"></span>
                <div class="message">
                    <span>{{\App\Helpers\ContentHelper::staticText('productAlredyInCartMsg') }}</span>
                </div>
            </div>
        </div>

        @if (!(request()->flow === 'direct'))
            <img class="side-cart-trigger" src="{{env('APP_URL')}}/svg/cart-icon.svg" alt="side cart icon for open cart menu">
            <div class="cart-stats hidden"><span class="txt-color-white cart-count">0</span></div>
        @endif

    </div>
</a>
<div class="side-cart-overlay" style="display:none;"></div>
<div class="side-cart" style="display: none;">


    <div class="side-cart-body side-cart-body">
        <div class="title-close">@include('components.cart.cart-title')     </div>

        <div class="side-cart-total">
            <div class="sidecart-total-info">

            </div>

        </div>
        <a class="side-cart-button" href="{{ route('page.cart') }}">{{ ContentHelper::staticText('cart') }}</a>
    </div>
</div>
