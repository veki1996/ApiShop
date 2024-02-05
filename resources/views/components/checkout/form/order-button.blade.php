@php use App\Helpers\ContentHelper; @endphp
<div class="order-button-wrapper parent column">
    <a href="javascript:void(0);" class="orderButton ws_submit_btn">{{ ContentHelper::staticText('sendMeNow')  }}</a>

    <p class="deliveryDate">{!! ContentHelper::staticText('deliveryDate') !!}</p>

    <span style="text-align: center;" class="agreement">{{ ContentHelper::staticText('acceptingPayment') }}</span>
    <span style="text-align: center;" class="agreement">{{ ContentHelper::staticText('priceFor') }}</span>
    <div class="payu-modal"><img src="{{ env('APP_URL') }}/svg/loader.svg"></div>
</div>
