@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;

    /**
    * @var Product $product
    */

    // rounding
    $numOfDecimals = ["HU" => 0, "PL" => 0, "CZ" => 0, "RO" => 0, "BG" => 0, "RS" => 0, "BA" => 0];
@endphp

<div class="ws-frilla-selector-box productOfTheDayHolder">
    <div class="productOfTheDayImg">
        <div class="productOfTheDayBox" data-sku="{{$product->longSku}}">
            <div class="pOfTheDayTitle">{{ContentHelper::staticText('productOfTheDay')  }}</div>
            <div class="pOfTheDayImg centerH"><img src="{{$product->image}}"></div>
            <div class="pOfTheDayName centerH">{!!$product->name!!}</div>
            <div class="pOfTheDayDesc centerH">{!! $product->shortDescription !!}</div>
            <div class="pOfTheDayPricesE centerH">{{$product->prices->noShipping ?? $product->prices -> forOne}} {{env('CURRENCY')}}<div class="pOfTheDayOldE">{{round($product->prices->undiscounted, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}} {{env('CURRENCY')}}</div></div>
             
            <div class=centerH><img src="{{env('APP_URL')}}/static/fullStars.png"></div>
            <div class="centerH pOfTheDayBtn"><a href="{{$product->slug}}">{{ContentHelper::staticText('shopNow') }}<img src="{{env('APP_URL')}}/static/double_arrow.png" alt="arrow"></a></div>
        </div>
    </div>
</div>


<style>
    .productOfTheDayImg{
        background-image: url("{{env('APP_URL')}}/static/productOfDayBackground.png");
        width:100%;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 550px;
    }
    .productOfTheDayHolder{
        width: 100%;
    }
    .productOfTheDayBox{
        width:272px;
        min-height: 426px;
        background: #FEFEFE;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
    }
    .pOfTheDayTitle{
        background: #C21225;
        width:100%;
        height: 47px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-transform: uppercase;
        color:#FEFEFE;
        font-size: 20px;
        font-weight: 600;
    }
    .pOfTheDayImg img{
        width:152px;
        height: 152px;
        margin-top:24px;
    }
    .centerH{
        display: flex;
        justify-content: center;
    }
    .pOfTheDayName{
        color:#070707;
        margin-top:16px;
        margin-bottom:10px;
        font-size: 20px;
        font-weight: 600;
    }
    .pOfTheDayDesc{
        color:#1E1E1E;
        font-size: 16px;
        margin-left: 16px;
        margin-right: 16px;
        text-align: center;
    }
    .pOfTheDayPricesE{
        margin-top:14px;
        color:#C21225;
        font-size: 18px;
        font-weight: 700
    }
    .pOfTheDayOldE{
       margin-left:4px;
       text-decoration: line-through;
       color:#070707;
       font-size: 14px;
       font-weight: 400;
       padding-top:4px;
    }
    .pOfTheDayPricesKN{
       color:#A5A5A5;
       margin-top:4px;
       font-weight: 600;
    }
    .pOfTheDayOldKN{
        font-weight: 400;
        text-decoration: line-through;
    }
    .centerH img{
        margin-top:12px;
    }
    .pOfTheDayBtn{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 16px auto 24px;
    }
    .pOfTheDayBtn a{
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        background: #C21225;
        color: #FEFEFE;
        text-transform: uppercase;
        padding: 8px 10px;
    }
    .pOfTheDayBtn img{
        margin-top:-2px;
    }



</style>

<script>
    const productOfTheDay = $(".productOfTheDayBox")
    const productOfTheDaySku =productOfTheDay.attr("data-sku")

    localStorage.setItem('productOfTheDay', productOfTheDaySku);

    var pOfTheDay = localStorage.getItem('productOfTheDay');

    $('.productBox[data-sku="' + pOfTheDay + '"]').hide();

</script>
