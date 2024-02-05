@php use App\Helpers\ContentHelper; @endphp

<div class="safty">
    <div class="saftyUnit">
        <div class="lock"><img src="{{env('APP_URL')}}/svg/money_back.svg">
        </div>
        <div class="saftyText">
            <p><b>44 {{ContentHelper::staticText('days') }}</b></p>
            <p>{{ContentHelper::staticText('moneyBackGuarantee') }}</p>
        </div>
    </div>

    <div class="saftyUnit">
        <div class="lock">            <img src="{{env('APP_URL')}}/svg/cod.svg">
        </div>
        <div class="saftyText">
            <p><b>{{ContentHelper::staticText('payCourier') }}</b></p>
{{--            <p>{{ContentHelper::staticText('saftyShopping')}}</p>--}}
        </div>
    </div>
 
</div>

<div class="saftyUnit ssl-container">
    <div class="lock"><img src="{{env('APP_URL')}}/svg/lock.svg">
    </div>
    <div class="saftyText">
        <p>{{ContentHelper::staticText('verifiedAndSecured') }}</p>
        <p><b>{{ContentHelper::staticText('ssl') }}</b></p>
    </div>
</div>

<style>
    .safty{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: flex-start;
        gap: 16px;

        margin-bottom: 16px;
    }
    .saftyUnit{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 0px;
        gap: 8px;

        height: auto;
    }
    .saftyUnit.ssl-container {
        margin: 0 auto 20px;
        width: auto;
    }
    .lock {
        width: auto;
        flex: none;
    }
    .lock img{
        width: 48px;
        height: 48px;
    }
    .saftyText{
        width: auto;

        font-weight: 400;
        font-size: 12px !important;
        line-height: 14px;

        color: #070707;
    }
    .saftyText p{
        margin: 0;
    }
    .ssl-container img {
        width: auto;
        height: auto;
    }
    @media only screen and (max-width: 426px) {
        .saftyText{
        font-size: 13px;
        }
        .addedToCartPopp {
            height: 420px;
        }
        .saftyUnit{
            height: 54px;
        }
        .lock{
            margin-right: 0px;
        }
    }
</style>