const sideCartProducts = $('.sidecart-total-info').eq(0);

const updateCounter = function () {
    $('.cart-count').text(cart.products.length);
    $('.cart-stats').toggleClass('hidden', cart.products.length === 0);
};

function updateSideCart() {
    sideCartProducts.html('');

    if (cart && cart.products.length) {
        cart.products.forEach(function (product) {
            sideCartProducts.append(
        `<div class="side-cart-product" data-sku="${product.sku}">
                    <div class="name-wrapper">
                        <img src="${product.image}" alt="">
                        <div class='name-price-col'> <p class="side-cart-product-name">${product.name}</p>
                        <p class="side-cart-product-qty">${product.quantity} x</p>
                        <p class='side-cart-product-price'>
                            ${product.price + ' ' + currencySymbol }
                        </p></div>
                    </div>


                    <div class='side-cart-product-remove'> <img class="remove-product" src="${app_url + "/static/trash.png"}" alt=""></div>
               </div>

            `)
        });
    }
}

$(document).ready(function () {

    updateCounter();
    updateSideCart();

    $('#search-button').on('click', function () {

        let search = $('#search-field-0');
        let searchDiv = $('.search-box');
        let searchVal = search.val();
        let url = $(this).data('route');
        let query = 'q=' + searchVal;
        let logo = $('.header-logo-container').first();

        // if(url.includes('?')) {
        //     query = query.replace('?', '&');
        // }

        if (search.css('display') === 'none') {

            $('.header-logo-container').hide();
            searchDiv.css('border', '1px solid rgba(165, 165, 165, 0.19)');
            searchDiv.css('box-shadow', '0px 2px 2px 0px rgba(14, 14, 33, 0.04), 0px 4px 6px 0px rgba(14, 14, 33, 0.04), 0px 6px 16px 0px rgba(14, 14, 33, 0.04), 0px 0px 10px 0px rgba(14, 14, 33, 0.06');
            searchDiv.css('width', '80vw');
            search.show();
            search.focus();

            return;
        } else {
            if(searchVal) {
                let queryString = window.location.search;
                query = queryString ? queryString + '&' + query : '?' + query;

                location.href = app_url + '/shop' + query;
            } else {
                if (!logo.is(':visible')) {
                    logo.show();
                    searchDiv.css('border', '');
                    searchDiv.css('box-shadow', '');
                    searchDiv.css('width', '');
                    search.hide();
                }
            }
        }

    });

    $('#search-field-0').on('keypress',function(e) {
        if(e.which === 13) {
            $('#search-button').trigger('click');
        }
    });
    if (window.location.href.indexOf("about") != -1) {
        $('#pocetna').toggleClass('header-link-active')
        $('#onama').addClass('header-link-active');
    }else{
        console.log("err")
    }
    $(document).ready(function() {
        $('.header-angle-tag, .header-categories-tab').on('click', function(e) {
          e.stopPropagation();

          if (!$(e.target).is('a')) {
            var $dropdown = $(this).find('.categories-dropdown').eq(0);
            $dropdown.toggle();
            $('.dropdown-overlay-hide').toggleClass('dropdown-overlay-show');
          }

        });


        $(document).on('click', function(e) {
          if (!$('.header-angle-tag, .header-categories-tab').is(e.target) &&
              $('.header-angle-tag, .header-categories-tab').has(e.target).length === 0) {
            $('.categories-dropdown').hide();
            $('.dropdown-overlay-hide').removeClass('dropdown-overlay-show');
          }
        });
      });


    $(".cartHref").on("click", function (event) {
        event.preventDefault();


        if (!cart.products.length) {
            $("#emptyCartMsg").show();

            setTimeout(() => {
                $("#emptyCartMsg").hide();
            }, 2000);
        }

        $('.side-cart').toggle(200,"swing");
        $('.side-cart-overlay').show();
    });

    $('.side-cart-overlay, .side-cart-close').on('click', function() {
        $('.side-cart-overlay').hide();
        $('.side-cart').toggle(200,"swing");
    });

    $('.burger-container-image').on('click', function() {
        $('.burger-overlay').show();
        $('.categories-burger').toggle(200,"swing");
    });

    $('.close-sidebar-burger, .burger-overlay').on('click', function() {
        $('.burger-overlay').hide();
        $('.categories-burger').toggle(200,"swing");
    });

    $('#fixed-cart-icon > .searchIcon').on('click', _ => {
        $('#search-field-0').val(''); // Clear the input field
        $('.searchBox').fadeToggle(function () {
            // Set focus to the searchField element if the searchBox is visible
            if ($(this).is(':visible')) {
                $('#search-field-0').focus();
            }
        });
    });

    $('.shop_category').on('click', function(e) {
       e.preventDefault();

       let url = new URL($(this).attr('href'));
       url.searchParams.set('category', $(this).data('id'));
        
       location.href = url;
    });

    $('.child_category').on('click', function(e) {
        e.preventDefault();
 
        let url = new URL($(this).attr('href'));
        url.searchParams.set('category', $(this).data('id'));
        location.href = url;
     });

    sideCartProducts.on('click', '.side-cart-product-remove', function() {
        let sideCartProduct = $(this).parents('.side-cart-product').first();
        let sku = sideCartProduct.data('sku');

        if(!sku) return;

        cart.removeProduct(sku);
        sideCartProduct.replaceWith('');
        updateCounter();

        if(typeof updateCartProducts !== 'undefined') {
            updateCartProducts(cart.products);
        }

        if(typeof updateCartInfoProducts !== 'undefined') {
            updateCartInfoProducts(cart.products);
            updateTotalPrice();
        }
    });

});

$('.parent-category .parent-name').click(function(e) {
    e.stopImmediatePropagation();
    $(this).next('.child-categories').toggleClass('active');
    $(this).find('.dropdown-arrow').toggleClass('rotate');
});