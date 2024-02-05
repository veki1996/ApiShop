<div class="greenLine center">
    <div class="slide">
        <div class="freeShippingText">
            {{ContentHelper::staticText('freePostage')  }} {!! isset($deliveryText) ? str_replace(":deliveryDate", $deliveryText, ContentHelper::staticText('deliveryDate') ) : ContentHelper::staticText('quickDelivery')  .' ' . "!" !!}
        </div>
    </div>
</div>
