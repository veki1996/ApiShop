@php use App\Helpers\ContentHelper; @endphp

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/order-button.css">
@endpush

<div class="complete-order"  id="order-button">
    <a class="orderButton ws_submit_btn button-colors" >{{ContentHelper::staticText('sendNow') }}</a>
    <img src="{{ env('APP_URL') }}/static/arrow-right-white.png" alt="">
</div>


@push('body-js')
    <script src="{{ env('APP_URL') }}/js/checkout/order-button.js"></script>
   <script>
       $(() => { $('.payment-radio:first').trigger('click') })

   const trackOrder = () => {
          const lastAddedProduct = cart.products[cart.products.length - 1]
          const productPrice = Number(lastAddedProduct.price_1x)

          if (typeof gtag === 'function') {
              gtag(
                  'event',
                  'conversion',
                  {
                      'send_to': `{{$trackingCodes->awCode}}/{{$trackingCodes->awConvLabel}}`,
                      'value': cart.totalEurPrice,
                      'currency': 'EUR',
                  },
              )
          }

          if (typeof pintrk === 'function') {
              pintrk(
                  'track',
                  'checkout',
                  {
                      value: cart.totalEurPrice,
                      currency: 'EUR',
                      order_id: form.omgId,
                      order_quantity: lastAddedProduct.quantity,
                      line_items: [
                          {
                              product_name: lastAddedProduct.name,
                              product_price: productPrice,
                              product_category: lastAddedProduct.googleCategories,
                              product_id: lastAddedProduct.sku,
                              product_quantity: lastAddedProduct.quantity,
                          },
                      ],
                  },
              )
          }

          if (typeof ttq === 'object') {
              const tiktokData = {
                  content_id: lastAddedProduct.sku,
                  content_type: 'product',
                  content_name: lastAddedProduct.name,
                  quantity: lastAddedProduct.quantity,
                  value: productPrice,
                  currency: 'EUR',
              }

              ttq.track('orde', tiktokData)
              ttq.track('PlaceAnOrder', tiktokData)
          }
      }

    //   $('#order-button').on('click', () => {
    //       if (!form.isValid()) {
    //           form.displayErrors()
    //           return false
    //       }

    //       if (cart.paymentMethod === 'stripe') {
    //           stripe.confirmPayment({})
    //           return
    //       }

    //       localStorage.removeItem('complementaryProducts');

    //       form.createOrder({}, () => {
    //           trackOrder(); 
            
    //           if(cart.paymentMethod == 'cod') {
    //               location.href = '{{env('APP_URL')}}/crossell?hash='+ form.hash;
    //           }else{
    //               location.href = '{{env('APP_URL')}}/thanks'; 
    //           }
    //       })
    //   })
  </script>
@endpush
