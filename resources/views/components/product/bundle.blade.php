<?php  use App\Helpers\ContentHelper; ?>
<div class="page-free-bundle-main">
    <div class="page-free-bundle border-color-primary">
        <div class="free-bundle-title-wrapp bg-color-primary">
            <h3 class="free-bundle-title txt-color-primary">{{ContentHelper::staticText('freeGift') }}</h3>
        </div>
        <div class="free-bundle-info parent row v-center">
            <div class="bundle-img"><img src="{{ env('APP_URL') }}/{{ $bundleProduct['image'] }}"></div>
            <div class="bundle-product-info">
                <div class="bundle-product-info-head">
                    <p> <span>{{ContentHelper::staticText('freeGift') }}</span> - <br> {{ $bundleProduct['name'] }}</p>
                </div>
                <div class="bundle-product-info-txt">
                    <p>{{ $bundleProduct['long_desc'] }}</p>
                </div>
            </div>
        </div>
        <div class="page-free-bundle-gift"><img src="/static/krisgift.png"></div>
    </div>
</div>

<style>
    .page-free-bundle-main {
        position: relative;
        max-width: 700px;
        width: 100%;
        height: auto;
        margin: 60px auto 80px;
        transition: all .15s ease-out;
        box-sizing: border-box;
        display: block;
    }

    .page-free-bundle {
        position: relative;
        max-width: 500px;
        width: 100%;
        height: auto;
        margin: 0 auto;
        outline: none;
        background: #fff;
        box-sizing: border-box;
        border: none !important;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25) !important;
        border-radius: 10px 10px 0px 0px !important;
    }

    .free-bundle-title-wrapp {
        border-radius: 10px 10px 0px 0px !important;
        background-color: #FFC107 !important;
    }

    .page-free-bundle .free-bundle-title {
        text-align: center;
        font-size: 30px;
        font-weight: 700;
        border-radius: 1px 1px 0px 0px;
        text-transform: none !important;
        padding: 12px 0px;
        color: #000;
    }

    .bundle-product-info-head {
        font-weight: 700;
        font-size: 18px;
    }
    .bundle-product-info-head p span {
        text-transform: uppercase;
        padding-bottom: 10px !important;
    }

    .bundle-product-info-txt {
        width: 93%;
    }

    .page-free-bundle-gift {
        position: absolute;
        bottom: -60px;
        right: -130px;
        width: fit-content;
        height: fit-content;
    }

    .page-free-bundle .bundle-img img {
        width: 250px;
        margin-bottom: 5px;
    }

    @media screen and (max-width: 769px) {
        .page-free-bundle-main {
            margin: 80px auto 27px;
        }

        .page-free-bundle .free-bundle-title {
            font-size: 24px;
        }

        .page-free-bundle .free-bundle-info {
            flex-flow: column;
        }

        .bundle-product-info {
            margin: 0px !important;
        }

        .bundle-product-info-head {
            text-align: center;
        }

        .bundle-product-info-txt {
            width: 100%;
            text-align: center;
        }

        .page-free-bundle-gift {
            top: -62px;
            left: 43%;
        }

        .page-free-bundle-gift img {
            max-width: 65px;
            width: 100%;
        }

    }
</style>
