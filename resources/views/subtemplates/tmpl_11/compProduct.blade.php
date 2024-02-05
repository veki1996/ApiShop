@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;

    /**
    * @var Product $product
    */
@endphp


@if ($product->quantity > 0)
<div class="compProductBox">
    <div class="imgAndName">
        <img src="{{$compImage}}" class="compImg">
        <div class="compProdNameAndPrice">
            <div class="compProductName">{!!$compLongName!!}</div>
            <div class="compProductPrice">{{$compPrice}}{{env('CURRENCY')}}
               
            </div>

        </div>
    </div>
    <div class="compAdd" data-sku="{{$product->longSku}}">
        @include('components.shared.buttons.add-to-cart', ['icon' => 'add-to-cart'])
    </div>
</div>
@endif

<style>
    .compAdd{
        position: relative;
    }
    .imgAndName{
        display: flex;
        gap:6px;
    }
    .compProductBox{
        display: flex;
        justify-content: space-between;
        gap:16px;
        margin-bottom: 6px;
        max-width: 1030px;
        margin-left: auto;
        margin-right: auto;
    }
    .compImg{
        width:72px;
        height: 72px;
    }

    .compAdd a{
        width: 100px;
        height: 28px;
        background: #FEFEFE;
        border: 1px solid #C21225;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 2px 2px rgba(14, 14, 33, 0.04);
        color: #C21225 ;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
        padding: 13px 34px;

    }
    .compProductName{
        font-size: 15px;
        margin-bottom:8px;
    }
    .compProductPrice{
        display: flex;
    }
    .compProductPrice{
        font-size: 16px;
        font-weight: 700;
        color: #070707;
    }
    .compProductPrice .compPriceKn{
        font-size: 14px;
        font-weight: 600;
        color:#A5A5A5;
        margin-left: 6px;
    }

</style>

<script>
$( document ).ready(function() {
   $(".compAdd a").text('{{ContentHelper::staticText('add')}}');

   let complementaryProductsJSON = localStorage.getItem("complementaryProducts");

   let complementaryProducts = [];

   let mainProductSku ;


   if (complementaryProductsJSON !== null) {

        complementaryProducts = JSON.parse(complementaryProductsJSON);
    }

    $('.compAdd').on('click', function() {

        let sku = $(this).attr('data-sku');

        if (!complementaryProducts.includes(sku)) {
            complementaryProducts.push(sku);
        }

        localStorage.setItem("complementaryProducts", JSON.stringify(complementaryProducts));

    });

    $(".productAdd").on("click", function(){
        $(".buyThogetherInfo").css("display","none");
        $('.compAdd').css("display","block");
    })

});

$(`.compAdd[data-sku="{{$product->longSku}}"]`).on("click",function(){
    $(`.cart-add[data-sku="{{$product->longSku}}"]`).text('{{ContentHelper::staticText('added')}}');
    $(`.cart-add[data-sku="{{$product->longSku}}"]`).css('background','#C21225');
    $(`.cart-add[data-sku="{{$product->longSku}}"]`).css('color','#FEFEFE');
    $(`.cart-add[data-sku="{{$product->longSku}}"]`).css('border','none');
})
$(window).on('load',function(){
    mainProductSku = $(".wrapper-bounce .productSticky .productAdd .cart-add").attr('data-sku');

    if(!cart.getProduct(mainProductSku)){
         $('.compAdd').css("display","none");
         $(".buyThogetherInfo").css("display","flex");
     }else{
        $(".buyThogetherInfo").css("display","none");
        $('.compAdd').css("display","block");
     }
})

</script>
