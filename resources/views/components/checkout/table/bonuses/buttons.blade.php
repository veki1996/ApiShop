@php use App\Helpers\ContentHelper; @endphp
<button id="postage-cost" class="bonus-toggle-btn" style="display: none"
data-price="{{$feeHelper->postageCost()}}"
data-sku="{{$feeHelper->postageSku()}}"
data-name="{{ContentHelper::staticText('postage') }}"
>
</button>
<button id="cod-cost" class="bonus-toggle-btn" style="display: none"
data-price="{{$feeHelper->codCost()}}"
data-sku="{{$feeHelper->codSku()}}"
data-name="{{ContentHelper::staticText('codCost') }}"
>
</button>