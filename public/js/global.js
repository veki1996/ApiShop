// register all event clicks and global variables

function getUrlParam(name) {
    let url = new URL(window.location.href);
    let parameter = url.searchParams.get(name);
    return parameter;
}

const postage =

$(document).ready(function () {
    // clear cart and add product on sp

    if(getUrlParam('pstprm') === 'y') {
        console.log(123);
        cart.addBonus(postageData);
    }

    if(getUrlParam('pstprm' === 'n')) {
        cart.removeBonus(postageData.sku);
    }

    if (location.href.includes(productPath) && getUrlParam("flow") === "direct") {
        cart.products = [];
        cart.coupon = {};

        // duplicated code, because for some reason trigger click doesn't work?
        let btn = $(".add-to-cart").first();

        let data = btn.data();
        cart.addProduct({
            sku: data.sku,
            name: data.name,
            price: Number(data.price),
            price_1x: Number(data.price1x),
            price_2x: Number(data.price2x),
            price_3x: Number(data.price3x),
            long_name: data.longName,
            paramVal: "",
            param: "",
            cartVar: "",
            image: data.image,
            quantity: parseInt(data.quantity),
            fbCategories: data.fbcategories,
            googleCategories: data.googlecategories,
            warrantyExtension: false,
            deliveryDay: data.delivery,
            realName: data.realName
        });

        updateCheckoutOrder();
    }

    $("body").on("click", ".add-to-cart", function () {
        let btn = $(this);
        let data = setData(btn);
        
        // Product Variations Part
        if (typeof selectedCombinations != "undefined" && hasCombinations) {
            if (btn.hasClass("add-to-cart-products")) {
                // check is press btn from related products
                handleAddAndUpdateCartProduct(btn, data);
            } else {
                removeFromCartSelectedCombinations();
                loopThroughSelectedCombinations(selectedCombinations, data);
            }
        } else {
            handleAddAndUpdateCartProduct(btn, data);
        }
        // end product variation part

        updateCounter();
        updateSideCart();

        if (typeof updateCartProducts !== "undefined") {
            updateCartProducts(cart.products);
        }

        if (typeof updateCartInfoProducts !== "undefined") {
            updateCartInfoProducts(cart.products);
        }

        if (typeof updateTotalPrice !== "undefined") {
            updateTotalPrice();
        }
    });

    $("body").on("click", ".to-checkout", function () {
        let query = location.search;
        let sku = $(this).data("sku");
        if ($(this).hasClass("buy-now")) {
            let addToCart = $('.add-to-cart[data-sku="' + sku + '"]').first();

            if (addToCart && addToCart.data("sku") === $(this).data("sku")) {
                addToCart.trigger("click");
            }
        }

        if ($(this).hasClass("scroll")) {
            if (typeof selectedCombinations != 'undefined' && validateCombinations(selectedCombinations) === false)
                throw new Error("An error occurred");
            $("html, body").animate(
                {
                    scrollTop: $(".checkout-title").offset().top,
                },
                1000
            );
        }

        if (!$(this).hasClass("scroll") && !$(this).closest('.sticky-wrapper').length > 0)
            location.href = app_url + "/checkout" + query;
    });

    function showGrades() {
        var gradeElements = $(".grade");
        gradeElements.each(function (index, element) {
            var randomGrade = Math.random() * 0.5 + 4.5;

            $(element).text(randomGrade.toFixed(1));

            if (parseFloat($(element).text()) !== 5.0) {
                $(element)
                    .closest(".product-box-stars")
                    .find("img:last")
                    .attr("src", `${app_url}/static/rating.png`);
            } else {
                $(element)
                    .closest(".product-box-stars")
                    .find("img:last")
                    .attr("src", `${app_url}/static/grade.png`);
            }
        });
    }

    showGrades();

    const checkout = $('.input-item-title');
    if(checkout.length > 0)
    {
        $(window).on('scroll', function () {
            toggleStickyWrapper(checkout);
        });
    }


});

function validateCombinations(selectedCombinations) {

    if (selectedCombinations.length < $('.mainSelector:visible').length) {
        $(".select_property").addClass("scale-animation");
        setTimeout(function () {
            $(".select_property").removeClass("scale-animation");
        }, 1500);
        return false;
    }
}

function loopThroughSelectedCombinations(selectedCombinations, data) {
    if (validateCombinations(selectedCombinations) === false) throw new Error("An error occurred");

    let addedCombs = [];

    selectedCombinations.forEach(function (el) {
        if (addedCombs.includes(el)) return;
        let tempData = JSON.parse(JSON.stringify(data));

        tempData.sku = el;
        tempData.quantity = selectedCombinations.filter(combSku => combSku == el).length;
        tempData.price = Math.floor((data['price_' + selectedCombinations.length + 'x'] / selectedCombinations.length * tempData.quantity) * 100) / 100;

        let currentCombination = combinations.find(comb => comb.sku == el);
        let text = '';
        currentCombination.variations.forEach(function (el) {
            text += ' - ' + productVariations[el]['name'];
        });


        tempData.name = data.name + text;
        tempData.long_name = data.long_name + text;

        if (currentCombination.image) {
            tempData.image = app_url + '/' + currentCombination.image;
        }

        cart.addSelectedCombinations(tempData.sku);

        if (cart.getProduct(el)) {
            cart.updateProduct(tempData.sku, tempData);
        } else {
            cart.addProduct(tempData);
            setPixelAddToCart(tempData);
        }
        addedCombs.push(el);
    });

    selectedCombinations = [];
    cart.setSelectedCombinations();
}

