@php use App\Helpers\ContentHelper; @endphp
<div class="deliveryAndBonuses">
    <div class="yourInfo">{{ ContentHelper::staticText('shippingType')  }}</div>
    <div class="shippingOptions">
        @include('components.checkout.table.delivery.standard-delivery')
        @include('components.checkout.table.delivery.priority-delivery')
    </div>
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/checkout/delivery.js"></script>
@endpush

{{--<script>--}}
{{--    $(window).ready(function() {--}}
{{--        cart.updateDelivery()--}}
{{--    })--}}
{{--</script>--}}
