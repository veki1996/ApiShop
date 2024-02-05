@php use App\Helpers\ContentHelper; @endphp


@extends('layouts.base')

@section('head')
    @include('components.index.head')
@stop

@section('body')


    @include(
       'components.shared.header.header',
       [
           'phone'          => $phone,
           'email'          => $email,
           'viberNumber'    => $viberNumber,
           'whatsappNumber' => $whatsappNumber,
           'orderCode'      => $orderCode
       ]
    )


    <div class="ws-frilla-main-wrapper">
        <div class="successfulOrder">
            <div class="thanks-top-side-components">
                <div class="succTitle">{{ContentHelper::staticText('successfulOrder')}}!</div>
                <div class="succTitleSmall">{{ContentHelper::staticText('successfulOrder2')}}</div>
                <img alt="successfulOrder" src="{{env('APP_URL')}}/static/thanksImg.png">
            </div>
            <div class="continue-shopping-text-and-button">
                <p class="continute-shopping-text-thanks">{{ContentHelper::staticText('continute_shopping_text_thanks')}}</p>
                <a href="{{env('APP_URL')}}" class="thanksBtn">{{ContentHelper::staticText('continueShopping') }}</a>
            </div>
        </div>
    </div>
    {{-- <div class="ws-frilla-main-wrapper thanksFrila ">
        <div class="moreProForYou">{{ContentHelper::staticText('moreProductsForYou') }}</div>
        <div class="category-grid">
            @php shuffle($similarProducts) @endphp
            @foreach(array_chunk($similarProducts, true) as $productsChunk)
                <div >
                        @foreach($productsChunk as $product)
                            @include(
                                'components.shared.category-product-box',
                                [
                                    'name'     => $product->name,
                                    'title'    => $product->longName,
                                    'sku'      => $product->shortSku,
                                    'image'    => $product->image,
                                    'oldPrice' => $product->prices->undiscounted . ' ' . env('CURRENCY'),
                                    'newPrice' => $product->prices->forOne . ' ' . env('CURRENCY'),
                                    'link'     => $product->pageLink,
                                    
                                    
                                ]
                            )
                        @endforeach
                </div>
            @endforeach
        </div>
    </div> --}}


    {{-- @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks')) --}}



@stop

<style>
    body{
        overflow-y: hidden;
    }
    .thanks-top-side-components{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    justify-content: center;
    align-items: center;
    }
    .continute-shopping-text-thanks{
    font-size: 1rem;
}
.continue-shopping-text-and-button{
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    justify-content: center;
    align-items: center;
    text-align: center
}
    .category-grid{
        display: flex;
        /* flex-direction: column; */
        gap: 4rem;
        padding: 16px;
        flex-wrap:wrap;
        justify-content: center
    }
    .successfulOrder{
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        align-items: center;
        padding:16px;
        height: 80%;
    }
    .succTitle{
        font-weight: 700;
        font-size: 32px;
        margin-top: 30px;
        width: 100%;
        text-align: center;
    }
    .succTitleSmall{
        font-size: 16px;
        margin-top:10px;
        margin-bottom: 32px;
        text-align: center    }
    .thanksBtn{
        display: flex;
    width: 100%;
    height: 3rem;
    padding: 1rem 2rem;
    margin: auto;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    background: #762F2A;
    color: #fefefe;
    box-shadow: 0px 2px 2px 0px rgba(14, 14, 33, 0.04), 0px 4px 6px 0px rgba(14, 14, 33, 0.04), 0px 6px 16px 0px rgba(14, 14, 33, 0.04), 0px 0px 10px 0px rgba(14, 14, 33, 0.06);
    font-family: 'Didact Gothic';
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    /* margin-top: 1rem; */
    cursor: pointer;
    }
    .moreProForYou{
        font-weight: 700;
        font-size: 24px;
        line-height: 29px;
        padding-left:16px;
    }
    .ws_breadcrumbs {
    position: relative;
    width: 320px;
    margin: 20px auto;
   }
  .thanksFrila{
    padding-top:0px !important;
   }

.ws_breadcrumbs .ws_circle {
    background-color: #dadada;
    color: #fff;
    font-weight: 500;
    height: 25px;
    width: 25px;
    border-radius: 50%;
}

.ws_breadcrumbs .ws_breadcrumb {
    max-width: 100px;
}

.ws_breadcrumb span {
    color: #d4d4d4;
    font-size: 14px;
}

.ws_breadcrumb.active span {
    color: #403f3f;
}

.ws_breadcrumb.active .ws_circle {
    background-color: #4f9038;
}
.step {
    font-size: 16px;
    margin-top: 6px;
}
.ws_crumb-line {
    height: 9px;
    margin: 20px 0;
    background-color: #d4d4d4;
    position: absolute;
    width: 86px;
    top: -12px;
    left: 63px;
    background-color: #4f9038;
}
.ws_crumb-line:nth-child(2){
    left: 168px !important;
}
@media only screen and (max-width:800px){
    .productBox2{
        align-items: center
    }
    .category-grid{
        display: flex;
        flex-direction: column; 
        gap: 30px;
        padding: 16px;
       flex-wrap: nowrap ; 
        justify-content: center}
}
@media only screen and (min-width: 768px) {
   
    .thanksBtn{
        width: 500px;
    }
}
</style>


<script>
  window.addEventListener('DOMContentLoaded', function() {
            cart.products=[];
            cart.update();
            // drawCart();
    })
</script>
