<script>
    function initializePaypal () {
        let paypal = new PayPal()
        paypal.initialize()
    }

    class PayPal {
        initialize () {
            let paypalInstance = this
            $('#paypal-button-container').empty()
            $('.checkout-loader').show()

            // Set up event listeners to enable/disable
            // The PayPal button based on form validation results
            $('#order-form input[data-mandatory="true"]').on('change', function () {
                paypalInstance.actions.enable()

                if (!form.isValid) {
                    paypalInstance.actions.disable()
                }
            })

            paypal.Buttons({
                enableStandardCardFields: false,
                style: {
                    layout: 'horizontal',
                    fundingicons: 'true',
                },
                onInit: function (data, actions) {

                    $('#order-button').hide()

                    paypalInstance.actions = actions
                    paypalInstance.validateInitialization()

                    $('.paypal-modal').hide()
                    $('.checkout-loader').hide()

                    cart.paymentMethod = 'pp'
                    cart.paymentSystem = 'paypal'
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        intent: 'CAPTURE',
                        payer: {
                            name: {
                                given_name: form.getFormData().name,
                            },
                        },
                        purchase_units: [
                            {
                                amount: {
                                    value: cart.totalEurPrice.toFixed(2),
                                    currency: 'EUR',   // Real cart amount converted to eur
                                },
                            },
                        ],
                    })
                },
                onClick: function () {
                    paypalInstance.validateClick(cart)
                },
                onApprove: function (data, actions) {
                    // updates order data in OMG and tracks the order details
                console.log('approved')
                return actions.order.capture().then(function(details) {

                    form.createOrder(form.getFormData(), () => {
                    trackOrder();
                    let orderData = form.getFormData();
                    paypalInstance.cancelAbandonedOrder(orderData.telephone, location.href);
                        $.ajax({
                            url: '{{route('order.paypal.update')}}',
                            data: {
                                'orderId': data.orderID,
                                'orderData': orderData,
                                'omgId': form.omgId,
                                'domain': '{{env('APP_URL')}}',
                                'page': 'https://' + window.location.host + window.location.pathname +
                                    window.location.search,
                            },
                            type: 'POST',
                            success(response) {
                                console.log("success");
                                location.href = '{{env('APP_URL')}}/thanks' 
                             },
                            error(xhr) {
                                console.log(xhr.responseText)
                            },
                        })
                    })
                })
                },
                onCancel: function (data, actions) {
                    $(".sending").hide();
                    $(".order-info").hide();
                    //insightCheck(false, 'pp_closed_modal', 'User closed PP modal window.')
                },
                onError: function (err) {
                    //insightCheck(false, 'pp_init_error', err)

                    // TODO: Implement error tracking
                    // reportError('Paypal error: ' + err);
                    // errorTracking( 'Paypal error: ' + err, JSON.stringify( WS_.orderFormValidation('data')['payload'] ) );
                },

            }).render('#paypal-button-container')
        }

        validateInitialization () {
            $('.paypal-modal').hide()

            if (!form.isValid()) {
                this.actions.disable()
                form.displayErrors()
            }
        }

        validateClick (systemData) {
            if (!form.isValid()) {
                form.displayErrors()
                return false
            }

            this.loadingState(true)

            // creates order in the DB

            // form.createOrder()
            return true
        }

        loadingState(state) {
            $(".sending").hide();
            $(".order-info").show();

            if (state) {
                $(".sending").show();

                if (state === "hide") {
                    $(".sending").hide();
                    $(".order-info").hide();
                }
            }
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
