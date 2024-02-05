const orderProductsData = $('.order-products-data').first();
const orderServicesData = $('.order-services-data').first();

function updateCheckoutOrder() {
    orderProductsData.html('');
    orderServicesData.html('');

    cart.products.forEach(function(product) {
        orderProductsData.append(`
        <div class="product-data">
            <div class='qty-name-data'>
                <p>${product.quantity}</p>
                <p>${product.name}</p>
            </div>
            <div class='price-and-remove'>
                 <p class='price-remove-checkout'>
                        ${product.price + '&nbsp;' + currencySymbol }
                </p>
                <img class='remove-product-checkout' data-sku="${product.sku}" src="${app_url}/static/trash.png"/>
            </div>
        </div>
        `);
    });


    let nonremovableFees = ['SCOD-666-11062', 'POST-666-0038'];

    cart.bonuses.forEach(function(service) {
        let canBeRemoved = !nonremovableFees.includes(service.sku);

        orderServicesData.append(`
        <div class="service-data">
            <div class='qty-name-data'>
                <p>1</p>
                <p>${service.name}</p>
            </div>
           <div class='price-and-service-remove'>
                <p>
                    ${service.price + '&nbsp;' + currencySymbol }
                </p>
                ${canBeRemoved ? `<img class="remove-service" data-sku="${service.sku}" src="${app_url}/static/trash.png" alt="">` : ''}
           </div>
        </div>
        `);
    });


    $('.total-price').html('&nbsp;' + cart.totalPrice + '&nbsp;' + currencySymbol);
}

$(document).ready(function() {

    updateCheckoutOrder();

    $('body').on('click', '.remove-service', function() {
        let sku = $(this).data('sku');

        if(!sku) return;

        cart.removeBonus(sku);
        updateCheckoutOrder();
        updateCheckedBonuses();
        updateDelivery();
    })
    .on('click', '.remove-product-checkout', function (){
        let sku = $(this).data('sku');
        console.log(this)

        cart.removeProduct(sku);
        // updateCartProducts(cart.products);
        // updateCartInfoProducts(cart.products);
        updateCheckoutOrder();
        updateDelivery();
    });

});
