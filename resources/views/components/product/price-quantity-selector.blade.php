@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;

    /**
    * @var Product $product
    */
@endphp


<div class="wrapper-right">
        <div class="userChoice flex row">
            <div class="btnWrapper flex row col-rev">
                <span class="choice choice-selected choice1 flex justify-center align-center" data-val="0" data-price-large="{{$product->prices->forOne * 2}}"
                      data-quantity="1" data-sku="{{$product->longSku}}">
                    <span class="choice-q">1x {{$product->prices->forOne}}{{env('CURRENCY')}}</span>
                    <div class="perPiece">
                       
                        <span>/{{ContentHelper::staticText('piece') }}</span>
                    </div>
                </span>
            </div>

            <div class="btnWrapper flex col">
                <span class="best-choice">{{ContentHelper::staticText('topChoice') }}</span>
                    <span class="choice choice2 fallow flex justify-center              align-center" data-val="1"
                            data-price-large="{{$product->prices->forTwo * 2}}"
                            data-quantity="2" data-sku="{{$product->longSku}}">
                            <span class="choice-q">2x {{round($product->prices->forTwo / 2, 2)}}{{env('CURRENCY')}}</span>
                            <div class="perPiece">
                               
                                <span>/{{ContentHelper::staticText('piece') }}</span>
                            </div>
                    </span>
            </div>

            <div class="btnWrapper flex col">
                <span class="super-savings">{{ContentHelper::staticText('superSavings') }}</span>
                <span class="choice choice3 flex justify-center align-center" data-val="2" data-price-large="{{$product->prices->forThree * 2}}"
                      data-quantity="3" data-sku="{{$product->longSku}}">
                      <span class="choice-q">3x {{round($product->prices->forThree / 3, 2)}}{{env('CURRENCY')}}</span>
                            <div class="perPiece">
                                
                                <span>/{{ContentHelper::staticText('piece') }}</span>
                            </div>
                </span>
            </div>
        </div>

        <!-- @if(!empty($product->complementaryProducts))
             @include('subtemplates.tmpl_11.complementary-box')
         @endif -->





        @include(
            'components.product.variation-selector',
            compact('propertiesData')
        )
    </div>

</div>

<style>
    .wrapper-right {
        margin-bottom: 24px;
        width: 100%;
        overflow: initial;
        min-height: auto;
    }

    div.userChoice {
        margin: 0;

        display: flex;
        flex-direction: row;
        align-items: flex-end;
        padding: 0px;
        gap: 8px;
    }

    div.userChoice div.btnWrapper {
        margin: 0;
        width: 33%;
    }

    div.userChoice div.btnWrapper span.choice {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 12px 8px;
        gap: 4px;

        background: linear-gradient(0deg, #F4F4F4, #F4F4F4), #F4F4F4;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);

        border: 2px solid #F4F4F4;
        cursor: pointer;
    }

    div.userChoice div.btnWrapper span.choice:hover {
        background-color: #fdf7e8;
    }

    span.best-choice,
    span.super-savings {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 4px;
        gap: 8px;

        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
        border-radius: 0px;

        font-weight: 600;
        font-size: 12px;
        line-height: 20px;
        /* identical to box height, or 167% */

        text-align: center;
        text-transform: uppercase;

        color: #F4F4F4;
        word-break: break-word;
    }

    span.best-choice {
        background: #C21225;
    }

    span.super-savings {
        background: #F6A834;
    }

    div.userChoice div.btnWrapper span.choice-selected {
        background: #F4F4F4;
        border: 2px solid #070707;
    }
    div.userChoice div.btnWrapper span:nth-child(2).choice-selected {
        border-top: 2px solid #F4F4F4;
    }

    .userChoice span.choice-selected:after {
        border: 2px solid #22282f !important;
        box-shadow: 1px 1px 2px 0 rgb(103 58 183) !important;
    }

    div.userChoice div.btnWrapper span.choice-selected p.choice-price-p,
    div.userChoice div.btnWrapper span.choice-selected .perPeace {
        color: #fff !important;
    }

    .choice-q {
        font-weight: 600;
        font-size: 16px;
        line-height: 18px;
        /* identical to box height, or 112% */

        text-align: center;

        color: #070707;
    }

    .perPiece {
        display: flex;
        align-items: baseline;
        justify-content: center;
    }

    .choiceEur {
        font-weight: 400;
        font-size: 16px;
        line-height: 20px;
        /* or 125% */

        text-align: center;

        color: #070707;
    }

    @media screen and (max-width: 768px) {
        .wrapper-right {
            margin-bottom: 32px;
        }
        .perPiece {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

@push('body-js')
    <script>
        // Rounding settings for different countries
        const decimalsMap = {"HU": 0, "PL": 0, "CZ": 0, "RO": 0, "BG": 0, "RS": 0, "BA": 0};
        const decimalPlaces = decimalsMap["{{env('COUNTRY_CODE')}}"] ?? 2;

        // Get the necessary elements
        const userChoiceElements = $('.userChoice .choice');
        const priceElement = $('.pr .current');
        const delElement = $('.pr .del');

        // Price mapping based on quantities
        const prices = {
            1: {{$product->prices->forOne}},
            2: {{$product->prices->forTwo}},
            3: {{$product->prices->forThree}}
        };
        const oldPrice = {{$price_01}};
        const oldUndiscountedPrice = {{$product->prices->undiscounted}};

        userChoiceElements.on('click', function() {
            const quantity = $(this).attr('data-quantity');

            // Calculate the new prices
            const selectedPrice = prices[quantity];
            const newPrice = selectedPrice.toFixed(decimalPlaces);
            const newUndiscountedPrice = (newPrice * oldUndiscountedPrice / oldPrice).toFixed(decimalPlaces);

            // Update the price elements
            priceElement.html(`<div>${newPrice}{{env('CURRENCY')}}</div>`);
            delElement.html(`<div>${newUndiscountedPrice}{{env('CURRENCY')}}</div>`);

            $('.cart-add').attr({'data-quantity': quantity, 'data-price': selectedPrice})

            $('span.choice').removeClass('choice-selected');
            $(this).addClass('choice-selected');

            if (window['combinations'].length > 0) {
                $('.mainSelector, .product-text-div').hide()
                if (quantity > 1) {
                    $('#product-text-div-1').show()
                }

                for (let i = 1; i <= quantity; i++) {
                    $('.product-variation-' + i).show()
                    if (i > 1) {
                        $('#product-text-div-' + i).show()
                    }
                }
            }
        })
    </script>
@endpush
