@php use App\Helpers\ContentHelper; @endphp
<div class="top-box-quantity">
    <div class="top-box-prices selected" data-quantity=1>
        <span class="qty-amount">1&nbsp;x</span>
        <span id="price">{{$product->prices->forOne}}{{env('CURRENCY')}} /{{ContentHelper::staticText('piece')}}</span>
        <span id="num">  </span>
    </div>
    <div class="top-box-prices" data-quantity=2>
        <span class="qty-amount">2&nbsp;x</span>
        <span id="price">{{ number_format(floor($product->prices->forTwo / 2 * 100) / 100, 2) }}{{env('CURRENCY')}} /{{ContentHelper::staticText('piece')}}</span>
        <span id="num">  </span>
   </div>
    <div class="top-box-prices" data-quantity=3>
        <span class="qty-amount">3&nbsp;x</span>
        <span id="price">{{ number_format(floor($product->prices->forThree / 3 * 100) / 100, 2) }}{{env('CURRENCY')}} /{{ContentHelper::staticText('piece')}}</span>
        <span id="num">  </span>
   </div>
</div>

<script>
    const priceOne = '{{$product->prices->forOne}}';
    const priceTwo = '{{$product->prices->forTwo}}';
    const priceThree = '{{$product->prices->forThree}}';
    const discount = {{ $product->prices->discount }};
    const countryCode = "{{env('COUNTRY_CODE')}}";
</script>
@push('body-js')
<script src="{{env('APP_URL')}}/js/products/top-box.js"></script>
@endpush
