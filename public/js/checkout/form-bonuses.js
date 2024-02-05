let bonusBtns = $('.bonus');

function updateCheckedBonuses() {
    bonusBtns.each(function() {
        let btn = $(this).find('.bonus-toggle-btn').first();
        if(cart.hasBonus(btn.data('sku'))) {
            btn.addClass('added');
            btn.find('img').show();
            btn.closest('.bonus').addClass('active');
        } else {
            btn.removeClass('added');
            btn.closest('.bonus').removeClass('active');
            btn.find('img').hide();
        }
    });
}

$(document).ready(function() {

    updateCheckedBonuses();

    bonusBtns.on('click', function() {
        let btn = $(this).find('.bonus-toggle-btn').first();
        let sku = btn.data('sku');
        let price = btn.data('price');
        let name = btn.data('name');

        if(!sku || !price || !name) return;

        if(!cart.hasBonus(sku)) {
            cart.addBonus({
                sku: sku,
                name: name,
                price: Number(price),
            });

            btn.addClass('added');
            $(this).closest('.bonus').addClass('active');
            btn.find('img').show();

        } else {
            cart.removeBonus(sku);
            btn.removeClass('added');
            $(this).closest('.bonus').removeClass('active');
            btn.find('img').hide();
        }

        updateCheckoutOrder();
    });
});
