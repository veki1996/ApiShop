@php use App\Helpers\ContentHelper; @endphp

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/order-info.css">
@endpush

<div class="checkout-order-info">
    <div class="order-info-title">
        <h1>{{  ContentHelper::staticText('yourOrder') }}</h1>
    </div>
    <div class="order-products">
        <h4>{{ContentHelper::staticText('proizvodi') }}</h4>
        <div class="order-products-data"></div>
    </div>
    <div class="order-services">
        <h4>{{ContentHelper::staticText('services') }}</h4>
        <div class="order-services-data"></div>
    </div>
    <div class="total-checkout-price">
        <b>{{ContentHelper::staticText('total') }}</b>
        <b id="old-value" ></b>
        <b class="total-price">1$</b>
        
    </div>
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/checkout/order-info.js"></script>
{{--    <script>--}}
{{--        const displayValidCoupon = () => {--}}
{{--            $('#coupon').css('background', 'rgb(234, 249, 240)')--}}
{{--            $('.invalid_coupon').hide()--}}
{{--            $('.valid_coupon').show()--}}

{{--            $('span.noCoupon').hide()--}}
{{--            $('span.activeCoupon').show()--}}
{{--        }--}}

{{--        const displayInvalidCoupon = () => {--}}
{{--            $('#coupon').css('background', 'white')--}}
{{--            $('.invalid_coupon').show()--}}
{{--            $('.valid_coupon').hide()--}}

{{--            $('span.noCoupon').show()--}}
{{--            $('span.activeCoupon').hide()--}}
{{--        }--}}

{{--        const displayCartItems = () => {--}}
{{--            let display = ''--}}

{{--            cart.products.forEach(product => {--}}
{{--                display += `<div class="flex row ">--}}
{{--                                <div class="cell mw245px">${product['name']}</div>--}}
{{--                                <div class="cell mw75px">${product['quantity']}x</div>--}}
{{--                                <div class="cell mw160px">${product['price'].toFixed(2)}{{env('CURRENCY')}}--}}

{{--                                    </div>--}}
{{--                            </div>`--}}
{{--            })--}}

{{--            $('#cart-items-list').html(display)--}}
{{--            $('.checkout_total_price').text(`${cart.totalPrice.toFixed(2)} {{env('CURRENCY')}}/`)--}}
{{--        }--}}

{{--        $(() => {--}}
{{--            displayCartItems()--}}

{{--            $('#checkCoupon').on('click', e => {--}}
{{--                $.ajax({--}}
{{--                    url: '{{route('coupons.validate')}}',--}}
{{--                    type: 'POST',--}}
{{--                    data: {--}}
{{--                        phoneNumber: $('#phone').val(),--}}
{{--                        code: $('#coupon').val(),--}}
{{--                        cartValues: {--}}
{{--                            total: $('span.noCoupon > span.checkout_total_price').--}}
{{--                                text().--}}
{{--                                replace('{{env('CURRENCY')}}', ''),--}}
{{--                        },--}}
{{--                    },--}}
{{--                    success (response) {--}}
{{--                        if (response.success) {--}}
{{--                            $('span.afterCouponTotal').--}}
{{--                                text(`${response['discountedPrices']['total']} {{env('CURRENCY')}}`)--}}

{{--                            displayValidCoupon()--}}
{{--                            cart.addCoupon(response)--}}
{{--                            return--}}
{{--                        }--}}

{{--                        displayInvalidCoupon()--}}
{{--                        cart.removeCoupon()--}}
{{--                    },--}}
{{--                    error (xhr, status, error) {--}}
{{--                        console.log(xhr.responseText)--}}

{{--                        displayInvalidCoupon()--}}
{{--                    },--}}
{{--                })--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endpush
