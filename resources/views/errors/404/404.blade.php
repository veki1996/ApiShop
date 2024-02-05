

@php use App\Helpers\ContentHelper; @endphp

@extends('layouts.base')

@section('head')
    @include('components.index.head')
@stop

@section('body')

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/errors/404.css">
@endpush

    @include('components.shared.header.header', [
        'phone' => $phone,
        'email' => $email,
        'viberNumber' => $viberNumber,
        'whatsappNumber' => $whatsappNumber,
        'orderCode' => $orderCode,
    ])

@include('errors.404.explanation')
@include('errors.404.title')
@include('components.shared.products.products-grid', compact('products'))
@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))


@push('body-js')
<script src="{{env('APP_URL')}}/js/errors/404.js"></script>
@endpush

@stop
