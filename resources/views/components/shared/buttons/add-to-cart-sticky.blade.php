@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;

    /**
    * @var Product $product
    */

    // rounding
    $numOfDecimals = ["HU" => 0, "PL" => 0, "CZ" => 0, "RO" => 0, "BG" => 0, "RS" => 0, "BA" => 0];
@endphp

<div class="sticky-wrapper">
    <div class="sticky-prices">
        <div class="pr btn2">
            <div class="current">{{round($product->prices->forOne, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}
              
            </div>
            <div class="del">{{round($product->prices->undiscounted, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}
              
            </div>
        </div>
       
        @include(
                'components.shared.buttons.go-to-checkout',
                [   'text' => (request('flow') == 'direct') ? ContentHelper::staticText('buyNow') : ContentHelper::staticText('addToCart'), 
                    'product' => $product,
                    'id'      => uniqid('add-to-cart-'),
                    'icon' => 'add-to-cart',
                    'customClass' => (request('flow') == 'direct') ? 'scroll' : '',
                ]
        )
        
    </div>

</div>

<style>
    .sticky-wrapper a{
        max-width: 256px;
    }
    .current span{
        color:black;
        font-size: 14px;
        font-weight: 400;
        padding-top:5px;
        padding-left: 3px;
    }

    .pr {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 12px 50px;
            gap: 6px;

            background: #FEFEFE;
        }
        .pr .current{
                font-size: 23px !important;
            }
            .        .pr .current {
            font-weight: 700;
            font-size: 24px;
            line-height: 24px;
            /* identical to box height, or 100% */

            text-align: center;

            color: #C21225;
        }
        .pr .del {
            text-decoration: line-through;
            font-weight: 700;
            font-size: 16px;
            line-height: 16px;
            /* identical to box height, or 100% */


            color: #A5A5A5;        }

        .pr .descount,
        .pr div {
            display: flex;
            align-items: center;
        }
        .pr .descount {
            background-color: #2dbe3c;
            border-radius: 2px;
            box-shadow: 0 0 0 2px #fff;
            color: #fff;
            font-weight: 600;
            transform: translateY(20px) rotate(15deg);
            font-size: 16px;
            justify-content: center;
            line-height: 1;
            padding: 4px 6px 2px;
            margin-right: -30px;
            -webkit-animation: up_dwn-data-v-67da7062 1s ease-in-out infinite;
            animation: up_dwn-data-v-67da7062 1s ease-in-out infinite;
        }

        .sticky-wrapper .productSticky{
            margin-top:auto;
            margin-bottom: auto;
            padding-right:16px;
        }
        .sticky-wrapper{
            position: fixed;
            bottom: 0px;
            z-index: 100;
            left: 0px;
            display: flex;
            height: 78px;
            background: #FEFEFE;
            box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
            justify-content: center;
            width: 100%;

        }
        .productStickyBtn{
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 16px;
        }
        .sticky-prices{
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            max-width: 1120px;
        }
        .sticky-prices .pr {
            padding: 12px;
        }
        .sticky-prices .productAdd a:after {
            /* content: "{{ContentHelper::staticText('add')}}"; */
            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            text-transform: uppercase;
            color: #F4F4F4;
        }

        .sticky-wrapper .to-checkout 
        {
            display: flex;
        }

        @media screen and (min-width: 768px) {
            .sticky-prices .pr{
                padding-left: 0px !important;
            }
            .sticky-prices .productSticky {
                min-width: 350px;
            }
            .sticky-prices .productSticky .productAdd a{
                min-width: 350px;
            }
        }
</style>
