@php use App\Helpers\ContentHelper; @endphp

<div class="top-box-prices">
    <div>
        <div class="old-price">{{ $product->prices->undiscounted }}{{env('CURRENCY')}} </div>
        <div class="offer-text">{{ContentHelper::staticText('offer') }}</div>
    </div>
    <div>
        <div class="offer-text">-{{$product->prices->discount}}% = </div>
        <div class="new-price">{{ $product->prices->forOne }}{{env('CURRENCY')}}</div>
    </div>
</div>