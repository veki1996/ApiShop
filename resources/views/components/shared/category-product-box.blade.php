@php
    use App\Entities\Product;

    /**
    * @var Product $product
    */
@endphp
@php use App\Helpers\ContentHelper; @endphp

<div data-name="{{$name}}" data-sku="{{$sku}}" class="productBox2">
    <a href="{{env('APP_URL')}}/{{$link}}{{ \App\Helpers\RouteHelper::appendParameters()}}{{ $product->utm_pod ? '&utm_pod=' . $product->utm_pod : '' }}">
        <div class="imageHolder2">
            <img src="{{$image}}">
        </div>  
    </a>
    <a href="{{env('APP_URL')}}/{{$link}}{{ \App\Helpers\RouteHelper::appendParameters()}}{{ $product->utm_pod ? '&utm_pod=' . $product->utm_pod : '' }}" class="aWidth">
        <div class="rating">
            <img src="https://zoho-site.com/cdn/img/1042.png">
            <span class="ratingNum">4.7 </span>
        </div>
        <div class="title2">{{$title}}</div>
        <div class="priceHolder2 flex centerV">  
            <span class="newPrice2">{{$newPrice}}</span>
            <span class="oldPrice">{{$oldPrice}}</span>
        </div>
       
        <div class="seeProduct">{{ContentHelper::staticText('see') }}<img src="{{env('APP_URL')}}/static/searchWhite.png"></div>
    </a>
</div>



<style>
    .newPrice2KN{
        font-size: 14px;
        color: #a5a5a5;
        font-weight: 600;
    }
    .oldPriceKN{
        font-size: 12px;
        text-decoration: line-through;
        color: #a5a5a5;
        padding-left: 4px;
    }
    .productBox2{
        display:flex;
        gap:16px;
        display: flex;
        justify-content: center;
        max-width: 356px;
        padding: 0px 16px;
    }
    .imageHolder2 {
        width:152px;
        height: 152px;
    }

    .title2{
        font-size: 16px;
        font-weight: 700;
        color: #202020;
        margin-top: 10px;
        height: 5rem;
    }
    .newPrice2{
        font-weight: 700;
        font-size: 20px;
        line-height: 29px;
        color: #202020;
    }
    .priceHolder2{
        margin-top:3px;
    }
    .seeProduct{
        display: flex;
    width: 100%;
    height: 3rem;
    padding: 0.5rem 2rem;
    margin: auto;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    background: #c69c6d;
    color: #fefefe;
    box-shadow: 0px 2px 2px 0px rgba(14, 14, 33, 0.04), 0px 4px 6px 0px rgba(14, 14, 33, 0.04), 0px 6px 16px 0px rgba(14, 14, 33, 0.04), 0px 0px 10px 0px rgba(14, 14, 33, 0.06);
    font-family:'Didact Gothic';
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    /* margin-top: 1rem; */
    cursor: pointer;
    }
    .seeProduct img{
        width:18px;
        height:18px;
    }
    .aWidth{
        width: 500px;
    }
</style>