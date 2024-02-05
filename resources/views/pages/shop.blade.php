@php use App\Helpers\ContentHelper; @endphp

@extends('layouts.base')

@section('head')
@include('components.index.head')
@stop
@section('body')

@include('components.shared.header.header', [
'phone' => $phone,
'email' => $email,
'viberNumber' => $viberNumber,
'whatsappNumber' => $whatsappNumber,
'orderCode' => $orderCode,
])

<div class="shop-wrapper">
    <div class="filter">
        @include('components.shop.filter-menu')
        <div class="filter-products">
            @include('components.shared.products.products-grid')
        </div>
    </div>
    @include('components.shared.products.view-all-products-btn', ['link' => 'javascript:void(0)', 'text' => ContentHelper::staticText('viewMore'), 'id' => 'view-products'])
</div>
@include('components.shared.modals.add-to-cart-modal.popUp')
@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

@stop

@push('body-js')
    <script>
        let products =  Object.values(@json($products))
        let noMoreProducts = '{{ContentHelper::staticText('noMore')}}';
        let addToCart = '{{ ContentHelper::staticText('addToCart') }}';
        let buyNow = '{{ ContentHelper::staticText('buyNow') }}';
        let noMore = '{{ ContentHelper::staticText('noMore') }}';
    </script>
    <script src="{{ env('APP_URL') }}/js/shop/shop-page.js"></script>
@endpush
