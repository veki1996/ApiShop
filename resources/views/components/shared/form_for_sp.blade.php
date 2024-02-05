@php
use App\Helpers\ContentHelper;
use App\Helpers\FeeHelper;
@endphp

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/checkout.css">
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/cart-form.css">
@endpush

@section('head')
    @include('components.checkout.head')
@stop

<div class="ws_checkout-main flex column">
            <div class="qtySelectorSp">
                <div class="formLayer">
                    {{ContentHelper::staticText('formLayer') }}
                </div>
                <div class="yourQty">
                    {{ContentHelper::staticText('yourQty') }}
                </div>
                @include('components.product.price-quantity-selector',
                        [
                    'price_01'     => $product->prices->forOne,
                    'noShipping'   => $product->prices->noShipping ?? $product -> prices -> forOne,
                        ]
                )
            </div>
            {{-- order form --}}
            @include('components.checkout.form.form')

            {{-- order display --}}
            @include('components.checkout.table.table', compact('feeHelper'))
 </div>



@push('body-js')
    <script src="{{env('APP_URL')}}/js/Form.js"></script>
    <script>


        const form = new Form('{{route('order.create')}}', '{{route('order.klarna.update')}}');

        if (typeof fbq === 'function') {
                fbq(
                    'track',
                    'InitiateCheckout',
                    {
                        content_ids: cart.products.map(product => product.sku),
                        value: cart.totalEurPrice,
                        num_items: cart.products.length,
                    },
                )
            }

    </script>

@endpush
