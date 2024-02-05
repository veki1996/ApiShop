@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/coupon.css">
@endpush

<div class="coupon-box">
    <div class="coupon">
        <input type="text" class="coupon-name" placeholder="{{ ContentHelper::staticText('coupon') }}">
        <div class="coupon-btn">{{ContentHelper::staticText('useCoupon') }}</div>
    </div>
    <div>
    <p id="coupon-response"></p>
    </div>
</div>


{{-- create coupon.js script or, add events in cart or where the coupon component is used --}}
@push('body-js')
@endpush
