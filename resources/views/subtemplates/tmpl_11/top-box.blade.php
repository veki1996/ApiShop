@php
    use App\Helpers\ContentHelper;

    // rounding
    $numOfDecimals = ["HU" => 0, "PL" => 0, "CZ" => 0, "RO" => 0, "BG" => 0, "RS" => 0, "BA" => 0];
@endphp


<div class="t11-header parent column v-center h-center {{--pdn-bottom-large--}} txt-color-black">
    <div class="t11-wrapper parent row between">
        <div class="parent column flex-2 v-center {{--pdn-top-small--}} mrg-bottom-medium" id="videodiv">
            {!!$allContainers['s_vid_var_0']->text!!}
            <div class="sale-ban">
                <div style="align-items: center; display: flex">
                    <div class="icon-container">
                        <img src="{{env('APP_URL')}}/svg/bi_fire.svg" alt="Fire icon">
                    </div>
                    <span>{{$staticContainers['s_text_static_153']->text}} </span>
                    <span class="circle_holder white-bg">
                        <span class="">-{{$product->prices->discount}}%</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="t11-header-text t8-header-text3 parent column flex-3">
            <div class="iner-wrraper">
                <div class="t11-header-stars">
                    <div class="flex row align-start">
                        <img src="{{env('APP_URL')}}/svg/stars.svg" alt="Stars Rating Image">
                    </div>
                </div>
                <h1 class="" id="text-3">
                    {!!$product->longName!!}
                </h1>
                <p id="text-second">
                    {!!$product->longDescription!!}
                </p>
                <div class="list">
                    <div class="list1"><img src="{{env('APP_URL')}}/svg/check.svg" alt="Checkmark Icon"> {!!$allContainers['s_text_var_60']->text!!} </div>
                    <div class="list2"><img src="{{env('APP_URL')}}/svg/check.svg" alt="Checkmark Icon"> {!!$allContainers['s_text_var_61']->text!!} </div>
                    <div class="list3"><img src="{{env('APP_URL')}}/svg/check.svg" alt="Checkmark Icon"> {!!$allContainers['s_text_var_62']->text!!} </div>
                </div>

                @if(request('flow') != 'direct')
                    @include('components.product.price-quantity-selector')
                @endif
                <div class="t11-header-buttons-holder parent row wrap">
                    <div class="wrapper-bounce">
                        <div class="pr btn2">
                            <div class="current">{{round($price_01, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}

                            </div>
                            <div class="del">{{round($product->prices->undiscounted, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}
                            </div>
                        </div>
                        @include(
                                'components.shared.buttons.add-to-cart',
                                [
                                    'product' => $product,
                                    'id'      => uniqid('add-to-cart-'),
                                    'icon' => 'add-to-cart'
                                ]
                        )
                    </div>
                    <div class="stage">
                        <div class="box-new bounce-1 curcle">
                            <div class="circle_holder">
                                <svg width="69" height="70" viewBox="0 0 69 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.36475 42.4259L10.903 36.7935L6.61016 31.4694L12.0372 27.5544L10.0973 21.183L16.5717 19.6208L17.1906 12.9577L23.9567 13.9544L27.0141 8.04711L32.6465 11.5853L37.9706 7.29252L41.8856 12.7196L48.257 10.7796L49.8192 17.2541L56.4823 17.8729L55.4856 24.6391L61.3929 27.6964L57.8547 33.3289L62.1475 38.653L56.7204 42.568L58.6604 48.9394L52.186 50.5015L51.5671 57.1647L44.801 56.168L41.7436 62.0753L36.1111 58.5371L30.787 62.8299L26.8721 57.4028L20.5006 59.3427L18.9385 52.8683L12.2754 52.2495L13.272 45.4833L7.36475 42.4259Z" fill="#C21225"/>
                                    <text x="35" y="40">-{{$product->prices->discount}}%</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @if(request('flow') != 'direct')
                    <div class="paycards">
                        <span>{{ContentHelper::staticText('codAvailable')}}</span>
                        <img src="{{env('APP_URL')}}/static/cc2.png">
                        @include('components.shared.books')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('head-css')
    <style>
        /* GENERAL TEMPLATE CSS START
        ------------------------------------------------------- */
        /*html body,*/
        /*body {*/
        /*    font-family:'Varela Round', sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue" !important;*/
        /*}*/
        .t11-wrapper,
        .wrapper {
            max-width: 1010px;
            /*width: 97%;*/
        }

        /* GENERAL TEMPLATE CSS END
        ------------------------------------------------------- */
        /* HEADER BOX END
        ------------------------------------------------------- */
        .t11-header {
            /*padding-top: 120px;*/
            margin-bottom: 40px;
            margin-top: 56px
        }

        .t11-header .slider img {
            width: 100%;
            max-width: 400px;
            border: 1px solid #ccc;
            margin: 0px auto;
            border: none;
        }

        /*slider start*/
        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .slick-list:focus {
            outline: none;
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: '';
        }

        .slick-track:after {
            clear: both;
        }

        .slick-loading .slick-track {
            visibility: hidden;
        }

        .slick-slide {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }

        [dir='rtl'] .slick-slide {
            float: right;
        }

        .slick-slide img {
            display: block;
        }

        .slick-slide.slick-loading img {
            display: none;
        }

        .slick-slide.dragging img {
            pointer-events: none;
        }

        .slick-initialized .slick-slide {
            display: block;
        }

        .slick-loading .slick-slide {
            visibility: hidden;
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }

        .slick-arrow.slick-hidden {
            display: none;
        }

        .slick-slide {
            outline: none
        }

        .slick-prev:hover,
        .slick-prev:focus,
        .slick-next:hover,
        .slick-next:focus {
            outline: none;
        }

        .slick-prev,
        .slick-next {
            top: 50%;
            width: 30px;
            height: 30px;
            border-radius: 0;
            transform: translateY(-50%);
            position: absolute;
            background: rgba(250, 250, 250, 0.25);
            border: none;
            cursor: pointer;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .ws_carousel {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }

        @media screen and (min-width:1024px) {
            .wrapper-right {
                max-width: 530px;
            }

            .slick-prev,
            .slick-next {
                top: 50%;
            }

            .slick-prev {
                left: 30px;
            }

            .slick-next {
                right: 30px;
            }
        }

        @media screen and (max-width:1023px) {
            .slick-prev {
                left: 5px;
            }

            .slick-next {
                right: 5px;
            }
        }

        @media screen and (max-width:768px) {
            .slick-prev {
                left: 25px;
            }

            .slick-next {
                right: 25px;
            }
        }

        @media screen and (max-width:768px) {
            .slick-prev {
                left: 0;
            }

            .slick-next {
                right: 0;
            }
        }

        /*slider end*/
        .t11-header .t11-header-text h1 {
            font-size: 50px;
            font-weight: 700;
            line-height: 1;
        }

        .t11-header .t11-header-text p {
            font-size: 27px;
            line-height: 1.3em;
            font-weight: 500;
        }

        .t11-header .t11-header-text .t11-header-stars {
            margin: 0 0 12px;
        }

        .t11-header .t11-header-text .t11-header-stars span:first-child {
            font-size: 24px;
            color: #ffeb3b !important;
            position: relative;
            top: 2px;
            margin-right: 10px;
        }

        .t11-header .t11-header-text .t11-header-stars span:last-child {
            font-size: 20px;
        }

        button {
            outline: none;
        }

        button::-moz-focus-inner {
            border: 0;
        }

        button:focus {
            outline: none;
            border: 0;
        }

        .t11-header .t11-header-text .t11-header-benefits-holder {
            max-width: 450px;
        }

        .t11-header .t11-header-text .t11-header-benefits-holder .t11-header-benefits-item {
            margin-left: 2px;
            margin-right: 2px;
        }

        .t11-header .t11-header-text .t11-header-benefits-holder .t11-header-benefits-item img {
            width: 100%;
            max-width: 32px;
        }

        .t11-header .t11-header-text .t11-header-benefits-holder .t11-header-benefits-item p {
            font-size: 14px;
        }

        /* HEADER BOX END
        ------------------------------------------------------- */
        /* BENEFIT BOX START
        ------------------------------------------------------- */
        .t11-benefit-box {
            text-align: center;
        }

        .t11-benefit-box .t11-benefits {
            width: 50%;
            max-width: 600px;
        }

        .t11-benefit-box .t11-benefit-item .t11-benefit-box p {
            font-size: 18px;
        }

        .t11-benefit-box .t11-benefit-item .t11-benefit-text h4 {
            font-size: 24px;
            text-align: left;
        }

        .t11-benefit-box .t11-benefit-item .t11-benefit-text p {
            text-align: left;
            font-size: 17px;
        }

        .t11-benefit-box .t11-benefit-item .t11-benefit-image img {
            width: 50px;
            margin-right: 20px;
        }

        .t11-benefit-box .t11-benefit-single-image {
            width: 50%;
        }

        .t11-benefit-box .t11-benefit-single-image img {
            width: 100%;
            max-width: 450px
        }

        /* BENEFIT BOX END
        ------------------------------------------------------- */
        /* ADVANTAGE BOX START
        ------------------------------------------------------- */
        .t11-advantage-box .t11-wrapper {
            max-width: 1199px;
        }

        .t11-advantage-box h2 {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            line-height: 1;
        }

        .t11-advantage-box h3 {
            font-size: 18px;
            font-weight: 500;
            text-align: center;
        }

        .t11-advantage-box p {
            font-size: 18px;
        }

        .t11-advantage-box .t11-advantage-text {
            max-width: 300px;
        }

        .t11-advantage-image img {
            max-width: 300px;
            width: 100%;
            height: 100%;
            min-height: 100%;
        }

        .t11-advantages .t11-advantage-item:nth-child(even) .t11-advantage-text {
            order: 2;
        }

        /* ADVANTAGE BOX END
        ------------------------------------------------------- */
        /* 360 BOX START
        ------------------------------------------------------- */
        .t11-360-box {
            width: 100%;
        }

        .t11-360-box h2 {
            font-size: 34px;
            line-height: 1;
            text-align: center;
        }

        .t11-360-box #canvas {
            width: 100%;
            max-width: 580px;
            height: 580px;
        }

        .t11-360-box .logo-icon {
            width: 100%;
            position: relative;
            top: -37px;
            background: rgb(255 255 255 / 25%);
        }

        .t11-360-box .logo-icon img {
            width: 60px !important;
        }

        /* 360 BOX END
        ------------------------------------------------------- */
        /* TESTIMONIALS BOX START
        ------------------------------------------------------- */
        .t11-testimonials-box {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        .t11-testimonials-box .t11-testimonials-title {
            font-size: 24px;
        }

        .t11-testimonials-box .t11-wrapper div {
            width: 98%;
            max-width: 340px;
            margin: 20px;
            flex: 1;
            /* box-shadow: rgba(0,0,0,0.1) 0 5px 19px; */
            /* border-radius: 10px; */
            background-color: #ffffff;
        }

        .t11-testimonials-box .t11-wrapper div img {
            width: 100%;
            margin-bottom: 15px;
            /* border-radius: 10px 10px 0 0; */
        }

        .t11-testimonials-box .t11-wrapper div img:nth-child(2) {
            max-width: 150px;
            padding: 0 10px;
            margin: 0 0 16px;
        }

        .t11-testimonials-box .t11-wrapper div p {
            margin: 0 0 5px;
            font-size: 18px;
            line-height: 1.3;
            color: #000;
            padding: 0 10px;
        }

        .t11-testimonials-box .t11-wrapper div p:last-child {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            padding: 10px 5px 20px;
        }

        /* TESTIMONIALS BOX END
        ------------------------------------------------------- */
        /* SELECTOR BOX START
        ------------------------------------------------------- */
        .t11-selector-box h2 {
            font-size: 30px;
            font-weight: 500;
        }

        .t11-selector-box .t11-selector .t11-description p,
        .t11-selector-box .t11-selector .t11-select span {
            font-size: 22px;
        }

        .t11-selector-box .t11-selector .t11-description span:first-child {
            text-decoration: line-through;
            text-align: right;
            font-size: 28px;
            padding-right: 20px;
        }

        .t11-selector-box .t11-selector .t11-description span:last-child {
            text-decoration: initial;
            text-align: right;
            font-size: 38px;
            padding-right: 20px;
        }

        .t11-selector-box .t11-selector .t11-stars img {
            width: 100px;
            position: relative;
            top: 3px;
            margin: 0 3px 0 0;
        }

        .t11-selector .c086 img {
            width: 100%;
            max-width: 500px;
        }

        .selector-slider-thumbnails {
            max-width: 500px;
        }

        .t11-selector .c086 .c038 img {
            border: 1px solid #8e8e8e;
            width: 70px;
            float: left;
            margin: 2px;
            opacity: 0.5;
            cursor: pointer;
            padding: 1px;
        }

        .selector-slider-thumbnails img:hover {
            opacity: 1;
            cursor: pointer;
        }

        .t11-selector .t11-selector-text {
            max-width: 600px;
        }

        .t11-selector-box .t11-selector select {
            width: 100%;
            max-width: 170px;
            font-size: 24px;
            padding: 10px 30px 10px 10px;
        }

        .t11-selector .t11-selector-text .t11-quantity .t11-select .selector-holder {
            margin-left: 20px;
            margin-right: 20px;
        }

        .t11-selector .t11-selector-text .t11-quantity .t11-select .button-holder {
            width: 100%;
        }

        .t11-selector-box .t11-selector button {
            width: 100%;
            max-width: 210px;
            font-size: 20px;
            font-weight: 600;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .t11-selector-box .c088 {
            margin-top: 10px;
        }

        .t11-selector .t11-selector-text .t11-card-holder img {
            width: 100%;
            max-width: 300px;
        }

        .t11-selector .t11-selector-text .t11-recommendation-holder {
            border: 1px solid #eee;
        }

        .t11-selector .t11-selector-text .t11-recommendation-holder .icon {
            margin-right: 20px;
        }

        .t11-selector .t11-selector-text .t11-recommendation-holder .icon img {
            width: 100%;
            max-width: 30px;
        }

        .t11-selector .t11-selector-text .t11-recommendation-holder .text p {
            text-align: left;
        }

        .t11-selector .t11-selector-text .t11-benefits-list-holder div span {
            margin-right: 10px;
            font-size: 20px;
        }

        .t11-selector .t11-selector-text .t11-benefits-list-holder div p {
            font-size: 19px;
            margin: 0;
        }

        .blinking {
            animation: blinker-two 2s linear infinite;
        }

        @keyframes blinker-two {
            100% {
                opacity: 0;
            }
        }

        /* SELECTOR BOX END
        ------------------------------------------------------- */
        /* SPECIFICATION BOX START
        ------------------------------------------------------- */
        .t11-specification-box h2 {
            font-size: 34px;
            line-height: 1;
            text-align: center;
        }

        .t11-specification-box .specs .c063 {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-flow: column;
            flex-flow: column;
            flex: 1;
            padding: 15px;
        }

        .t11-specification-box .specs .c063 .c065 div:nth-child(odd) p {
            font-size: 18px;
            line-height: 1.3;
            font-weight: 700;
        }

        .t11-specification-box .specs .c063 .c065 div:nth-child(even) p {
            font-size: 16px;
            padding: 0;
            margin: 0 0 10px;
        }

        /* SPECIFICATION BOX END
        ------------------------------------------------------- */
        /* SOCIAL COMMENTS BOX START
        ------------------------------------------------------- */
        .t11-social-comments-box {
            width: 100%;
        }

        .t11-social-comments-box h2 {
            font-size: 34px;
            line-height: 1;
            text-align: center;
        }

        /* SOCIAL COMMENTS BOX END
        ------------------------------------------------------- */
        /* ORDER FORM BOX START
        ------------------------------------------------------- */
        .t11-order-form-box h2 {
            font-size: 34px;
            text-align: center;
            line-height: 1;
        }

        .t11-order-form-item {
            width: 98%;
        }

        .t11-order-form .t11-order-form-item .t11-order-form-media-holder img {
            width: 100%;
            max-width: 500px;
        }

        .t11-order-form .t11-order-form-item .t11-order-form-media-holder {
            max-width: 600px;
            /*margin-top: 60px;*/
        }

        .form-bonus .form-bonus-wrapper .bonus-item,
        .form-bonus .form-bonus-wrapper .description {
            width: 100% !important;
        }

        .t11-order-form-item {
            padding: 10px 0 !important
        }

        .labtit {
            display: none;
        }

        span.agreement {
            margin-top: 5px;
        }

        /* ORDER FORM BOX END
        ------------------------------------------------------- */
        /* TABLE SIZE START
        ------------------------------------------------------- */
        .description_table {
            margin-bottom: 20px;
        }

        .description_table table {
            border-collapse: collapse;
            margin-top: 15px;
        }

        .description_table tbody {
            background-color: #fff;
        }

        .description_table table,
        th,
        td {
            border: 1px solid black;
        }

        .description_table table td {
            color: #000;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            vertical-align: middle;
        }

        .description_table table tr:first-child td {
            font-weight: 700;
        }

        /* TABLE SIZE END
        ------------------------------------------------------- */
        /* TABLE BOX START
        ------------------------------------------------------- */
        .table-holder {
            background-color: #e7eff4;
            display: block;
            margin: auto;
            padding: 10px 5px;
            text-align: center;
            max-width: 650px;
            width: 100%;
        }

        .table-holder table td,
        .table-holder table th {
            color: #000;
            padding: 10px;
            text-align: center;
            font-size: 15px;
            border: 1px solid #000;
        }

        .table-holder table {
            border-collapse: collapse;
            margin: 0 auto;
            background: #fff;
        }



        .table-holder table tr td.velicina-t {
            padding-top: 20px;
        }

        .table-holder .table-title h3 {
            font-size: 20px;
            font-weight: 600;
        }

        .table-holder p {
            margin: 10px 0;
            font-size: 1em !important;
        }

        .table-fill {
            overflow-x: auto;
        }

        .table-holder img {
            max-width: 300px;
            width: 100%;
            display: block;
            margin: 0 auto;
            padding:5px 0px;
        }

        .table-holder p {
            font-size: 18px;
            margin-bottom: 0px;
            text-align: center;
        }



        @media screen and (max-width:768px) {
            /* .wrapper-bounce{
                position: fixed;
                bottom: 0px;
                z-index: 100;
                left: 0px;
                display: flex;
                height: 78px;
                background: #FEFEFE;
                box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
                justify-content: space-between;
            }
            .productAdd{
                max-width: 150px;
                max-height: 60px;
            }
            .productSticky{
                margin-top: auto;
                margin-bottom: auto;
                margin-right: 16px;
            }
            .pr .current{
                font-size: 21px !important;
            }
            .stage{
                display: none !important;
            } */
            .t11-header-buttons-holder{
                margin-bottom:0px !important;
            }
            .table-holder {
                float: none;
                display: block;
                width: 100%;
                border: none;
            }

            .table-holder table {
                float: none;
                display: block;
                width: 100%;
                border: none;
                max-width: 100%;
            }

            .table-holder table td,
            .table-holder table th {
                padding: 8px 3px !important;
                font-size: 13px !important;
            }

            .table-holder img {
                display: block;
                margin: 0 auto;
            }
        }

        /* TABLE BOX END */

        #videodiv {
            max-width: 500px;
            width: 100%;
            margin-right: 20px;
            height: fit-content;
            flex: 3;
        }

        .t11-header-text3 {
            max-width: 490px;
            width: 100%;
            margin-top: 5px;
        }

        .iner-wrraper {
            max-width: 440px;
        }

        #kom {
            font-size: 14px;
            color: #768391;
            font-weight: 500;
        }

        #text-second {
            font-weight: 400;
            font-size: 18px;
            line-height: 28px;
            /* or 156% */


            color: #6B6B6B;
        }

        #text-3 {
            margin-bottom: 15px;
            font-size: 2.2em;
            color: #22282f;
            margin-top: 6px;
        }

        .list {
            margin: 0 0 24px;

            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            gap: 5px;
        }

        .list1,
        .list2,
        .list3 {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0px;
            gap: 2px;

            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            /* identical to box height */


            color: #070707;

        }

        .list span {
            color: #4caf50;
            font-size: 18px;
            padding-right: 10px;
            position: relative;
            top: 2px;
        }

        .wrapper-bounce {
            filter: drop-shadow(0px 0px 10px rgba(14, 14, 33, 0.06)) drop-shadow(0px 6px 16px rgba(14, 14, 33, 0.04)) drop-shadow(0px 4px 6px rgba(14, 14, 33, 0.04)) drop-shadow(0px 2px 2px rgba(14, 14, 33, 0.04));
            width: 100%;
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

        .pr .current {
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

        .t11-header-buttons-holder {
            position: relative;
            margin-bottom: 24px;
        }

        .stage {
            display: block;
            position: absolute;
            top: -24px;
            right: -14px;
            overflow: hidden;
        }

        .box-new {
            filter: drop-shadow(0px 0px 10px rgba(14, 14, 33, 0.06)) drop-shadow(0px 6px 16px rgba(14, 14, 33, 0.04)) drop-shadow(0px 4px 6px rgba(14, 14, 33, 0.04)) drop-shadow(0px 2px 2px rgba(14, 14, 33, 0.04));
            transform: rotate(-15.25deg);
        }

        .bounce-1 {
            animation-name: bounce-1;
            animation-timing-function: linear;
        }


        @keyframes bounce-1 {

            0%,
            to {
                transform: translateY(20px) rotate(15deg)
            }

            50% {
                transform: translateY(25px) rotate(15deg)
            }
        }

        .box-new.bounce-1 .circle_holder {
            background: none;
        }

        .paycards {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px;
            gap: 8px;
            margin-top:20px;
        }

        .paycards img {
            margin: 0 auto;
        }


        .zal-hero {
            display: flex;
            justify-content: center;
            font-size: 14px;
            margin-top: 10px;
            background-color: #fff;
            border-radius: 4px;
            padding: 10px;
            -webkit-animation: bsh-red 3s cubic-bezier(.165, .84, .44, 1) infinite;
            animation: bsh-red 3s cubic-bezier(.165, .84, .44, 1) infinite;
            border: 1px solid #cdcdcd;
        }

        .zaloga.red {
            color: #000;
            font-weight: bold !important;
        }


        .under-hero {
            display: flex;
            font-size: 14px;
            justify-content: space-evenly;
            margin-top: 0;
            background-color: #c80f01;
            color: #fff;
            border-radius: 0 0 4px 4px;
            padding: 6px 4px;
        }

        .bold1 {
            font-weight: 600;
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: left;
            line-height: 1.2;
        }

        #videodiv {
            position: relative;
        }

        .sale-ban {
            padding: 12px 16px;;
            background: rgba(7, 7, 7, 0.8);
            color: #F4F4F4;
            font-size: 14px;
            line-height: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            bottom: 0px;
            left: 0;
            width: 100%;
            font-weight: 600;
            z-index: 4;
        }

        .sale-ban > div {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            gap: 4px;
        }

        .icon-container {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
        }

        .white-bg {
            border-radius: 4px;
            margin: 0 0 0 6px;
            font-size: 14px;
            padding: 3px 5px;
            line-height: 1;
            background-color: #fff;
            color: #191d24;
            font-weight: 600;
        }

        .circle_holder {
            margin: 0;

            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 4px;
            gap: 8px;

            background: #C21225;
            border-radius: 4px;

            font-weight: 600;
            font-size: 14px;
            line-height: 14px;
            /* identical to box height, or 100% */

            text-align: center;

            color: #FFFFFF;
        }

        .circle_holder svg {
            fill: #FEFEFE;
            text-anchor: middle;
            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            /* identical to box height */

            text-align: center;
        }

        .images-3box {
            max-width: 500px;
            width: 100%;
        }

        .check-list {
            display: flex;
            margin-bottom: 10px;
        }

        #survey {
            max-width: 1000px;
            margin: auto;
            text-align: center;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        #survey .grid>h3 {
            font-size: 1.4em;
            margin-bottom: 20px;
            text-align: center;
        }

        #survey .sur h4 {
            margin-bottom: 15px;
            color: #22282f;
            line-height: 1;
            margin-bottom: 6px;
            margin-top: 6px;
            text-align: left;
        }


        #survey .grid>img {
            max-width: 130px;
            display: block;
            margin: 0 auto -50px;
        }

        #survey .sur {
            max-width: 450px;
            width: 100%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            font-size: 14px;
        }

        #survey .sur_res {
            display: flex;
            margin-bottom: 5px;
            justify-content: space-between;
        }

        .face-wr {
            display: flex;
            overflow-x: scroll;
            margin: auto;
            margin-top: 20px;
            width: 100%;
            max-width: 450px;
            -ms-scroll-snap-type: x mandatory;
            scroll-snap-type: x mandatory;
        }

        .face-item {
            scroll-snap-align: center;
            flex-shrink: 0;
            font-size: 14px;
            flex-direction: column;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            width: 85%;
            height: -webkit-fit-content;
            height: -moz-fit-content;
            height: fit-content;
            pointer-events: none;
            max-height: -moz-max-content;
            text-align: left;
        }

        .face-item,
        .face-item .head {
            display: flex;
        }

        .face-item {
            margin-left: 2.5%;
            margin-right: 2.5%;
        }


        .face-item,
        .face-item .head {
            display: flex;
        }

        .face-item .comment img,
        .face-item .head img {
            width: 30px;
            height: 30px;
            -o-object-fit: cover;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 10px;
            box-shadow: 0 10px 10px -5px rgb(51 51 85 / 21%);
        }

        .face-item .head .date {
            display: flex;
            align-items: center;
            font-size: 11px;
            margin-top: 3px;
            color: #b0b0b0;
        }

        .face-item p {
            font-size: 16px;
            margin-top: 20px;
            position: relative;
        }

        .bg-blue {
            background-color: #333333;
        }

        .select-qt {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            padding: 10px;
            border-radius: 10px;
            background-color: #f4f4f4;
            box-shadow: 0 2px 6px rgb(0 0 0 / 13%);
            border-top: 6px solid #4caf50;
        }

        .select-qt h3 {
            text-align: center;
            font-size: 1.6em;
            color: #22282f;
            line-height: 1;
            margin-bottom: 6px;
            margin-top: 6px;
        }

        .guarantee-badge {
            display: flex;
            position: relative;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            background-color: #4caf5026;
            color: #000;
            box-shadow: 0 0 0 1px rgb(164 66 17 / 10%), 0 10px 10px -5px rgb(76 37 18 / 38%);
            margin: 15px 0;
        }

        .guarantee-badge img {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            pointer-events: none;
            width: 74px;
            margin-right: 10px !important;
            height: 100%;
        }

        .guarantee-badge>div h4 {
            margin-top: 0;
            font-weight: 600;
            color: #000;
            line-height: 1;
            margin-bottom: 6px;
            margin-top: 6px;
        }

        .prev-image-wr {
            position: relative;
        }

        .prew-image {
            display: block;
            -o-object-fit: cover;
            object-fit: cover;
            max-width: 70% !important;
            margin: 0 auto 30px;
            background-color: #fff;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 8px 10px -2px rgb(0 0 0 / 24%), 0 0 0 1px rgb(83 97 112 / 5%);
        }

        .rating {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            padding: 0px;
            gap: 4px;

            font-weight: 400;
            font-size: 14px;
            line-height: 16px;
            /* identical to box height, or 114% */

            text-align: center;

            color: #070707;
        }

        .t11-advantage-image .gif {
            width: 300px;
        }

        html body .deliveryTimes {
            font-size: 13px;
        }

        html body .order-button-wrapper .agreement {
            font-size: 15px;
        }

        html body .season-banner-wrapper,
        html body .first-line,
        html body .phone-oper-note p {
            display: none !important;
        }

        html body .ws-hdr-navbar {
            margin-top: -6px;
        }

        html body .ws-hdr-wrapper {
            box-shadow: none;
            background-color: #333333;
        }

        html body .ws-hdr-navbar .txt-holder span {
            color: #fff;
        }

        html body .ws-hdr-navbar .logo-holder img {
            filter: invert(100%);
        }

        .phoneHeader {
            filter: invert(100%);
        }



        html body .t11-header {
            /*padding-top: 60px !important;*/
        }

        html body video {
            max-width: 500px;
            width: 100%;
            margin: 0px !important
        }

        .embedsocial-reviews {
            display: none !important;
        }

        html body div.chat-box div.chat-box-wrap div.chat {
            display: none !important;
        }

        html body .surprise-gift-box .headline .text-add {
            font-weight: bold;
            color: #000;
            font-size: 18px;
            background: #fff;
            padding: 4px 5px;
            border-radius: 5px;
        }

        html body .surprise-gift-box .headline .text-surprise-gift-title {
            line-height: 1.2;
            font-size: 17px;
            color: #fff;
        }

        html body .surprise-gift-box .headline label[for=surprise-gift]:before {
            max-width: 15px;
            width: 100%;
            height: 15px;
        }

        html body .surprise-gift-box .headline .text-add img {
            position: relative;
            top: 1px;
            max-width: 16px;
        }

        html body .surprise-gift-box .headline {
            padding-top: 10px;
        }

        html body #fb-root {
            display: none !important;
        }

        html body .surprise-gift-box {
            display: none !important;
        }

        html body .cstm_c_h_wrap {
            top: -1px;
        }

        html body .doki-mail a img {
            filter: initial!important;
        }

        html body .t3-button {
            background-color: #ee7b1c!important;
            background: #ee7b1c!important;
            color: #ffffff!important;
            font-size: 17px;
            letter-spacing: 1px;
        }

        /* html body .ft_l1_main_wrap_1 {
        background-color: #22282f!important;
        background: #333333!important;
        } */

        .sticky-bottom-line {
        background-color: #22282f!important;
        background: #22282f!important;
        display: none;
        justify-content: space-between;
        bottom: -1px!important;
        }

        html body .sticky-bottom-price {
            margin-left: 10px!important;
            margin-right: 10px!important;
        }

        html body  .new_p {
            font-size: 24px;
        }

        body .warranty-bonus-element img,
        body .shipping-bonus-element img,
        body .safety-bonus-element img {
            margin-right: 5px;
            height: fit-content;
        }

        body .order-form-bonus .bonus-button-wrapper span {
            display: flex;
            justify-content: center;
            align-items: center;
        }



        body .cstm_c_h_inner {
            padding: 8px 5px;
        }


        /* form fixes start */
        body .payment-choice {
            flex-flow: column!important;
            margin-top: 45px;
        }

        body #komentar {
            padding-top: 5px;
        }

        body .payment-choice .payment-card,
        body .payment-choice .payment-cod {
            padding: 10px 5px;
            cursor: pointer;
            border: 1px solid #c7c7c7;
            border-radius: 3px;
            background: #fff;
            margin-bottom: 10px;
            font-family:'Didact Gothic' , 'Varela Round', sans-serif, -apple-system,BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue"!important;
        }

        body div.input-item input,
        body div.input-item select,
        body div.input-item textarea {
            background-color: #fff;
            border-color: #c9c9c9;
            border: 1px solid #ccc;
            box-shadow: none;
            border-radius: 4px;
            color: #8c8d8e;
            min-height: 45px;
            line-height: 1;
            padding: 3px 7px 0;
            max-width: initial;
            width: 100%;
            display: block;
            float: none;
            margin: 0;
            font: 400 13.3333px Calibri;
            font-weight: 400;
            font-size: 12px;
            font-family:'Didact Gothic' , 'Varela Round', sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Open Sans","Helvetica Neue"!important;
            height: 40px;
            outline: none;
        }

        body .orderButton {
            height: inherit;
            line-height: initial;
            text-indent: 0;
            display: block;
            font-family:'Didact Gothic' , 'Varela Round', sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Open Sans","Helvetica Neue"!important;
            font-size: 26px;
            letter-spacing: -1px;
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
            text-align: center;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            float: none;
            width: 100%;
            background: #4caf50;
            color: #fff;
            padding: 20px 0px;
            margin: 20px auto 0px;
            box-shadow: none;
        }

        body .orderButton:hover {
            background: #1eab35;
        }

        body .fb-messenger-checkbox,
        body .order-button-wrapper span:nth-child(0) {
            display: none!important;
        }

        body div.payment-block input[type=radio]:checked+label,
        body div.payment-block input[type=radio]:not(:checked)+label,
        body div.payment-choice input[type=radio]:checked+label,
        body div.payment-choice input[type=radio]:not(:checked)+label {
            font-size: 15px;
        }

        body .order-form-bonus {
        width: 100%;
        max-width: 450px;
        margin-top: 7px;
        }

        body .order-form-wrapper, .safety-bonus-element {
        width: 100%;
        }

        body .order-form-bonus .bonus-title {
        width: 100%;
        background-color: #292938;
        padding: 12px 9px;
        cursor: pointer;
        border-bottom: 1px solid #ffff;
        margin-bottom: 5px;
        background-color: #e9ffec;
        border-radius: 4px;
        border: 2px solid red;
        border-color: #4caf50;
        }

        body .safety-bonus-element img{
        max-width: 45px;
        }
        body .shipping-bonus-element img{
        max-width: 45px;
        }

        body .warranty-bonus-element img{
        max-width: 45px;
        }

        body .order-form-bonus .bonus-title p,
        body .order-form-bonus .bonus-button-wrapper {
            margin:0px;
            color: #333;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
            font-family:'Didact Gothic' , 'Varela Round', sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Open Sans","Helvetica Neue"!important;
            width: 50%;
        }

        body .order-form-bonus .bonus-title p {
        margin-right: auto;

        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;

        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        }

        body .order-form-bonus .bonus-button-wrapper {
        margin-left: auto;
        }

        body .order-form-bonus .bonus-button-wrapper span{
            margin-left: auto;
            margin-right: 7px;
            color: red;
            font-size: 14px;
            font-weight: 500;
        }

        body .order-form-bonus .bonus-button-wrapper span:active{
        padding-top: 14px;
        }

        body .shipping-bonus-element .bonus-title,
        body .shipping-bonus-element .additional-info,
        body .warranty-bonus-element .bonus-title,
        body .warranty-bonus-element .additional-info{
        background-color: #fff!important;
        border-color: #d4ded6!important;
        }

        body .order-form-bonus .bonus-button-wrapper button {
            font-family: inherit;
            vertical-align: baseline;
            border: 0;
            outline: 0;
            cursor: pointer;
            display: inline-block;
            color: #fff!important;
            text-decoration: none;
            line-height: 1;
            border-radius: 0px;
            width: 100%;
            background: #41cc02;
            transition: box-shadow .2s,background .2s;
            font-weight: 900;
            text-transform: uppercase;
            position: relative;
            top: 0px;
            background: #305388;
            box-shadow: none;
            max-width: 80px;
            padding: 1em 0.25em 1em;
            font-size: 10px;
        }

        body .order-form-bonus .additional-info p {
            margin: 0px;
            color: #333;
            font-size: 14px;
            line-height: 1.4;
            font-family:'Didact Gothic', 'Varela Round', sans-serif, -apple-system,BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue"!important;
        }

        body .order-form-bonus .additional-info {
            background-color: #e9ffec;
            padding: 12px 2.5%;
            margin-top: -5px;
            margin-bottom: 5px;
        }

        body .order-form-bonus .bonus-button-wrapper button.clicked {
            box-shadow: none;
            color: #fff!important;
            background: #41cc02;
        }

        body .the-messenger-note {
            display: none;
        }

        body .deliveryTimes {
            margin-bottom: 15px;
        }
        /* form fixes end */



        /*.pr {*/
        /*        background: #fff!important;*/
        /*        border: 1px solid #000!important;*/
        /*    }*/

        /* MEDIA QUERIES START
        ------------------------------------------------------- */
        @media screen and (max-width:768px) {
            .t11-logo {
                max-width: 120px;
                max-height: 35px;
                position: relative;
                top: 3px;
            }

            .t11-button {
                line-height: 32px;
                font-size: 16px;
            }

            .t11-header {
                /*padding-top: 95px;*/
                margin-bottom: 30px;
                margin-top: 0;
            }

            .t11-header .t11-price1 .t11-price-before-discount {
                margin-left: initial;
            }

            .t11-header .t11-header-text h1 {
                font-size: 34px;
                line-height: 1;
                text-align: center;
            }

            .t11-header .t11-header-text p {
                font-size: 22px;
                line-height: 1.2;
                text-align: center;
            }

            .t11-header .t11-wrapper {
                flex-flow: column;
            }

            .t11-header .t11-header-text {
                order: 2;
                justify-content: center;
                align-items: center;
            }

            .t11-header .t11-header-image {
                order: 1;
            }

            .t11-benefit-image img {
                max-width: 80px;
            }

            .t11-advantage-image {
                order: 1 !important
            }

            .t11-benefit-box .t11-benefits,
            .t11-benefit-box .t11-benefit-single-image,
            .t11-selector .t11-selector-text .t11-quantity .t11-select {
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                /**/
                width: 100%;
                margin: 0;
                /* column */
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-flow: column;
                flex-flow: column;
            }

            .t11-selector .t11-selector-text .t11-quantity .t11-select .button-holder {
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;

                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;

                margin-top: 20px;
            }

            .t11-testimonials-box .t11-wrapper div {
                flex: initial;
                margin: 0 0 20px;
                max-width: 300px;
            }

            .t11-header .t11-header-text .t11-header-benefits-holder .t11-header-benefits-item p {
                font-size: 12px;
            }

            .t11-benefit-box .t11-benefit-item .t11-benefit-text h4 {
                font-size: 22px;
                line-height: 1.3;
                margin-bottom: 5px;
            }

            .t11-benefits .t11-benefit-item,
            .t11-header-text,
            .t11-header-image,
            .t11-advantage-text.flex-1,
            .t11-advantage-image.flex-1,
            .t11-advantages .t11-advantage-item,
            .t11-postage-box .t11-postage-01,
            .t11-postage-box .t11-postage-02,
            .selector-slider.flex-1,
            .t11-selector-text.flex-1,
            .t11-specification-box .specs .specs-item.flex-1,
            .gallery-item,
            .t11-specification-box .specs .c063 {
                flex: initial;
            }

            .t11-specification-box h2,
            .t11-advantages .t11-advantage-item,
            .t11-benefits .t11-benefit-item,
            .t11-testimonials-box .t11-testimonials-title {
                margin-bottom: 15px;
            }

            .t11-specification-box .specs .c063 {
                padding-top: 0;
                padding-bottom: 0
            }

            .t11-specification-box .specs .specs-item {
                padding-top: 0;
                padding-bottom: 0;
            }

            .t11-advantages .t11-advantage-item:nth-child(even) .t11-advantage-text {
                order: initial;
            }

            .t11-selector .t11-price2 .t11-price-before-discount {
                font-size: 20px;
            }

            .t11-selector .t11-price2 .t11-price-after-discount {
                font-size: 30px;
            }

            .t11-selector-box .t11-selector .t11-description p,
            .t11-selector-box .t11-selector .t11-select span {
                font-size: 19px;
            }

            .t11-header .t11-price1 {
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                width: 103%;
                padding: 0;
                margin-top: 10px;
            }

            .t11-order-form-item,
            .t11-order-form-media-holder {
                width: 100%;
                margin: 0 auto;
                float: none;
                max-width: 450px;
            }

            .t11-benefits .t11-benefit-item:first-child,
            .t11-advantages .t11-advantage-item:first-child {
                margin-top: 20px;
            }

            .t11-selector-box .t11-selector select {
                max-width: 200px;
                font-size: 20px;
                padding: 5px 20px 5px 5px;
                margin-top: 1px;
            }

            .t11-selector-box .t11-selector button {
                font-size: 22px;
                width: 95%;
                max-width: 100%;
            }

            .t11-selector .t11-price2 {
                position: relative;
                top: 10px;
            }

            .specs-item {
                padding: 0 10px;
            }

            .description_table,
            .description_table table {
                margin: 5px auto;
                float: none;
                display: block;
                border: none;
                max-width: 315px;
            }

            .t11-selector .c086 .c038 img {
                width: 60px;
            }

            .c034 .c053 {
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .t11-order-form .t11-order-form-item .t11-order-form-media-holder {
                margin-top: 15px;
            }

            .t11-360-box h2 {
                font-size: 28px;
            }

            .t11-360-box #canvas {
                width: 97%;
                height: 97%;
            }

            .t11-360-box .c034 .c007 {
                position: relative;
                top: -38px;
            }

            #text-second {
                margin: 0 0 18.5px;

                font-weight: 400;
                font-size: 16px;
                line-height: 24px;
                /* or 150% */


                color: #6B6B6B;

                /*margin-bottom: 10px;*/
                text-align: left;
            }

            #text-3 {
                margin: 0 0 8px;

                font-weight: 600;
                font-size: 24px;
                line-height: 32px;
                /* or 133% */


                color: #171717;

                /*margin-top: 6px;*/
                text-align: left;
            }

            #videodiv {
                margin: 0 0 24px;
            }

            .iner-wrraper {
                width: 92%;
            }

            .sale-ban {
                bottom: 0px;
            }

            body .modular-form-wrapper {
                width: 98%;
            }

            body .order-form-bonus .bonus-title {
                padding: 12px 5px;
            }

            .sticky-bottom-line {
            display: flex;
            }

            html body .order-button-wrapper .agreement {
                font-size: 10px;
            }


        }

        @media(max-width: 479px) {

            html body .surprise-gift-box .headline .text-add {
                font-size: 15px;
            }

            html body .surprise-gift-box .headline .text-surprise-gift-title {
                font-size: 14px;
            }

            .stage {
                /*display: block;*/
                /*position: relative;*/
                /*top: -10px;*/
                /*left: -72px;*/
            }

            .box-new {
                /*margin-right: -44px;*/
            }

            .t11-advantage-image .gif {
                width: 255px;
            }

            .t11-advantage-image img {
                max-width: 255px;
            }

            .select-qt {
                width: 98%;
            }

            .guarantee-badge img {
                position: absolute;
                right: -20px;
                top: -20px;
                width: 50px;
                height: auto;
            }

            .select-qt h3 {
                font-size: 1.17em;
            }

        }

        /* MEDIA QUERIES END
        ------------------------------------------------------- */
        /* !!! DAS ENDE !!! */
    </style>
