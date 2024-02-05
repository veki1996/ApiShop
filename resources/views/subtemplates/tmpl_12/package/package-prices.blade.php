@php use App\Helpers\ContentHelper; @endphp

<div class="package-prices">
    {{ $product->prices->forOne }}{{env('CURRENCY')}}
    <div class="instadeOf">{{ContentHelper::staticText('insteadOf')}} {{ $product->prices->undiscounted }}{{env('CURRENCY')}}</div>
</div>