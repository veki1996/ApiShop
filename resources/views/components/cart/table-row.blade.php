@php
use App\Helpers\ContentHelper;
use App\Helpers\FeeHelper;
@endphp

<div class="productOnCart" data-sku="{{$product['sku']}}">
    <div class="removeProduct">
         <a data-sku="{{$product['sku']}}" href="javascript:void(0);" class="mob-remove remove_row">
            <img src="{{env('APP_URL')}}/static/removeProduct.png"  alt="remove-product">
        </a>
    </div>

    <img alt="cart-product" src="{{$product['image']}}" class="cartPhoto"  alt="cartPhoto">

    <div class="productCartInfo">
        <div class="cartName">
            {{$product['long_name']}}
            {{$product['cartVar']}} 
        </div>
        <div class="quantityBox" data-sku="{{$product['sku']}}">
          <div class="qtyText">{{ContentHelper::staticText('quantity')}}:</div>
          <span class="quantitySelector">
              <select data-sku="{{$product['sku']}}" class="cart-quantity-selector bundle_selector">
                  <option value="1" @if($product['quantity'] === '1') selected
                                    @endif data-price="{{$product['price_1x']}}">1</option>
                  <option value="2" @if($product['quantity'] === '2') selected
                                    @endif data-price="{{$product['price_2x']}}">2</option>
                  <option value="3" @if($product['quantity'] === '3') selected
                                      @endif data-price="{{$product['price_3x']}}">3</option>
                </select>
          </span>
      </div>
        <div class="priceNcounter">
                <div class="priceAndRev">
                    <div class="price">
                        <span data-sku="{{$product['sku']}}"
                        class="ws_field bundle_row_total price priceNum" data-sku="{{$product['sku']}}">{{$product['price']}} {{env('CURRENCY')}} </span>
                        {{-- <div class="euroCart" data-sku="{{$product['sku']}}">/{{round(($product['price']) * 7.53450,2)}} kn</div> --}}
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="addAnotherOne compSku" data-sku="{{$product['sku']}}">
    <div class="addAnotherOneText">
        {{ContentHelper::staticText('addAnotherOne') }}
        <span class="addAnotherOnePrice" data-sku="{{$product['sku']}}"></span>
    </div>
    <button class="addAnotherOneBtn" data-sku="{{$product['sku']}}">{{ContentHelper::staticText('add') }}</button>
    
</div>
<div class="addAnotherOne oneYear" data-sku="{{$product['sku']}}">
    <div class="addAnotherOneText oneYearAdd" data-sku="{{$product['sku']}}">
        {{ContentHelper::staticText('yearInsuranceAddNew') }} 
        <div class="yearInsurancePrice">
          {{(new \App\Helpers\FeeHelper())->yearInsuranceCost()}}{{env('CURRENCY')}}
          {{-- /{{round(((new \App\Helpers\FeeHelper())->yearInsuranceCost()*7.5345),2)}}kn --}}
        </div>  
    </div>
    <div class="addAnotherOneText oneYearDone" data-sku="{{$product['sku']}}">
      {{ContentHelper::staticText('yearInsuranceDone')}}.
  </div>
      <label class="switch" id="yearInsuracne"
        data-price="{{(new \App\Helpers\FeeHelper())->yearInsuranceCost()}}"
        data-sku="{{(new \App\Helpers\FeeHelper())->yearInsuranceSku()}}"
        data-name="{{ContentHelper::staticText('yearInsurance')}}"
      >
        <input type="checkbox" class="switches" data-sku="{{$product['sku']}}">
        <div class="slider">
            <div class="circle">
                <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                    </g>
                </svg>
                <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                    </g>
                </svg>
            </div>
        </div>
     </label>
    
</div>

