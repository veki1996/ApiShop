@php use App\Helpers\ContentHelper;
$hash = request()->input('hash');
@endphp


@extends('layouts.base')
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/crossell.css">
</head>

@section('head')
    @include('components.index.head')
@stop

@section('body')

    {{-- @include('components.shared.categories', compact('categories')) --}}


    @include('components.shared.header.header', [
        'phone' => $phone,
        'email' => $email,
        'viberNumber' => $viberNumber,
        'whatsappNumber' => $whatsappNumber,
        'orderCode' => $orderCode,
    ])

    <div class="ws-frilla-main-wrapper">
        <div class="successfulOrder">
            <div class="succTitle">{{ ContentHelper::staticText('successfulOrder2') }}!</div>
            {{-- <img alt="successfulOrder" src="{{ env('APP_URL') }}/static/thanksImgCrossell.png"> --}}
            <div class="onlyToday">
                <h1>💥{{ ContentHelper::staticText('onlyToday') }} 💥 </h1>
                <p class="first">{{ ContentHelper::staticText('crossText1') }} <span id="procent"> -75% </span></p>
                <p> {{ ContentHelper::staticText('crossText2') }} 👇</p>
            </div>
            <div class="napomena">
                ⏳ {{ ContentHelper::staticText('note') }}! ⏳
            </div>

            <div class="offer">
                <h1>{{ ContentHelper::staticText('offerTime') }}: </h1>

                <center><div class="whiteLine1"></div><div class="whiteLine2"></div><span id="minutes">0 0</span> <span id="cube-after"></span> <span id="seconds">0 0</span>
                </center>
            </div>
          
        </div>
       
        <div id="validationMsg">  <p >{{ ContentHelper::staticText('choose') }}</p></div>
        <div class="grid-container">

            @foreach ($products as $product)
                <div class="box">

                    <img class="product-img" src="{{ env('APP_URL') }}/{{ $product['mainImage'] }}" alt=""
                        srcset="">
                    <h3>{{ $product['shortDescription'] }}</h3>
 
                    <div class="quantityBox" data-sku="{{$product['fullSku']}}">
                        <div class="qtyText">{{ContentHelper::staticText('quantity')}}:</div>
                        <span class="quantitySelector">
                            <select data-sku="{{$product['fullSku']}}" class="cart-quantity-selector bundle_selector">
                                <option value="1" @if($product['quantity'] === '1') selected
                                                  @endif data-price="{{$product['prices']['1x']}}">1</option>
                                <option value="2" @if($product['quantity'] === '2') selected
                                                  @endif data-price="{{$product['prices']['2x']}}">2</option>
                                <option value="3" @if($product['quantity'] === '3') selected
                                                    @endif data-price="{{$product['prices']['3x']}}">3</option>
                              </select>
                        </span>
                    </div> 
                    <div class="price" data-sku="{{$product['fullSku']}}">
                        {{ $product['prices']['1x'] . ' ' . $product['currency']['symbol'] }}


                        {{-- <span> / {{ $product['prices']['2x'] . ' ' . $product['currency']['symbol'] }} </span> --}}
                    </div>
                    <div class="cs-stars-container">@include('components.shared.products.product-box-stars')</div>
                    <div class="button-wrapper">
                        <button class="add-btn">
                            <p>{{ ContentHelper::staticText('add') }}</p>
                            <img src="{{ env('APP_URL') }}/static/add-to-cart-gold.png" alt="" srcset="">
                        </button>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="refuse">
            <button>{{ ContentHelper::staticText('refuseCrossell') }}!</button>
        </div>
        <div class="cs-sticky-buttons-container">
           
            <div class="approved">
                <button>{{ ContentHelper::staticText('approvedCrossell') }}!</button>
            </div>
        </div>
    </div>

    @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

@stop

<script>
    var appUrl = '{{env("APP_URL")}}';
    var currency = '{{env('CURRENCY')}}';
    var add = '{{ ContentHelper::staticText("add") }}';
    var added = '{{ ContentHelper::staticText("added") }}';
    var url = '{{route("crossell.order")}}';
    var hashId = '{{$hash}}';
</script>
<script src="{{env('APP_URL')}}/js/crossell.js"></script>
