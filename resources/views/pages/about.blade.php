
@php use App\Helpers\ContentHelper; @endphp

@extends('layouts.base')

@section('head')
    @include('components.index.head')
@stop

@section('body')

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/about.css">
@endpush

    @include('components.shared.header.header', [
        'phone' => $phone,
        'email' => $email,
        'viberNumber' => $viberNumber,
        'whatsappNumber' => $whatsappNumber,
        'orderCode' => $orderCode,
    ])


@include('components.about.hero-about') 
 @include('components.about.main-about')
{{--
{{-- @include('components.about2.hero-about2')
@include('components.about2.main-about2') --}}
@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))
@stop