<script>
 $(document).ready(function(){
     const getProductBySku = function (sku) {
         return cart.products.find(p => p.sku == sku);

     }
     const updateProduct = function (product) {
         const index = cart.products.map(function(e) { return e.sku; }).indexOf(product.sku);
         const country = '{{env('COUNTRY_CODE')}}'
         cart.products[index] = product;
         const brandID = '{{env('BRAND_ID')}}'
         localStorage.setItem(`cart-${brandID}-${country}`, JSON.stringify(cart));
     }
     $('.oneYear').each(function() {
         const sku = $(this).attr("data-sku");
         if (getProductBySku(sku).warrantyExtension) {
             $(this).find('.switches').attr('checked', 'checked');
             $(this).find('.oneYearAdd').hide();
             $(this).find('.oneYearDone').show();
         }
     })

  const oneYearInsuranceCalc= function(){
        const bonusQyantity = $(".switches:checked").length;
        const sku=$(".switches").attr("data-sku");
        const yearInsuracne = $("#yearInsuracne");

        if(bonusQyantity === 0){
          cart.removeBonus(yearInsuracne.attr('data-sku'));
        } else {
              cart.addBonus({
                  sku: yearInsuracne.attr('data-sku'),
                  name: yearInsuracne.attr('data-name'),
                  price: Number(yearInsuracne.attr('data-price')) * Number(bonusQyantity),
                  quantity:bonusQyantity,
              });
        }
      }

        $('.switches').off("click").on('click', function() {

            const sku=$(this).attr("data-sku");
            let product = getProductBySku(sku);
            product.warrantyExtension = !product.warrantyExtension;
            updateProduct(product);


            if ($(this).attr('checked')) {
              $(this).removeAttr('checked');
              $(`div.oneYearAdd[data-sku="${sku}"]`).show();
              $(`div.oneYearDone[data-sku="${sku}"]`).hide();

            } else {
              $(this).attr('checked', 'checked');
              $(`div.oneYearAdd[data-sku="${sku}"]`).hide();
              $(`div.oneYearDone[data-sku="${sku}"]`).show();
            }
            oneYearInsuranceCalc();
      });
 });

  





</script>

<style>
    .productOnCart {
    display: flex;
    position: relative;
    margin-top: 16px;
    gap: 14px;

    }
    .productOnCart img {
        width: 87px;
        height: 87px;
        margin-right: 4px;
    }
    .cartName {
        font-size: 16px;
        font-weight: 600;
        height: fit-content !important;
        margin-bottom: 4px;
        width: 200px;
        height: 28px;
        line-height: 15px;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .priceNcounter {
        position: relative;
        width: 100%;
        display: flex;
        display: flex;
        justify-content: space-between;
    }
    .price {
        height: 29px;
        display: flex;
        align-items: center;
        width: auto;
    }
    .priceNum {
        font-size: 16px;
        font-weight: 600;
    }
    .priceOld {
        font-size: 12px;
        color: #d9d9d9;
        text-decoration: line-through;
    }

    .priceAndRev {
        width: 150px;
    }
    .euroCart{
        font-size: 16px;
        font-weight: 600;
    }
    .quantityBox{
        margin-top:0px;
        display: flex;
        width:130px;
        align-items: center;
        height: 32px;
    }
    .qtyText{
        color: #070707;
        font-size: 16px;
        font-weight: 400;
    }
    .removeProduct {
        width: 25px;
        height: 25px;
        position: absolute;
        top: 0;
        right: -10px;
    }
    .removeProduct img {
        width: 14px;
        height: 14px;
    }
    .review img {
        width: 88px;
        height: 22px;
    }
    .addAnotherOne{
        width: 100%;
        padding-top:10.5px;
        padding-bottom: 8.5px;
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: -1px;
        line-height: 1.2;
        border-top: 1px #D9D9D9 solid;
        border-bottom: 1px #D9D9D9 solid;
    }
    .oneYear{
      height: 50px;
    }
    .addAnotherOnePrice{
        font-weight: 600;
    }
    .addAnotherOneBtn{
        width: 100px;
        height: 29px;
        background: #FEFEFE;
        border: 1px solid #C21225;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 2px 2px rgba(14, 14, 33, 0.04);
        color: #C21225 !important;
        font-weight: 600;
        font-size: 14px;
        display: grid;
        justify-content: center;
        align-items: center;
        text-transform: uppercase;
        margin-left: 6px;
        padding: 2px 4px;
    }
    .addAnotherOneText{
        line-height: 1.1;
    }
    .oneYearAdd{
      width:90% !important;
      line-height: 1.2;
    }
    .oneYearDone{
      width:90% !important;
      line-height: 1;
      display: none;
    }

    .switch {
  /* switch */
  --switch-width: 46px;
  --switch-height: 24px;
  --switch-bg: rgb(131, 131, 131);
  --switch-checked-bg: #04A145;
  --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
  --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
  /* circle */
  --circle-diameter: 18px;
  --circle-bg: #fff;
  --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
  --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
  --circle-transition: var(--switch-transition);
  /* icon */
  --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
  --icon-cross-color: var(--switch-bg);
  --icon-cross-size: 6px;
  --icon-checkmark-color: var(--switch-checked-bg);
  --icon-checkmark-size: 10px;
  /* effect line */
  --effect-width: calc(var(--circle-diameter) / 2);
  --effect-height: calc(var(--effect-width) / 2 - 1px);
  --effect-bg: var(--circle-bg);
  --effect-border-radius: 1px;
  --effect-transition: all .2s ease-in-out;
}

.switch input {
  display: none;
}

.switch {
  display: inline-block;
}

.switch svg {
  -webkit-transition: var(--icon-transition);
  -o-transition: var(--icon-transition);
  transition: var(--icon-transition);
  position: absolute;
  height: auto;
}

.switch .checkmark {
  width: var(--icon-checkmark-size);
  color: var(--icon-checkmark-color);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
}

.switch .cross {
  width: var(--icon-cross-size);
  color: var(--icon-cross-color);
}

.slider {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  width: var(--switch-width);
  height: var(--switch-height);
  background: var(--switch-bg);
  border-radius: 999px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  position: relative;
  -webkit-transition: var(--switch-transition);
  -o-transition: var(--switch-transition);
  transition: var(--switch-transition);
  cursor: pointer;
}

.circle {
  width: var(--circle-diameter);
  height: var(--circle-diameter);
  background: var(--circle-bg);
  border-radius: inherit;
  -webkit-box-shadow: var(--circle-shadow);
  box-shadow: var(--circle-shadow);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-transition: var(--circle-transition);
  -o-transition: var(--circle-transition);
  transition: var(--circle-transition);
  z-index: 1;
  position: absolute;
  left: var(--switch-offset);
}

.slider::before {
  content: "";
  position: absolute;
  width: var(--effect-width);
  height: var(--effect-height);
  left: calc(var(--switch-offset) + (var(--effect-width) / 2));
  background: var(--effect-bg);
  border-radius: var(--effect-border-radius);
  -webkit-transition: var(--effect-transition);
  -o-transition: var(--effect-transition);
  transition: var(--effect-transition);
}

/* actions */

.switch input:checked+.slider {
  background: var(--switch-checked-bg);
}

.switch input:checked+.slider .checkmark {
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.switch input:checked+.slider .cross {
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
}

.switch input:checked+.slider::before {
  left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
}

.switch input:checked+.slider .circle {
  left: calc(100% - var(--circle-diameter) - var(--switch-offset));
  -webkit-box-shadow: var(--circle-checked-shadow);
  box-shadow: var(--circle-checked-shadow);
}
    hr.horizontalLineCart {
      margin-top:6px;
      width:100%;
      border: 0;
      height: 1px;
      background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
      background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
      background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
      background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
    }

    .yearInsurancePrice{
      font-weight: 600;
      display: inline;
    }
    


</style>



@once
    <!-- not pushed to head, because it's rendered through AJAX -->
    <!-- JS added once, since the component is rendered for every product -->
    <script>
        $('.cart-quantity-selector').on('change', function () {
            const sku = $(this).attr('data-sku')
            const quantity = $(this).val()
            const price = Number($(this).children('option:selected').attr('data-price'))

            cart.updateProduct(sku, { quantity, price })

            $(`span.bundle_row_total[data-sku="${sku}"]`).text(`${price} {{env('CURRENCY')}}`)
            $(`div.euroCart[data-sku="${sku}"]`).text(
            `/` + (price * 7.5345).toFixed(2) + `kn`);

            addAnotherOneProduct(sku);
            productOfTheDayCart();
            complementaryProductsCart();
        })

        $('.remove_row').on('click', function () {
            const sku = $(this).attr('data-sku')

            cart.removeProduct(sku)

            $(`div.productOnCart[data-sku="${sku}"]`).remove();

            $(`.addAnotherOne[data-sku="${sku}"]`).hide();

            $(`.oneYear[data-sku="${sku}"]`).hide();

            $(`.horizontalLineCart[data-sku="${sku}"]`).hide();
        });
        const productOfTheDayCart = function() { 
          var productOfTheDay = localStorage.getItem("productOfTheDay");
          $(".compSku[data-sku='" + productOfTheDay + "']").hide();
          $(".quantityBox[data-sku='" + productOfTheDay + "']").hide();
        }
        const complementaryProductsCart = function(){ 
            // hide addAnotherOne divs for complementary products
              const complementaryProducts = JSON.parse(localStorage.getItem('complementaryProducts'));
              if (!complementaryProducts)
                  return;

              $('.compsku').each(function() {
                const dataSku = $(this).attr('data-sku');
                if (complementaryProducts.indexOf(dataSku) !== -1) {
                  $(this).css("display","none");
                }
              });

              $('.quantitybox').each(function() {
                const dataSku = $(this).attr('data-sku');
                if (complementaryProducts.indexOf(dataSku) !== -1) {
                  $(this).css("display","none");
                }
              });
              $('.oneYear').each(function() {
                const dataSku = $(this).attr('data-sku');
                if (complementaryProducts.indexOf(dataSku) !== -1) {
                  $(this).css("display","none");
                }
              });
         }

         // hide bundle product on cart

        var storedBundleProduct = localStorage.getItem('bundleProduct');

        if (storedBundleProduct) {
            $('.productOnCart[data-sku="' + storedBundleProduct + '"]').hide();
            $('.compSku[data-sku="' + storedBundleProduct + '"]').hide();
            $('.oneYear[data-sku="' + storedBundleProduct + '"]').hide();
        }

        // Used for rounding integers that are not recognized as such due to JavaScript rounding
        function roundToPrecision(value, precision) {
            const epsilon = 1e-10;
            const roundedValue = Math.round(value * Math.pow(10, precision));

            if (Math.abs(roundedValue - value * Math.pow(10, precision)) < epsilon) {
                return (roundedValue / Math.pow(10, precision)).toFixed(precision);
            }

            return value.toFixed(2);
        }

        const addAnotherOneProduct = function(sku) {
                $(".productOnCart").each(function() {
                    const sku = $(this).attr("data-sku");
                    let product = cart.getProduct(sku);
                    let quantity = Number(product.quantity);

                    if (quantity === 1) {
                        let cijena = Number(product.price_2x) - Number(product.price_1x);
                        cijena = roundToPrecision(cijena, 0);
                        $(`.addAnotherOne[data-sku="${sku}"]`).show();
                        $(`.addAnotherOnePrice[data-sku="${sku}"]`).text(cijena + currencySymbol);
                    }

                    if (quantity === 2) {
                        let cijena = Number(product.price_3x) - Number(product.price_2x);
                        cijena = roundToPrecision(cijena, 0);
                        $(`.addAnotherOne[data-sku="${sku}"]`).show();
                        $(`.addAnotherOnePrice[data-sku="${sku}"]`).text(cijena + currencySymbol);
                        product.price = Number(product.price_2x);
                    }

                    if (quantity === 3) {
                        $(`.compSku[data-sku="${sku}"]`).hide();
                        product.price = Number(product.price_3x);
                    }
                });
            };

        $(document).ready(function(){
            addAnotherOneProduct();
            productOfTheDayCart();
            complementaryProductsCart();
        })

        $(".addAnotherOneBtn").on("click", function(){ 

            let sku = $(this).attr("data-sku");

            let quantity =$(`.cart-quantity-selector[data-sku="${sku}"]`).val();

            let product = cart.getProduct(sku);

            if(quantity >= 3) return;

            quantity++;

            product.quantity=quantity;

            $(`.cart-quantity-selector[data-sku="${sku}"]`).val(quantity); 

            if(quantity == 1){
        
                product.price = Number(product.price_1x);
                
                $(`.priceNum[data-sku="${sku}"]`).text(product.price + `{{env('CURRENCY')}}`);

                $(`.euroCart[data-sku="${sku}"]`).text(`/`+(product.price*7.5345).toFixed(2)+`kn`);

                let cijena = Number(product.price_2x) - Number(product.price_1x);
                cijena = roundToPrecision(cijena, 0);
                $(`.addAnotherOnePrice[data-sku="${sku}"]`).text(cijena+currencySymbol);

            
            }

            if(quantity == 2){

                product.price = Number(product.price_2x);
       
                $(`.priceNum[data-sku="${sku}"]`).text(product.price + `{{env('CURRENCY')}}`);

                $(`.euroCart[data-sku="${sku}"]`).text(`/`+(product.price*7.5345).toFixed(2)+`kn`);

                let cijena = Number(product.price_3x) - Number(product.price_2x);
                cijena = roundToPrecision(cijena, 0);
                $(`.addAnotherOnePrice[data-sku="${sku}"]`).text(cijena+currencySymbol);
            }

            if(quantity == 3){

                product.price = Number(product.price_3x);

                $(`.compSku[data-sku="${sku}"]`).hide();

                $(`.euroCart[data-sku="${sku}"]`).text(`/`+(product.price*7.5345).toFixed(2)+`kn`);

                $(`.priceNum[data-sku="${sku}"]`).text(product.price + `{{env('CURRENCY')}}`);
            }

            cart.updateProduct(sku, product);
         })

 
 


    </script>
@endonce


