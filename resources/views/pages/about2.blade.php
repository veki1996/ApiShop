
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

    

@stop
