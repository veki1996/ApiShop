@php
    use App\Entities\Product;

    /**
    * @var Product $product
    */
@endphp
@php use App\Helpers\ContentHelper; @endphp

<div class="buyTogether">{{ContentHelper::staticText('buyTogether')  }}:</div>
<div class="buyThogetherInfo">
    <img src="{{env('APP_URL')}}/static/infoIcon.ico" class="check-icon">
    <div class="buyTogetherInfo">{!!ContentHelper::staticText('buyThogetherInfo')  !!}</div>
</div>

<div class="complementaryProduct">
    @foreach($product->complementaryProducts as $product)
            @include(
                'subtemplates.tmpl_11.compProduct',
                [
                    'compName' => $product->name,
                    'compTitle' => $product->shortDescription,
                    'compPrice' => $product->prices->upsell,
                    'compImage' => $product->image,
                    'compLongName'=>$product->longName,
                    'compSku' => $product->shortSku,
                    'compSkuLong' => $product->longSku,
                    'compLink' => $product->pageLink,
                    'id' => uniqid('add-to-cart-'),
                ]
            )
    @endforeach
</div>


<style>
    .complementaryProduct{
        padding:16px;
    }
    .addedToCartPopp  .complementaryProduct{
        padding:0px;
        width:100%;
    }
    .addedToCartPopp .compProductBox{

    }
    .buyTogether{
        font-weight: 600;
        font-size: 16px;
        color:#070707;
        margin-bottom: 6px;
        padding-left:16px;
    }
    .addedToCartPopp .buyTogether{
        padding-left: 0px;
    }
    .buyThogetherInfo{
        padding-left: 16px;
        display: flex;
        gap:12px;
        margin-top:12px;
        font-size: 13px;
        padding-right: 16px;

    }
    .buyThogetherInfo img{
        width:24px;
        height: 24px;
    }
    @media screen and (min-width: 768px) {
        .buyTogether{
            padding-left: 45px;
        }
        .buyThogetherInfo {
            padding-left: 45px;
        }
    }
</style>