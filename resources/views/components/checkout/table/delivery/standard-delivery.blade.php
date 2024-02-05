@php use App\Helpers\ContentHelper; @endphp
<div class="standardType option-btn delivery-btn"
     data-sku="{{$feeHelper->priorityDeliverySku()}}"
     data-price="{{$feeHelper->priorityDeliveryCost()}}"
     data-name="{{ContentHelper::staticText('priorityDelivery') }}"
     data-standard="true"
>

    <div class="payment-cod">
        <input type="radio" name="payment" id="cod" value="cod" checked="checked">
        <label for="payment" class="payment-label-cod">
            <div class="shippingType">
                <div class="typeTitle standard">
                    
                </div>
            </div>
            <div class="shippingTypeIcon">
                <img src="{{env('APP_URL')}}/static/standardShipping.png" alt="Standard Shipping Icon">
            </div>
        </label>
    </div>
</div>
