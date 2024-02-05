@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/gift-bag.css">
@endpush

<div class="gift-bag" data-sku="{{ $sku ?? '' }}">
    <img src="{{ env('APP_URL') }}/static/banner-gift.png" class="cart-product-img {{$customClass ?? ''}}" alt="">
    <div class="gift-bag-info">
        <h2 class="gift-bag-title">{{ContentHelper::staticText('difference') }}</h2>
        <p class="gift-bag-description">{{ContentHelper::staticText('enhanceYourGift') }}</p>
        <div class="gift-bag-data">
            <div class="add-gift-bag"></div>
            <p class="gift-bag-add-text">{{ContentHelper::staticText('addToCart') }}</p>
            <p class="gift-bag-price">3.00 € </p>
        </div>
    </div>
</div>

@push('body-css')
    <script src="{{ env('APP_URL') }}/js/shared/gift-bag.js"></script>
@endpush
