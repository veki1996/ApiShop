const deliveryBtns = $('.delivery-btn');

function updateDelivery() {
    let standardDelivery = $('.standardType').first();
    let fastDelivery = $('.typeFast').first();

    if (!cart.hasBonus(standardDelivery.data('sku'))) {
        standardDelivery.addClass('active');
        fastDelivery.removeClass('active');
        standardDelivery.find('input').attr('checked','checked');
        fastDelivery.find('input').removeAttr('checked');
    } else {
        fastDelivery.addClass('active');
        standardDelivery.removeClass('active');
        fastDelivery.find('input').attr('checked','checked');
        standardDelivery.find('input').removeAttr('checked');
    }
}

$(document).ready(function() {

    updateDelivery()

    deliveryBtns.on('click', function() {
        let btn = $(this);
        let sku = btn.data('sku');
        let price = btn.data('price');
        let name = btn.data('name');
        let standardDelivery = $('.standardType').first();
        let fastDelivery = $('.typeFast').first();

        if(!sku || !price || !name) return;

        if(btn.data('standard')) {
            cart.removeBonus(sku);
            btn.addClass('active')
            fastDelivery.removeClass('active');
            btn.find('input').attr('checked','checked');
            fastDelivery.find('input').removeAttr('checked');
        } else {
            cart.addBonus({sku, name, price});
            btn.addClass('active')
            standardDelivery.removeClass('active');
            btn.find('input').attr('checked','checked');
            standardDelivery.find('input').removeAttr('checked');
        }

        updateCheckoutOrder();
    })
});
