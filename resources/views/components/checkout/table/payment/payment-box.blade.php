<div class="payment-box {{ $paymentProcessor->name }}-payment-box" data-system="{{ $paymentProcessor->name }}"
    style="display: none;">
    <div class="checkout-loader" style="display: none;"><img src="{{ env('APP_URL') }}/svg/loader.svg"></div>
    <form id="credit-card-flow" class="sr-credit-card-form">
        <div class="card-element" id="{{ $paymentProcessor->name }}-card-element">
            @includeIf('components.checkout.payment-processors.' . $paymentProcessor->name)
        </div>
        <button type="submit" class="stripe_submit_btn" style="display:none;"></button>
        <span class="error-message" style="color:red;"></span>
    </form>
</div>
