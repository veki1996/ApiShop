@php use App\Helpers\ContentHelper; @endphp
<div class="centerV centerH popToCart">
    <a href="{{ env('APP_URL') }}/cart{{ \App\Helpers\RouteHelper::appendParameters() }}"
        class="checkout-btn  centerV aWidth" id="side-go-to-cart">{{ ContentHelper::staticText('popUpGoToCart')  }}
        <img alt="arrow forward" src="{{ env('APP_URL') }}/static/arrow_forward.png">
    </a>
</div>