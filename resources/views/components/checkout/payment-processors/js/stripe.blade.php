<script>
    let stripe = null;

    function initializeStripe () {
        stripe = new StripePayment()
        stripe.initialize()
        
        $(".standardType").click(function() {
        stripe.updateAmount()
        })

        $(".typeFast").click(function() {
        stripe.updateAmount()
        })

        $(".bonusBtnStyle").click(function() {
        stripe.updateAmount()
        });

        $('body').on('click', '.remove-service', function() {
        stripe.updateAmount();
        }
        )
    }

    class StripePayment {
        construct () {
            this.intent = null
        }

        async updateCart() 
        {
            cart.update();
            return cart;
        }


        async initialize () {
            let loader = $('.checkout-loader')
            $('.complete-order').show()
            loader.show()
            $('.complete-order').show()

            const cart = await this.updateCart()
            const intent = await this.getIntent(cart)

            let stripe = new Stripe('{{ $paymentProcessor->publicKey }}',
                { locale: '{{ strtolower(env('COUNTRY_CODE')) }}' })
            let elements = stripe.elements({ clientSecret: intent.client_secret })

            let card = elements.create(this.getProvider(), this.getProviderSettings())

            card.mount('#stripe-card-element')

            card.on('change', function (event) {
                if (event.error) {
                    // insightCheck(false, event.error['code'], event.error['message']);
                }
            }).on('ready', function () {
                loader.hide()
            })

            this.stripe = stripe
            this.card = card
            this.client_secret = intent.client_secret

            cart.paymentMethod = 'stripe'
            cart.paymentSystem = this.getProvider()
        }

        /**
         * Handles provider routing for countries with custom providers
         *
         * @returns {string}
         */
        getProvider () {
            let countryCode = '{{ env('COUNTRY_CODE') }}'

            // if (countryCode === 'PL') { return 'p24Bank' }
            if (countryCode === 'NL') { return 'idealBank' }

            return 'card'
        }

        /**
         * Handles card setting routing and custom providers
         *
         * @returns Object
         */
        getProviderSettings () {
            const countryCode = '{{ env('COUNTRY_CODE') }}'
            const cardStyle = {
                base: {
                    color: '#32325d',
                    fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#69737d',
                    },
                },
                complete: {
                    '::placeholder': {
                        color: '#18c32a',
                    },
                },
                invalid: {
                    color: '#eb1c26',
                    ':focus': {
                        color: '#FA755A',
                    },
                    '::placeholder': {
                        color: 'red',
                    },
                },
            }

            if (countryCode === 'PL' || countryCode === 'NL') { return { style: cardStyle } }

            return { style: cardStyle, hidePostalCode: true }
        }

        /**
         * Fetches Stripe purchase intent
         *
         * @returns {Promise<any>}
         */
        async getIntent (cart) {

            let response = await fetch('{{ route('payment.stripe.create-intent') }}', {
                method: 'POST',
                body: JSON.stringify({
                    'amount': cart.totalPrice,
                    'currency_code': cart.currency,
                }),
            }).then((response) => response.json())

            if (!response.success) {
                // TODO: Error handling
            }

            this.intent = response

            return response
        }

        /**
         * Updates amount of Stripe intent
         *
         * @returns {Promise<any>}
         */
        async updateAmount () {

            let body = {
                'intent_id': this.intent['id'],
                'amount': cart.totalPrice,
            }

            let response = await fetch('{{ route('payment.stripe.update-amount') }}', {
                method: 'POST',
                body: JSON.stringify(body),
            }).then((response) => response.json())

            if (!response.success) {
                // TODO: Error handling
                return null
            }

            this.client_secret = response.client_secret
            return response
        }

        /**
         * Routes payment confirmation to proper method based on payment system
         *
         * @param payload
         */
        confirmPayment (payload) {
            let data = {...form.getFormData(), clientSecret: this.client_secret, card: this.card}

            if (cart.paymentMethod === 'stripe') {
                this.cardFlow(data, payload)
                return
            }

            this.providerFlow(cart.paymentSystem, data, payload)
        }

        /**
         * Handles confirmation of payment intent for card purchases
         *
         * @param stripeData
         * @param systemData
         */
        cardFlow (stripeData, systemData) {

            $('.checkout-loader').show()

            let stripePayment = this
            //this.updateAmount()

            this.stripe.confirmCardPayment(
                stripeData.clientSecret,
                { payment_method: { card: stripeData.card } },
            ).then(function (result) {
                if (result.error) {
                    $('.checkout-loader').hide()
                    $('#credit-card-flow .error-message').empty().append(result.error.message)

                    // TODO: Implement error tracking
                    // errorTracking("Stripe error: ", result.error.message + 'order data: ' + JSON.stringify(systemData) );
                    throw new Error(
                        'Stripe error: ' + result.error.message + 'order data: ' + JSON.stringify(systemData))
                }

                $('.checkout-loader').show()
                // TODO: Move state setter to Cart.js
                //cart.confirmPayment()

                systemData.cc_system = cart.paymentMethod
                systemData.cc_token = stripePayment.intent['id']
                
                form.createOrder(systemData, () => {
                    trackOrder()
                    let orderData = form.getFormData();
                    stripe.cancelAbandonedOrder(orderData.telephone, location.href);
                    $.ajax({
                        url : '{{route('order.cc.update')}}',
                        data: {
                            'orderId'  : systemData.cc_token,
                            'orderData': orderData,
                            'omgId'    : form.omgId,
                            'domain'   : '{{env('APP_URL')}}',
                            'page'     : 'https://' + window.location.host + window.location.pathname + window.location.search,
                        },
                        type: 'POST',
                        success(response) {
                            console.log ("success");
                            location.href = '{{env('APP_URL')}}/thanks'
                        },
                        error(xhr) {
                            console.log(xhr.responseText)
                        },
                    })
                })
            }).catch(function (error) {
                // -- Report error
                $('.checkout-loader').hide()
                // TODO: Implement error reporting
                // reportError(error)
            })
        }

        /**
         * Handles confirmation of payment intent for non-card/provider purchases
         *
         * @param provider
         * @param stripeData
         * @param systemData
         */
        providerFlow (provider, stripeData, systemData) {
            let methodNames = {
                p24: 'confirmP24Payment',
                ideal: 'confirmIdealPayment',
                giropay: 'confirmGiropayPayment',
            }
            let dataProperties = { p24: 'p24', ideal: 'ideal', giropay: 'giropay' }
            let stripePayment = this

            $('.checkout-loader').show()

            this.updateAmount()

            form.createOrder(systemData, () => location.href = '{{env('APP_URL')}}/thanks')
        }

        /**
         * Returns billing detail structure based on given provider
         *
         * @param provider
         * @returns Object
         */
        providerBillingDetails (provider) {
            // TODO: Move to Form.js
            let formData = form.getFormData()

            if (provider === 'p24Bank') {
                return { name: formData['name'], email: formData['email'] }
            }

            if (provider === 'giropay') {
                return { name: formData['name'] }
            }

            return {}
        }

    cancelAbandonedOrder(phone, page) {
        if (page.toLowerCase().includes('infobip')) {
            return true;
        }

        let aoStorageKey = 'hasAbandonedOrder_' + location.href.replace(location.search, '').replace('https://', '');

        $.ajax({
            url: app_url + '/abandoned-order/cancel',
            type: 'POST',
            data: {
                phone,
                page
            },
            success(response) {
                try {
                    localStorage.removeItem(aoStorageKey)
                } catch (error) {

                    return false
                }
            },
        })

        }
    }


</script>
