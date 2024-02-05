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

    {{-- <div class="ws-frilla-main-wrapper"> --}}
   @include('components.index.slider.slider') 
    {{-- @include('components.index.hero.hero-section', ['images' => $sliderImages]) --}}
    @include('components.shared.titles-subtitles.global-title', ['slot' => ContentHelper::staticText('explore')])
    @include('components.shared.products.products-grid', compact('products','mostPopular'))
    {{-- @include('components.shared.sliders.slider-for-index-products') this is for esenzzo, for slider index products  --}}
    @include('components.shared.products.view-all-products-btn', ['link' => env('APP_URL') . '/shop' .\App\Helpers\RouteHelper::appendParameters() , 'id' => 'gold', 'text' => ContentHelper::staticText('viewAll')])
    @include('components.shared.banners.gift-banner')
    {{-- @include('components.shared.banners.benefit-banner') --}}
    @if(env('IS_NICHE'))
        @include('components.shared.sliders.slider-categories')
    @endif
    <center> @include('components.shared.titles-subtitles.global-title', ['slot' => ContentHelper::staticText('browseGifts')])</center>
    @include('components.shared.sliders.grid-categories')
    @include('components.shared.benefits.benefits-section')
    {{-- </div> --}}
    @include('components.shared.modals.add-to-cart-modal.popUp')
    @include('components.index.images-section.images-section')
    @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

@stop
