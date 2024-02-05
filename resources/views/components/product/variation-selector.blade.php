@php use App\Helpers\ContentHelper; @endphp

<div class="selectorBox">
    @for($i = 1; $i <= 3; $i++)
        <div class="mainSelector product-variation-{{$i}}" data-quantity="{{$i}}"
             style="display: {{$i <= 1 ? 'block' : 'none'}}"
        >
            <div id="product-text-div-{{$i}}" class="c087 product-text-div"
                 style="display: none">
                <span class="product_text">
                    {{ContentHelper::staticText('product')}}
                    <span class="productNumber" style="display:inline-block">{{$i}}</span>
                </span>
            </div>

            @foreach($propertiesData['properties'] as $propertyId => $propertyName)
                <div class="c088 property-select-div">
                    <div class="c087">
                        <span>{{$propertyName}}:</span>
                        <span class="select_property">{{ContentHelper::staticText('selectProperties')}}</span>
                    </div>
                    <div class="c051 is-large">
                        <div class="color-selector">
                            @foreach($propertiesData['variations'] as $variationId => $variationData)
                                @if($variationData['property'] === $propertyId)
                                    <button class="color-item color_1 invalid_prop" data-property-id="{{$propertyId}}"
                                         data-variation-id="{{$variationId}}">
                                        <span class="variationVal">{{$variationData['name']}}</span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="c003"></div>
            @endforeach
        </div>
    @endfor
</div>


@push('body-js')
    <script>
        window['combinations'] = JSON.parse('{!! json_encode(array_values($propertiesData['combinations'])) !!}')

       
        $('.color-item').on('click', e => {
            $(e.target).parent().find('.color-item').removeClass('invalid_prop active');
            $(e.target).parent().parent().parent().find('.select_property').hide();
            $(e.target).addClass('active');
        })

        $('.variationVal').on("click", function(){
            console.log($(this).val())
        })

        /**
         * Checks if two arrays have the same elements
         *
         * @param arr_1
         * @param arr_2
         * @returns {boolean}
         */
        const sameElements = (arr_1, arr_2) => {
            arr_1.sort()
            arr_2.sort()

            return JSON.stringify(arr_1.map(n => parseInt(n))) === JSON.stringify(arr_2.map(n => parseInt(n)))
        }
    </script>
@endpush


@push('head-css')
    <style>
        @media screen and (max-width: 480px) {
            .c034 .c049 {
                max-width: initial !important;
                width: 100% !important;
                box-sizing: border-box
            }

            /*div.choice-price{flex-flow:column}*/
        }
        .deskBtns{
            display: none;
        }
        .color-selector {
            display: flex;
            justify-content: start;
            flex-wrap: wrap;
            margin-bottom: 10px;
            margin-left:-3px;
        }

        .color-selector .color-item {
            width: auto;
            display: inline-block;
            border-radius: 5px;
            margin: 0 3px 4px;
            border: 2px solid #d8d8d8;
            background-clip: content-box;
            cursor: pointer;
            position: relative
        }

        .color-item-disabled {
            width: auto;
            display: inline-block;
            border-radius: 5px;
            margin: 0 3px 4px;
            border: 2px solid #d8d8d8;
            background-clip: content-box;
            cursor: pointer;
            position: relative;
            border: 1px dashed #ccc;
            box-shadow: unset;
            color: #ccc;
            opacity: .4;
        }


        .color-item:not(:disabled).active:after, .color-item:not(:disabled):hover:after {
            content: "";
            border: 3px solid #e76a10 !important;
            display: block;
            width: 106%;
            height: 113%;
            border-radius: 5px;
            position: absolute;
            top: -1px;
            left: -2px;
            box-sizing: border-box
        }

        .quantity-selector {
            display: flex;
            flex-flow: row
        }

        .c051 span {
            /* background-color: #ffffff; */
            box-shadow: none;
            margin: 0px;
            color: #000;
        }

        .color-selector .color-item span {
            display: block;
        }

        .color-item.invalid_prop {
            /* background-color: #ffeded !important; */
            border: 2px solid #e76a10;
        }

        .invalid_prop span {
            color: #e76a10 !important;
        }

        .color-item.invalid_prop:hover:after {
            border: none;
        }

        .color-item.invalid_prop:hover span {
            color: #000 !important;
        }

        @media (max-width: 500px) {
            .quantity-selector {
                margin-left: 20px;
            }
        }

        .hidden {
            display: none
        }

        /* = HOTPATCH START = */
        .c034 .c049, .c034 .c012, .c048 {
            display: flex;
            flex-flow: column;
            width: initial;
            float: none;
        }

        /* tmpl_8 fixes */
        div.t8-selector-box div.t8-select {
            flex-flow: column;
        }

        .t8-selector-box .t8-selector .t8-select div.choice-price, .t8-selector-box .t8-selector .t8-select .choice-details span {
            font-size: 16px;
        }

        .select_property {
            font-size: 14px !important;
            font-weight: 400;
            color: #e76a10;
            display: block;
            clear: both;
            margin-top: 4px;
        }

        @media screen and (min-width: 768px) {
            div.t8-selector-box div.button-holder {
                margin-left: 20px;
                margin-right: 20px;
            }
            .selectorBox{
                display: grid;
                grid-template-columns: repeat( auto-fit, minmax(250px, 1fr) );
            }
            .deskBtns {
                display: flex;
                gap: 16px;
                height:60px;
                position: relative;
            }
            .deskBtns .productSticky{ 
                position:absolute;
                top:0px;
                background: #F4F4F4;
                padding-left: 0px;
                padding-right: 0px;
                visibility: visible !important;
                z-index: 0;
            }
            
        }

        @media screen and (max-width: 1023px) {
            .t8-selector-box .t8-selector .t8-select span.best-choice {
                font-size: 12px !important;
                padding: 3px 2px !important;
            }
        }

        /* tmpl_8 fixes */

        .c034 .c053 {
            margin-top: 0px;
        }

        /* = HOTPATCH END = */
    </style>
@endpush
