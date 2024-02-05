@php
    use App\Helpers\ContentHelper;
@endphp
<p class="deliveryDate padding">{!! str_replace(":deliveryDate", $product->deliveryDisplay, ContentHelper::staticText('deliveryDate') ) !!}</p>
<p class="freeDelivery">{!!  ContentHelper::staticText('freeDelivery')  !!} <img src="{{ env('APP_URL') }}/static/freeDelivery.png" alt="" ></p>