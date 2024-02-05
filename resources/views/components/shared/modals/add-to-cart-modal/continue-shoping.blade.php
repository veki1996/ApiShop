@php use App\Helpers\ContentHelper; @endphp
<div class="centerV centerH popToCart">
    <a href="{{route ('page.shop') }}{{ \App\Helpers\RouteHelper::appendParameters() }}"
        class="continueShopping centerV aWidth" id="side-go-to-cart">
        {{ ContentHelper::staticText('seeOtherProducts')  }}
    </a>
</div>
