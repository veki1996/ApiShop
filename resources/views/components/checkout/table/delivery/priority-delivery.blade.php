@php use App\Helpers\ContentHelper; @endphp
<div class="the-btn typeFast option-btn delivery-btn"
     data-sku="{{$feeHelper->priorityDeliverySku()}}"
     data-price="{{$feeHelper->priorityDeliveryCost()}}"
     data-name="{{ContentHelper::staticText('priorityDelivery')  }}">

    <div class="payment-cod">
        <input type="radio" name="payment" id="cod" value="cod">
        <label for="payment" class="payment-label-cod">
            <div class="shippingType">
                <div class="typeTitle priority">
                    
                </div>
            </div>
            <div class="shippingTypeIcon">
                <img src="{{env('APP_URL')}}/static/fastShipping.png" alt="Fast Shipping Icon">
            </div>
        </label>
    </div>
</div>
