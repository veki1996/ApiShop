const productsHolder = $('#products-holder');
let checkboxes = $('.chip');
let seeMoreHtml = $('#view-products').html();

$(document).ready(function () {

    $(".product-type img").click(function () {
        $(this).parent().next('.categories-filter').toggle();
        $(this).parent().toggleClass('open');
    });

    $('.productBox').each(function () { $(this).show() }); // show other hidden.. products

    checkboxes.on("change", function () {
        getProducts(0, 20, true);
    });

    $(".filter-title").click(function () {
        $('.sidebar').toggle();
    });

    $(".close-sidebar").click(function () {
        $('.sidebar').toggle();
    });

    const categoryId = getUrlParam('category');

    if (categoryId) {
        const checkboxToSelect = $('.filter-menu').find(`input[type="checkbox"][data-category-id="${categoryId}"]`).first();
        checkboxToSelect.prop("checked", true).trigger("change");
    }

    function appendProducts(products) {

        if (products.length < 20) {
            $('#view-products').html(noMore);
        } else {
            $('#view-products').html(seeMoreHtml);
        }

        Object.entries(products).forEach(function (product) {

            let url = new URL(app_url + '/' + product[1].slug + location.search);
            let skuInParts = product[0].split('-');
            let utmPod = '';

            if (skuInParts.length === 3) {
                utmPod = skuInParts[2];
            }

            url.searchParams.set('utm_pod', utmPod);
        

            let productHTML = `
                <div data-name="${product[1].name}" data-sku="${product[1].longSku}" class="productBox" style="">
                    <div class='corner-discount'> - ${product[1].prices.discount}%</div>
                    <div class="product-box-image">
                        <a  href="${url}"><img src="${product[1].image}"></a>
                    </div>
                    <div class="product-box-info">

                        <a  href="${url}"><p class="product-box-name">${product[1].longName}</p></a>
                        <p class="product-box-price">
                            <span>${product[1].prices.forOne + currencySymbol}</span>
                            <span id='topbox-discount-price'>${(product[1].prices.undiscounted) + currencySymbol}</span>
                        </p>

                        <div class="product-box-stars">
                            <img src="${app_url}/static/grade.png">
                            <img src="${app_url}/static/grade.png">
                            <img src="${app_url}/static/grade.png">
                            <img src="${app_url}/static/grade.png">
                            <img src="${app_url}/static/rating.png">
                            <p>( <span class="grade"></span> )</p>
                        </div>
                        <div class="add-to-cart add-to-cart-products" data-sku="${product[1].longSku}" data-name="${product[1].name}" data-long-name="${product[1].name} - ${product[1].shprtDescription}" data-price="${product[1].prices.forOne}" data-priceupsell="${product[1].prices.upsell}" data-price1x="${product[1].prices.forOne}" data-price2x="${product[1].prices.forTwo}" data-price3x="${product[1].prices.forThree}9" data-currency="€" data-image="${product[1].image}" data-quantity="1" data-delivery="${product[1].deliveryDate}">
                        <p>${addToCart}</p>
                            <img src="${app_url}/static/add-to-cart-gold.png" alt="">
                        </div>
                        <div class="to-checkout buy-now" data-sku="${product[1].longSku}">
                        <p>${buyNow}</p>
                        <img src="${app_url}/static/buy-now-white.png" alt="">
                    </div>
                    </div>
                </div>
            `;

            productsHolder.append(productHTML);
        });

        showGrades();
    }


    function getProducts(offset, limit, removeProductsHtml = false) {

        let categories = [];

        checkboxes.each(function () {
            if ($(this).is(':checked')) categories.push('wsa' + $(this).data('category-id'));
        });

        const data = {
            offset,
            categories
        }

        $.get(app_url + "/getProducts", data, function (response) {

            if(removeProductsHtml) {
                productsHolder.html('');
            }

            appendProducts(response);
        }).fail(function () {
            console.log("Error, retrive failed.");
        });
    }

    $('.view-btn').click(function () {
        let offset = $('.productBox').length;

        getProducts(offset, 20);
    });
});











