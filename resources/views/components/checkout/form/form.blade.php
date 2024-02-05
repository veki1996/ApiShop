@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/form.css">
 @endpush

{{--<div class="ws_checkout-form flex col">--}}
    <div class="form-wrapper" id="ime3_v2">
        @include('components.checkout.form.repp-cover')
{{--        <div id="ime3"></div>--}}
        <form id="order-form" class="order-form">
            @include('components.checkout.form.contact')
            @include('components.checkout.form.delivery')
            @include('components.checkout.form.email')
           @isset($product)
           {{-- @include('subtemplates.maa_tmpl_2b.top-box.top-box-quantity') --}}
           @endisset
            @include('components.checkout.form.comment')
            @include('components.checkout.form.bonuses')
        </form>
{{--        <div style="clear: both;"></div>--}}
        @include('components.checkout.form.order-form-price-box')
        @include('components.checkout.form.order-button')
        @include('components.checkout.form.step-button')
    </div>
{{--</div>--}}

