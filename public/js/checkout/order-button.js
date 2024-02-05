const orderButton = $('#order-button');

$(document).ready(function () {

    orderButton.on('click', function (e) {
        e.preventDefault();
       
        if (!form.isValid()) {
            form.displayErrors()
            return false;
        }

        if(cart.products.length == 0)
        {
            $('html, body').animate({
                scrollTop: 200
            }, 1000);
        }

        if (cart.paymentMethod === 'stripe') {
            stripe.confirmPayment({})
            return
        }

        localStorage.removeItem('complementaryProducts');
       
        form.createOrder({}, () => {
            //trackOrder();
            cancelAbandonedOrder($("#phone").val(), location.href);
            if (cart.paymentMethod == 'cod') {
                let url = new URL(app_url + "/crossell" + location.search);
                url.searchParams.set('hash', form.hash);
                location.href = url;
            } else {
                location.href = app_url +"/thanks" + location.search;
            }
        });
    });

    function cancelAbandonedOrder(phone, page)
    {
        if (page.toLowerCase().includes('infobip')) {
            return true;
        }

        let aoStorageKey = 'hasAbandonedOrder_' + location.href.replace(location.search, '').replace('https://', '');

        $.ajax({
            url: app_url + '/abandoned-order/cancel',
            type: 'POST',
            data: {phone, page},
            success(response) {
                try {
                    localStorage.removeItem(aoStorageKey)
                }
                catch (error) {
        
                    return false
                }
            },
        })
    
    }
});
