const cartProductData = $('.cart-product-data');
const cartProductInfoData = $('.cart-total-products');

function updateCartProducts(products) {
    // remove products from cart data first
    cartProductData.html('');

    if (products && products.length) {
        products.forEach(function (product) {

            let addMorePrice = null;

            if (product.quantity < 3) {
                addMorePrice = Number(product['price_' + Number(Number(product.quantity) + 1) + 'x'] / Number(Number(product.quantity) + 1)).toFixed(2);
            }

            cartProductData.append(`
            <div class="cart-product-wrapper">
                <div class="cart-product" data-sku="${product.sku}">

                    <div class="cart-product-info">
                        <div class="title-div">
                        <div class='img-and-info-cart'>
                            <img src="${product.image}" class="cart-product-img" alt="">
                            <div class='cart-product-info-price'>
                            <div class='title-and-remove'>
                                <h2 class="cart-product-title">${product.long_name}</h2>
                                <img class="remove-product" src="${app_url + "/static/trash.png"}" alt="">
                            </div>
                            <div class="price-and-qty">
                                <div class="cart-product-quantity">
                                    <p>${qty}</p>
                                        <select class="cart-quantity-selector">
                                        <option value="1" ${product.quantity == 1 ? 'selected' : ''}>1</option>
                                        <option value="2" ${product.quantity == 2 ? 'selected' : ''}>2</option>
                                        <option value="3" ${product.quantity == 3 ? 'selected' : ''}>3</option>
                                        </select>
                                </div>
                                <div class="cart-product-price">
                                </div>
                                <h2 class="product-price">${product.price + ' ' + currencySymbol} </h2>
                            </div>


                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
                ${product.quantity != 3 ? `
                    <div class="add-more">
                        <p>${addMore + ' ' + addMorePrice + ' ' + currencySymbol} </p>
                        <div class="add-more-btn">${add} <b>+</b></div>
                    </div>` : ''
                }
            </div>`);
        });
    }

}

function updateCartInfoProducts(products) {
    cartProductInfoData.html('');

    if (products && products.length) {
        products.forEach(function (product) {
            cartProductInfoData.append(`
                <div class="cart-total-product-info">
                    <p>${product.quantity}</p>
                    <p>${product.long_name}</p>
                    <p>
                        ${product.price + ' ' + currencySymbol }
                    </p>
                </div>`);
        });
    }
}

function updateTotalPrice() {
    const total = cart.totalPrice + ' ' + currencySymbol ;
    $('.total-price').text(total);
}

$(document).ready(function () {
    // update cart data on load
    if (cart && cart.products.length) {
        updateCartProducts(cart.products);
        updateCartInfoProducts(cart.products);
        updateTotalPrice();
    }

    cartProductData
        .on('change', '.cart-quantity-selector', function () {
            let productHtml = $(this).parents('.cart-product').first();
            let product = cart.getProduct(productHtml.data('sku'));

            if (!product) return;

            product.quantity = $(this).val();
            product.price = product['price_' + product.quantity + 'x'];

            cart.updateProduct(product.sku, product);

            updateCartProducts(cart.products);
            updateCartInfoProducts(cart.products);
            updateTotalPrice();
            updateSideCart();
        })
        .on('click', '.remove-product', function () {
            let productHtml = $(this).parents('.cart-product').first();

            cart.removeProduct(productHtml.data('sku'));

            updateCartProducts(cart.products);
            updateCartInfoProducts(cart.products);
            updateTotalPrice();
            updateCounter();
            updateSideCart();
        })
        .on('click', '.add-more-btn', function () {
            let productHtml = $(this).parents('.cart-product-wrapper').first();
            let quantitySelector = productHtml.find('.cart-quantity-selector');

            quantitySelector.val(Number(quantitySelector.val()) + 1 + '');
            quantitySelector.trigger('change');
        });

});
