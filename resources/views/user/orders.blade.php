@php use App\Helpers\ContentHelper; @endphp

@extends('layouts.base')

@section('head')
@include('components.index.head')
@stop

@section('body')

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/user/user.css">
@endpush

@include('components.shared.header.header', [
'phone' => $phone,
'email' => $email,
'viberNumber' => $viberNumber,
'whatsappNumber' => $whatsappNumber,
'orderCode' => $orderCode,
])

<div class="orders-wrapper">
    @isset($userOrders)
    @if (count($userOrders->data) > 0)

    <div class="order-information">
        @foreach ($userOrders->data as $order)
        <div class="one-order">
            <div class="order-img-product-info">
                @foreach ($order->data as $product)

                <div>
                    <div class="order-product-img">
                        @if ($product->image)
                        <img src="{{$product->image}}" alt="" />
                        @endif
                    </div>
                    <div class="order-product-info">
                        <p>{{$product->product_name}}</p>
                        <p>{{env( 'CURRENCY')}} {{$product->price}} x {{$product->quantity}}</p>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="order-product-prices">
                <p><b>Total: {{ $order->total_price }} {{ env('CURRENCY') }}</b></p>
                <p>Order date: {{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</p>
            </div>
        </div>

        @endforeach
    </div>
    @else
    <h1>no orders</h1>
    @endif
    @endisset
</div>

@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))
@stop