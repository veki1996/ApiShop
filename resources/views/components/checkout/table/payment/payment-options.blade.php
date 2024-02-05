@php use App\Helpers\ContentHelper; @endphp
<div class="paypay">
    <div class="yourInfo"> {{ ContentHelper::staticText('paymentOptions') }}</div>
    <div class="checkout-payment-block flex col">
        @each('components.checkout.table.payment.payment-option', (new \App\Helpers\PaymentSettings())->getPaymentProcessors(), 'paymentProcessor')
    </div>
</div>
