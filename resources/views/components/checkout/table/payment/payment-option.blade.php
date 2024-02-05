    @php use App\Helpers\ContentHelper; @endphp
    @if ($paymentProcessor->css)
        @push('head-css')
            <link rel="stylesheet" href="{{ $paymentProcessor->css }}">
        @endpush
    @endif

    <a class="payment-btn option-btn parent row  box-link" data-payment="{{ $paymentProcessor->name }}"
        data-init="initialize{{ ucfirst($paymentProcessor->name) }}">
        <div class="payment-item parent row payment-cod ">
            <input class="payment-radio" type="radio" >
            <label for="payment" class="payment-label-cod">
                <div class="payment-label-cod-text">
                    <div class="paymentName">
                        {{ $paymentProcessor->name != 'paypal' ? ContentHelper::staticText($paymentProcessor->name) : 'PayPal' }}
                    </div>
                    <div class="payment-label-price">
                        + 0.00 {{ env('CURRENCY') }}
                       
                    </div>
                </div>
                <img src="{{ env('APP_URL') }}/static/{{ $paymentProcessor->iconFilename }}" class="paymentImg">
            </label>
        </div>
    </a>
    @include('components.checkout.table.payment.payment-box')

    @if ($paymentProcessor->js)
        @push('body-js')
            <script src="{{ $paymentProcessor->js }}"></script>
        @endpush
    @endif

    @push('body-js')
        @includeIf(
            'components.checkout.payment-processors.js.' . $paymentProcessor->name,
            compact('paymentProcessor'))
    @endpush
