@php
use App\Helpers\ContentHelper;
@endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_2b/checkout-section.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout1.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/cart-form.css">
@endpush

<div id='checkout-form-section' class="checkout-section-wrapper">
    <center> @include('components.checkout.title.checkout-title', ['text' => ContentHelper::staticText('whereSend')])</center>

    <div class="checkout-row">

        <div class="checkout-col">
            @include('components.checkout.form.form')
            @include('components.checkout.table.delivery.delivery')
            @include('components.checkout.table.payment.payment-options')
        </div>



        <div class="checkout-col">
            @include('components.checkout.table.bonuses.bonuses', ['bonusTitle' => ContentHelper::staticText('packageInsurance'), 'bonusText' => ContentHelper::staticText('productReplacement'), 'sku' => $feeHelper->packageInsuranceSku(), 'cost' => $feeHelper->packageInsuranceCost(), 'icon' => 'insurance.png'])
           @if ($feeHelper->lifeInsuranceSku())
           @include('components.checkout.table.bonuses.bonuses', ['bonusTitle' => ContentHelper::staticText('lifeInsurance'), 'bonusText' => ContentHelper::staticText('insuranceText2'), 'sku' => $feeHelper->lifeInsuranceSku(), 'cost' => $feeHelper->lifeInsuranceCost(), 'icon' => 'lifetimeInsurance.png', 'brand' => env('BRAND_NAME')])
           @endif
            {{-- @include('components.shared.coupon') --}}

            @if(env('HAS_BOOK'))
                @include('components.checkout.books')
            @endif
            
          <div class="order-box">
            @include('components.checkout.table.order-info')
            @include('components.checkout.order-button')
          </div>
            <div class="benefits">
                <div class="top-benefits">
                    @include('components.shared.benefit', ['icon' => '44day-benefit.png', 'benefitText' => ContentHelper::staticText('returnDeadline')])
                    @include('components.shared.benefit', ['icon' => 'upon-delivery.png', 'benefitText' =>  ContentHelper::staticText('payCourier') ])
                  </div>
                @include('components.shared.benefit', ['icon' => 'ssl-security.png', 'benefitText' => ContentHelper::staticText('ssl') ])
            </div>
        </div>
    </div>
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/Form.js"></script>
    <script>
        let address = '{{ ContentHelper::staticText('address') }}';
        let houseNumber = '{{ ContentHelper::staticText('houseNumber') }}';
        let postal = '{{ ContentHelper::staticText('postNumber') }}';
        let city = '{{ ContentHelper::staticText('place') }}';
        let phone = '{{ ContentHelper::staticText('phone') }}';
        let comment = '{{ ContentHelper::staticText('commentTitle') }}';
        let enterCoupon = '{{ ContentHelper::staticText('enterCoupon') }}';
        let fullName = '{{ ContentHelper::staticText('fullName') }}';
        let ip = '{{ $_SERVER['REMOTE_ADDR'] }}';
        const ofbSettings = @json($ofbSettings);
        const countryForm = '{{ env('COUNTRY_CODE') }}';
        const brandID = '{{ env('BRAND_ID') }}';
        const createRoute = '{{ route('order.create') }}';
        const klarnaRoute = '{{ route('order.klarna.update') }}';
    </script>
    <script src="{{ env('APP_URL') }}/js/checkout/checkout.js"></script>
@endpush
