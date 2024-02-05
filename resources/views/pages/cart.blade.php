@php
    use App\Helpers\ContentHelper;
    $categories = App\Helpers\ProductHelper::getCategories(env('COUNTRY_CODE')); // return empty array
@endphp

@extends('layouts.base')

@section('head')
    @include('components.cart.head')
@stop

@section('body')

    @include('components.shared.header.header')

    <div class="cart-body">
        @include('components.cart.cart-data')
        @include('components.cart.cart-total')
    </div>
   

     @include('subtemplates.tmpl_new_alozzi.related-products.related-products-slider', ['customClass' => 'cart-similar', 'text' => ContentHelper::staticText('moreToCart')] )


     @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

@stop

@push('body-js')
    <script>
    let addMore = '{{ContentHelper::staticText('addAnotherOne')}}';
    let add = '{{ContentHelper::staticText('add')}}';
    let qty = '{{ContentHelper::staticText('amount')}}';
    </script>
    <script src="{{ env('APP_URL') }}/js/cart/cart.js"></script>

@endpush

@push('head-css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush


@push('head-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush

