@php use App\Helpers\ContentHelper; @endphp

<style type="text/css">
div.userChoice{clear:both;max-width: 550px;width:100%;box-sizing:border-box;margin-bottom: 20px;}div.userChoice div.btnWrapper{width:33.33%;height:auto;padding-left:0;padding-right:0}div.userChoice div.btnWrapper span.choice{border:1px solid #bfbfbf;cursor:pointer;padding:2px 0;width:100%;font-size:20px;flex-wrap:nowrap;height:auto;display:flex;width: 95%;box-sizing:border-box;margin-left:0;margin-right:0;margin-top:auto;position:relative;background:#fff;}div.choice-details{display:flex;flex-flow:row;}div.choice-details span{color:#a8a8a8;font-size:17px;text-align:center;display:block}div.userChoice div.btnWrapper span.choice-selected{background-color:#fdf7e8}span.choice-selected:after{content:"";border:2px solid #fbcc59!important;box-shadow:1px 1px 2px 0 rgba(0,0,0,.16);cursor:pointer;width:101%;display:block;position:absolute;top:-1px;left:-1px;height:102%}.choice-q{font-weight:700;font-size:21px}span.best-choice{font-size: 14px!important;font-weight:700;font-style:normal;font-stretch:normal;letter-spacing:normal;text-align:center;background-color:#f3d17e;color:#333;padding: 8px 2px!important;width: 95%;text-transform: uppercase;}span.choice:hover{background-color:#fdf7e8}.perPeace{font-size:12px;color:#333;margin-top:auto}.choice-details{border-top:1px solid #ccc;padding:6px 0}div.choice-price{width:initial;text-align:center;box-sizing:border-box;margin:6px auto}p.choice-price-p{margin:0;padding:0;display:flex;flex-flow: row;color:#000;font-size:16px;}p.choice-price-p span {font-size: 14px!important}div.choice-details span{font-size:16px!important;}@media screen and (max-width:575px){div.userChoice{margin-bottom: 10px!important}p.choice-price-p{font-size:16px;}p.choice-price-p span{font-size:14px!important;}.choice-price{margin:0 auto 5px}}@media screen and (max-width:1023px){p.choice-price-p{flex-flow: column;}span.best-choice{font-size:14px}/*p.choice-price-p{font-size:18px}*/}@media screen and (max-width:480px){.c034 .c049{max-width:initial!important;width:100%!important;box-sizing:border-box}/*div.choice-price{flex-flow:column}*/}@media screen and (max-width:380px){span.best-choice{font-size:13px}p.choice-price-p{font-size:16px}div.choice-details{flex-flow:column;}p.choice-price-p span,div.choice-details span{font-size:16px!important;}}

.color-selector{display:flex;justify-content:start;flex-wrap:wrap;margin-bottom:10px}.color-selector .color-item{width:auto;display:inline-block;border-radius:5px;margin:0 3px 4px;border:2px solid #d8d8d8;background-clip:content-box;cursor:pointer;position:relative;height: 100%;}

.color-item-disabled{width:auto;display:inline-block;border-radius:5px;margin:0 3px 4px;border:2px solid #d8d8d8;background-clip:content-box;cursor:pointer;position:relative;padding:0px;
border: 1px dashed #ccc;
    box-shadow: unset;
    color: #ccc;
    opacity: .4;}


.color-item.active:after,.color-item:hover:after{content:"";border:3px solid #ffbf00!important;z-index:9999;display:block;width:104%;height:106%;border-radius:5px;position:absolute;top:-2px;left:-2px;box-sizing:border-box}.quantity-selector{display:flex;flex-flow:row}.c051 span{background-color: #ffffff;box-shadow: none; margin:0px;color:#000;}.color-selector .color-item span{padding: 10px 15px 10px;display:block;}.color-selector .color-item-disabled span{padding: 10px 15px 10px;display:block;}.color-item.invalid_prop{background-color: #ffeded!important;border:2px solid red;}.invalid_prop span{color: red!important;}.color-item.invalid_prop:hover:after{border:3px solid #000!important;}.color-item.invalid_prop:hover span{color:#000!important;}@media (max-width: 500px) {.quantity-selector {margin-left: 20px;}}

    .hidden{
        display: none
    }
    /* = HOTPATCH START = */
    .c034 .c049, .c034 .c012, .c048 {
        display: flex;
        flex-flow: column;
        width: initial;
        float:none;
    }

    /* tmpl_8 fixes */
    div.t8-selector-box div.t8-select {
        flex-flow: column;
    }

    .t8-selector-box .t8-selector .t8-select div.choice-price, .t8-selector-box .t8-selector .t8-select .choice-details span {
        font-size: 16px;
    }
   .select_property{ font-size:14px !important;font-weight: 400;color:#F00; }

    @media screen and (min-width: 769px) {
        div.t8-selector-box div.button-holder {
            margin-left: 20px;
            margin-right: 20px;
        }
    }

    @media screen and (max-width: 1023px) {
        .t8-selector-box .t8-selector .t8-select span.best-choice {
            font-size: 12px!important;
            padding: 3px 2px!important;
        }
    }
    /* tmpl_8 fixes */

    .c034 .c053 {
        margin-top: 0px;
    }
    /* = HOTPATCH END = */
</style>




<div class="clear"></div>


<div class="c051 is-large" style="display: none;">
    <span>
        <select name="quantity " class="selectBox">
            <option class="1" value="{{$price_1x}}{{$currency}} | 1x | {{$price_1x}} {{$postage}}">1x</option>
            <option class="2" value="{{$price_2x}}{{$currency}} | 2x | {{$price_2x}} {{$postage}}">2x</option>
            <option class="3" value="{{$price_3x}}{{$currency}} | 3x | {{$price_3x}} {{$postage}}">3x</option>
        </select>
    </span>
</div>
<div class="c003"></div>



<!-- SELECTOR START -->
<div class="userChoice parent row">
  <div class="btnWrapper parent row align-end">
    <span class="quantity-item choice choice-selected parent column h-center v-center" data-quantity="1">
        <div class="choice-price parent row">

            <p class="choice-price-p">
                <span><strong>1x</strong></span>
                <span><strong>&nbsp;{{$price_1x}}{{$currency}}</strong> 
              
                </span> 
                <span class="perPeace">/{{trans('vigoSelectorPeace');}}</span>
            </p>

        </div>

    </span>
  </div>

  <div class="btnWrapper parent column">
    <span class="best-choice">{{ContentHelper::staticText('topChoice') }}</span>
    <span class="quantity-item choice fallow parent column h-center v-center" data-quantity="2">
        <div class="choice-price parent row">

            <p class="choice-price-p">
                <span><strong>2x</strong></span>
                <span><strong>&nbsp;{{number_format($price_2x / 2, 0)}}{{$currency}}</strong>
               
                </span> 
                <span class="perPeace">/{{trans('vigoSelectorPeace');}}</span>
            </p>

        </div>

    </span>
  </div>

  <div class="btnWrapper parent row align-end">
    <span class="quantity-item choice parent column h-center v-center" data-quantity="3">
        <div class="choice-price parent row">
          
        <p class="choice-price-p">
            <span><strong>3x</strong></span>
            <span><strong>&nbsp;{{number_format($price_3x / 3, 0)}}{{$currency}}</strong>
           
            </span> 
            <span class="perPeace">/{{trans('vigoSelectorPeace');}}</span>
        </p>

        </div>

    </span>
  </div>
</div>
<!-- SELECTOR END -->


<div class="selectorBox">

<div class="mainSelector product-variation-1" data-option='1'>
<!-- PROPERTY SELECTOR -->

@php
    // warehouse check
    $warehouseCheck = ""; // changed from 'eu1', to use backup warehouse system
    $getWarehouseParam = $_GET['whcheck'] ?? null;

    if($getWarehouseParam == 'off')
        $warehouseCheck = "off";
    if( $getWarehouseParam == 'eu1')
        $warehouseCheck = "eu1";
    if( $getWarehouseParam == 'local')
        $warehouseCheck = "";
    if( $json[$pSku][ 'deliveryArrival' ] == 1 )
        $warehouseCheck = "off";
@endphp


@foreach( $json[ $pSku ][ 'properties' ] as $id => $property )
    @php $variations = $json[ $pSku ][ 'variations' ]; @endphp


    @foreach( $variations as $key => $variation )
        @if ( $variation[ 'property' ] !== $id ) { unset( $variations[ $key ] ); }
        @endif
    @endforeach

    @php $variationsOptions = ""; @endphp

    @foreach( $variations as $key => $variation )
        @php $variationsOptions .= '<option data-variation="'. $key . '">' . $variation['name'] . '</option>'; @endphp
    @endforeach

 
<div class="c087">
    <span class="product_text">{{ContentHelper::staticText('product') }}&nbsp;<span class="productNumber" style="display:inline-block">  1 </span></span>
</div>

    <div class="c088">
        <div class="c087">
        <span >{{$property}}:</span>
        <span class="select_property">{{ContentHelper::staticText('selectProperties') }}:&nbsp;</span>
        <span class="selected_property"></span>
        </div>
        <div class="c051 is-large">
        <span style="display:none;">
            <select class="c089 fix_stato sel-prop" data-property="{{$id}}">
                {!! $variationsOptions !!}
            </select>
        </span>

        <div class="color-selector"></div>
        </div>
    </div>
    <div class="c003"></div>

@endforeach

<div class="comb-info">

  {{-- if( $warehouseCheck && $warehouseCheck == 'eu1' ){ echo $warehouseCheck; } --}}


  @php file_exists( $json[ $pSku ][ 'image' ] ) ? $image = $json[ $pSku ][ 'image' ] : $image = ''; @endphp

        <div class="comb default" data-stockeu="{{$json[ $pSku ][ 'inStockEu1' ]}}" data-nothing-in-stock="{{$json[ $pSku ][ 'nothingInStock' ]}}" data-img="{{ $image}}" data-price="{{$json[ $pSku ][ 'price' ]}}" data-sku="{{$json[ $pSku ][ 'sku' ]}}" data-price-1="{{$price_1x}}{{$currency}} | 1x | {{ $price_1x}} +P" data-price-2="{{$price_2x}}{{$currency}} | 2x | {{ $price_2x}} +P" data-price-3="{{$price_3x}}{{$currency}} | 3x | {{ $price_3x}} +P"></div>

@php
        foreach ( $json[ $pSku ][ 'combinations' ] as $id => $combination ) {

            $variations = $combination[ 'variations' ];

            $variationProps = '';

            foreach ( $variations as $variation ) {

                $variationProperty = $json[ $pSku ][ 'variations' ][ $variation ][ 'property' ];

                $variationProps .= 'data-' . $variationProperty . '="' . $variation . '" ';

            }

            if( $warehouseCheck && $warehouseCheck == 'eu1' ){ $inStock  = $combination[ 'inStockEu1' ]; }
            elseif( $warehouseCheck && $warehouseCheck == 'off' ){ $inStock  = true; } 
            else {  $inStock  =  $combination[ 'instock' ] || (isset($combination['inBackupStock']) && $combination['inBackupStock']); }
            file_exists( $combination[ 'image' ] ) ? $combinationImage = $combination[ 'image' ] : $combinationImage = '';
@endphp


            <div class="comb" {!!$variationProps!!} data-in-stock="{{$inStock}}" data-img="{{$combinationImage}}" data-price="{{$combination[ 'price' ]}}" data-sku="{{$combination[ 'sku' ]}}" data-price-1="{{$price_1x}}{{$currency}} | 1x | {{ $price_1x}} +P" data-price-2="{{$price_2x}}{{$currency}} | 2x | {{ $price_2x}} +P" data-price-3="{{$price_3x}}{{$currency}} | 3x | {{ $price_3x}} +P"></div>
        
@php    } @endphp

        <input id="mainProperty" value="{{$json[ $pSku ][ 'mainProperty' ]}}" hidden>
</div>



@php

    if( ( $cCode == 'AL' || $cCode == 'XK' ) && isset( $secondaryPrices ) ) {
    
    // Test for SubitoGran
    // if($cCode == 'IT') {
    //    $secondaryPrices = array(
    //        'default' => array('price_01' => 10, 'price_02' => 20, 'price_03' => 30),
    //        '335' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '336' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '337' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '338' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '339' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '340' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '341' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '342' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '343' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '344' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '345' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '346' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //        '347' => array('price_01' => 111, 'price_02' => 222, 'price_03' => 333),
    //    );
    //    $secondaryCurrency = "KM";

        if( file_exists( $json[ $pSku ][ 'image' ] ) ){

            $image = $json[ $pSku ][ 'image' ];

        }
@endphp

        <div class="secondary-comb-info">

        <div class="secondary-comb default" data-img="{{$image}}" data-price="{{$json[ $pSku ][ 'price' ]}}" data-sku="{{$json[ $pSku ][ 'sku' ]}}" data-price-1="{{$secondaryPrices[ 'default' ][ 'price_01' ] . $secondaryCurrency}} | 1x | {{ $secondaryPrices[ 'default' ][ 'price_01' ]}} +P" data-price-2="{{$secondaryPrices[ 'default' ][ 'price_02' ] . $secondaryCurrency}} | 2x | {{ $secondaryPrices[ 'default' ][ 'price_02' ]}} +P" data-price-3="{{$secondaryPrices[ 'default' ][ 'price_03' ] . $secondaryCurrency}} | 3x | {{ $secondaryPrices[ 'default' ][ 'price_03' ]}} +P"></div>

        @php
        foreach ( $json[ $pSku ][ 'combinations' ] as $id => $combination ) {

            $variations = $combination[ 'variations' ];

            $variationProps = '';

            foreach ( $variations as $variation ) {

                $variationProperty = $json[ $pSku ][ 'variations' ][ $variation ][ 'property' ];

                $variationProps .= 'data-' . $variationProperty . '="' . $variation . '" ';

            }
        @endphp

            <div class="secondary comb" {!!$variationProps!!} data-img="{{$combination[ 'image' ]}}" data-price="{{$combination[ 'price' ]}}" data-sku="{{$combination[ 'sku' ]}}" data-price-1="{{$secondaryPrices[ $id ][ 'price_01' ] . $secondaryCurrency}} | 1x | {{ $secondaryPrices[ 'default' ][ 'price_01' ]}} +P" data-price-2="{{$secondaryPrices[ $id ][ 'price_02' ] . $secondaryCurrency}} | 2x | {{ $secondaryPrices[ 'default' ][ 'price_02' ]}} +P" data-price-3="{{$secondaryPrices[ $id ][ 'price_03' ] . $secondaryCurrency}} | 3x | {{ $secondaryPrices[ 'default' ][ 'price_03' ]}} +P"></div>

        @php } @endphp

        </div>

@php    }
    // END PROPERTY SELECTOR


@endphp
</div>
</div>


@push('body-js')
    <script>var warehouseCheck = {!! json_encode($warehouseCheck) !!};</script>
    <script src="{{env('APP_URL')}}/js/Selector.js"></script>
@endpush