@endpush

<script>
    $('.pages div:contains("1")').click(function(){
        $('.testpage1').show().addClass('testpagecontents');
        $('.testpage2').hide().removeClass('testpagecontents');
        $('.pages div:contains("1")').addClass('active');
        $('.pages div:contains("2")').removeClass('active');
    });

    $('.pages div:contains("2")').click(function(){
        $('.testpage2').show().addClass('testpagecontents');
        $('.testpage1').hide().removeClass('testpagecontents');
        $('.pages div:contains("2")').addClass('active');
        $('.pages div:contains("1")').removeClass('active');

    });





    // Add payment method text for template maa_tmpl_11
    if(typeof(tmpl_) != 'undefined' && tmpl_ == 'maa_tmpl_11'){
        let paymentMethodText = $('.margin-top-mob-small h5:first-child').text();
        $( "<span class='input-item-title paymentmeth' style='top: 35px'>"+ paymentMethodText +"</span>" ).insertBefore( ".module_3" );
    }

    $(document).ready(function() {
        let productOfTheDaySku = localStorage.getItem('productOfTheDay');
        let productSku = $(".cart-add").attr("data-sku")
        if (productOfTheDaySku === productSku){
            $(".userChoice").hide();
            $(".current").html(`{{$noShipping}}{{env('CURRENCY')}}`);
            $('.cart-add').attr('data-price', {{$noShipping}} )
        }
    });
</script>
