
<div class="top-box-price">
    <span id="euro-price">{{ $product->prices->forOne }}&nbsp;{{env('CURRENCY')}} </span> 
    <span id="discounted-price">{{ $product->prices->undiscounted}}&nbsp;{{env('CURRENCY')}}</span> 
</div>
