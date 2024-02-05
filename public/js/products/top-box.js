$(document).ready(function () {

    const prices = {
        1: priceOne,
        2: priceTwo,
        3: priceThree,
        'discount': discount ?? 50
    };

    $('.top-box-prices').click(function () {
        const quantity = $(this).attr('data-quantity');

        if($('.selectorBox').find('.mainSelector').length) {
            $('.mainSelector').each(function(index) {
                if(index + 1 <= quantity) {
                    $(this).show();
                    return;
                }

                $(this).hide();
            });
        }

        $(".color-item").each(function () {
            $(this).removeClass("inStock active").addClass("invalid_prop");
        });

        $(".select_property").show();
        
        const selectedPrice = prices[quantity];
        let cartBtn = $('.top-box-buttons').find('.add-to-cart').first();

        $('#euro-price').text(selectedPrice + currencySymbol);
        $('#discounted-price').text(Number(Number(selectedPrice) * (100 + discount) / 100).toFixed(2) + currencySymbol);

        cartBtn.attr('data-quantity', quantity);
        cartBtn.attr('data-price', selectedPrice);

        if(typeof selectedCombinations === "undefined"){

            if(cart.getProduct(cartBtn.data('sku'))) {
                cart.updateProduct(cartBtn.data('sku'), { quantity: Number(quantity), price: Number(selectedPrice) });
    
                if(typeof updateCheckoutOrder !== 'undefined') {
                    updateCheckoutOrder();
                }
            }
        }
        

        $('.top-box-prices').removeClass('selected');
        $(this).addClass('selected');

        if(getUrlParam('flow') === 'direct' && typeof selectedCombinations != "undefined")
        {   
            cart.reset();
            updateCheckoutOrder();
            selectedCombinations = [];
        }

        if(typeof selectedCombinations != 'undefined')
        {
            selectedCombinations = [];
        }
       
    });
})
