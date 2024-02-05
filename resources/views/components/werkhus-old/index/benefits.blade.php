@php use App\Helpers\ContentHelper; @endphp


<div class="ws-frilla-icon-benefits-box parent column h-center v-center">
    <div class="ws-frilla-wrapper-full parent row">
        <div class="ws-frilla-icon-benefits-item parent h-center v-center column flex-1">
            <div class="icon parent h-center v-center">
                <img src="{{env('APP_URL')}}/static/insurance2.png">
            </div>
            <div class="txt-container">
                <div class="txt parent h-center v-center">
                    <p class="bold"> {!!ContentHelper::staticText('packageInsurance')  !!} </p>
                </div>
                <div class="txt parent h-center v-center">
                    <p class="desc"> {!!ContentHelper::staticText('qualityDelivery')  !!} </p>
                </div>
            </div>
        </div>
        <div class="ws-frilla-icon-benefits-item parent h-center column flex-1">
            <div class="icon parent h-center v-center">
                <img src="{{env('APP_URL')}}/static/delivery2.png">
            </div>
            <div class="txt-container">
                <div class="txt parent h-center v-center">
                    <p class="bold"> {!!ContentHelper::staticText('quickDelivery')  !!} </p>
                </div>
                <div class="txt parent h-center v-center">
                    <p class="desc"> {!!ContentHelper::staticText('euStore')  !!} </p>
                </div>
            </div>
        </div>
        <div class="ws-frilla-icon-benefits-item parent h-center column flex-1">
            <div class="icon parent h-center v-center">
                <img src="{{env('APP_URL')}}/static/return.png">
            </div>
            <div class="txt-container">
                <div class="txt parent h-center v-center">
                    <p class="bold">{!!ContentHelper::staticText('easyReturn')  !!}</p>
                </div>
                <div class="txt parent h-center v-center">
                    <p class="desc">{!!ContentHelper::staticText('44daysReturn')  !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ws-frilla-icon-benefits-item:last-child .txt:first-child p:first-letter {
        text-transform: uppercase;
    }
</style>