function removeFromCartSelectedCombinations()
{
    cart.selectedCombinations.forEach((sku) => { cart.removeProduct(sku); });
    cart.selectedCombinations = [];
}

function handleAddAndUpdateCartProduct(btn, data)
{
    if (cart.getProduct(btn.data('sku'))) {

        cart.updateProduct(data.sku, data);

        if (!getUrlParam('flow') === 'direct') {
            $("#productAlredyInCart").css("display", "block");
            setTimeout(() => {
                $("#productAlredyInCart").css("display", "none");
            }, 2500);
        }
    } else {
        cart.addProduct(data);
        setPixelAddToCart(data);
    }

    if (typeof updateCheckoutOrder !== "undefined") {
        updateCheckoutOrder();
    }
}

function setData ( btn )
{
   return {
        sku: btn.attr('data-sku'),
        name: btn.attr('data-name'),
        price: Number(btn.attr('data-price')),
        price_1x: Number(btn.attr('data-price1x')),
        price_2x: Number(btn.attr('data-price2x')),
        price_3x: Number(btn.attr('data-price3x')),
        long_name: btn.attr('data-long-name'),
        cartVar: '',
        image: btn.attr('data-image'),
        quantity: parseInt(btn.attr('data-quantity')),
        fbCategories: btn.attr('data-fbcategories'),
        googleCategories: btn.attr('data-googlecategories'),
        warrantyExtension: false,
        deliveryDay: btn.attr('data-delivery'),
        realName: btn.attr('data-realName')
    };
}

function toggleStickyWrapper(checkout) {

    const stickyWrapper = $('.sticky-wrapper');
    const checkoutTop    = checkout.offset().top;
    const checkoutBottom = checkoutTop + checkout.outerHeight();
    const windowBottom   = $(window).scrollTop() + $(window).height();

    if (windowBottom > checkoutTop) {
        stickyWrapper.hide();
    } else {
        stickyWrapper.show();
    }
}

//CATEGORIES LINKS ROUTING (deki)
$(document).ready(function () {
    $('.category-dropdown-container').click(function () {
        $(this).find('a.shop_category')[0].click();
    });
});


$(document).ready(function() {
    function checkWidth() {
        var windowsize = $(window).width(); 
        if (windowsize < 800) {
            $('#products-holder .product-box-name').each(function() {
                let productBoxName = $(this).text();
                if (productBoxName.length > 40) {
                    const truncatedText = productBoxName.substring(0, 37) + '...';
                    $(this).text(truncatedText);
                }
            });
            $('#splideRelated-track .product-box-name').each(function() {
                let relatedProductBoxName = $(this).text();
                if (relatedProductBoxName.length > 55) {
                    const truncatedTextRelated = relatedProductBoxName.substring(0, 55) + '...';
                    $(this).text(truncatedTextRelated);
                }
            });
        }
        if (windowsize < 380) {
           
            $('#products-holder .product-box-name').each(function() {
                let productBoxName = $(this).text();
                if (productBoxName.length > 30) {
                    const truncatedText = productBoxName.substring(0, 25) + '...';
                    $(this).text(truncatedText);
                }
            });
            $('#splideRelated-track .product-box-name').each(function() {
                let relatedProductBoxName = $(this).text();
                if (relatedProductBoxName.length > 50) {
                    const truncatedTextRelated = relatedProductBoxName.substring(0, 50) + '...';
                    $(this).text(truncatedTextRelated);
                }
            });
        }
        if (windowsize > 800) {
           
            $('#products-holder .product-box-name').each(function() {
                let productBoxName = $(this).text();
                if (productBoxName.length > 50) {
                    const truncatedText = productBoxName.substring(0, 45) + '...';
                    $(this).text(truncatedText);
                }
            });
            $('#splideRelated-track .product-box-name').each(function() {
                let relatedProductBoxName = $(this).text();
                if (relatedProductBoxName.length > 50) {
                    const truncatedTextRelated = relatedProductBoxName.substring(0, 45) + '...';
                    $(this).text(truncatedTextRelated);
                }
            });
        }
    }
    checkWidth();
    $(window).resize(checkWidth);
});

function setPixelAddToCart(product)
{   
    if (typeof gtag === 'function') {
        gtag(
            'event',
            'AddToCart',
            {
                items: [
                    {
                        item_id: [product.sku],
                        item_name: product.name,
                        price:  (cart.roundPrice(product.price, currencyCode).toFixed(2) / shop.eurExchangeRate).toFixed(2),
                        item_category: product.googleCategories,
                        currency: "EUR",
                    },
                ],
            },
        )
    }

    if (typeof fbq === 'function') {
        fbq(
            'track',
            'AddToCart',
            {
                content_ids: [product.sku],
                content_name: product.name,
                content_category: product.fbCategories,
                content_type: 'product',
                value: (cart.roundPrice(product.price, currencyCode).toFixed(2) / shop.eurExchangeRate).toFixed(2),
                currency: 'EUR'
            },
        )
    }
}


