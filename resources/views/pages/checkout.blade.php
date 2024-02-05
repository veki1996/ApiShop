@php use App\Helpers\ContentHelper; @endphp
@extends('layouts.base')

@section('head')
    @include('components.checkout.head')
@stop
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/gift-bag.css">
    {{--    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/cart.css">--}}
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/header.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout1.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout-submit.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/cart.css">
@endpush

@section('body')

    @include('components.shared.header.header')

    <div class="checkout-container">
        <div class="checkout-data">
            {{-- @include('components.checkout.title.checkout-title', ['text' => ContentHelper::staticText('goToCheckout')]) --}}
            @include('components.checkout.form.form')
            @include('components.checkout.table.table', compact('feeHelper'))

            @if(env('HAS_BOOK'))
                @include('components.checkout.books')
            @endif

        </div>
        <div class="coupon-data-container">
            {{-- <div class="cart-coupon-container">
                @include('components.shared.coupon')
            </div> --}}
            <div class="checkout-submit-data">
                @include('components.checkout.table.order-info')
                @include('components.checkout.order-button')

            </div>
            <div class="benefits">
                <div class="top-benefits">
                  @include('components.shared.benefit', ['icon' => '44day-benefit.png', 'benefitText' => ContentHelper::staticText('returnDeadline')])
                  @include('components.shared.benefit', ['icon' => 'upon-delivery.png', 'benefitText' =>  ContentHelper::staticText('payCourier') ])
                </div>
                @include('components.shared.benefit', ['icon' => 'ssl-security.png', 'benefitText' =>  ContentHelper::staticText('ssl') ])
              </div>
        </div>
      
    </div>

    {{-- @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks')) --}}
    
@stop


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
        const days = '{{ContentHelper::staticText('days')}}';
        const standard = '{{ContentHelper::staticText('typeStandard')}}';
        const fast = '{{ContentHelper::staticText('priority')}}';
        const priorityCost = '{{round(($feeHelper->priorityDeliveryCost()),2)}}';
    </script>
    <script src="{{env('APP_URL')}}/js/checkout/checkout.js"></script>
@endpush
