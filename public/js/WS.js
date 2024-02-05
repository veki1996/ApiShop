// TODO: Port this "class" properly
// Currently just extracted methods
// Should be several classes with proper separation of concerns

// TODO: Handle these variables, where are they needed, usage?
var WS_ = new Object();
var payment_button  = $('.payment-btn');
var formComment     = $('#komentar').val();
var _checkout       = true;
var _isCheckout     = $('.ws_checkout').length > 0 ? true : false;

// TODO: Refactor
WS_.freeShipingCheck = function(){

    var data         = WS_.localStorageGetAll()
    var sum          = 0;

    $.each( data, function( key, value ){

        if( value.fullDomain === fullDomain ){

            sum += parseFloat( value.price )
        }
    })

    if( freeShipCart != 'undefined' && freeShipCart == 1){

        var currentValue = sum;

        if(freeShipAmount > currentValue){

            if( getPostage != 'undefined' && getPostage == 1){
                var missingForFreeShip = (freeShipAmount - currentValue);
                $('#freeShipping').css('display', 'block');
                $('#freeShippingInfo').css('display', 'block');
                $('.forFreeShipCount').text(missingForFreeShip.toFixed(2).replace(/[.,]00$/, "") + _currency);
                $('.freePostageTxt').css('display', 'none');
            }

        }else{
            $('#freeShipping').css('display', 'block');
            $('.freePostageTxt').css('display', 'block');
            $('.freePostageAmntTxt').css('display', 'none');


            // Define global postage variable
            getPostage = 0;

            // Set cookie for this domain
            var splitFullDomain = fullDomain.split('/')[0];
            document.cookie="pstprmFreeShip=yes;path=/; domain="+splitFullDomain;

        }
    }

}

// Get all local storage data
WS_.localStorageGetAll = function() {

    var data = JSON.parse(localStorage.getItem("cartData"));

    return data;

}

// Add item to local storage
WS_.localStorageAddItem = function( sku, data ) {

    var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

    if(sku){
        cartData[sku+'-'+fullDomain] = data;
    }

    localStorage.setItem('cartData', JSON.stringify(cartData));
}

// Remove cart data from local storage
// TODO: Refactor
WS_.localStorageClear = function(){

    var data = WS_.localStorageGetAll();


    $.each( data, function( key, value ){

        if( value.fullDomain === fullDomain ){

            delete data[key]

        }

    })


    localStorage.setItem('cartData', JSON.stringify(data))


}

// Returns array of items in cart from localstorage
WS_.localStorageDataArray = function() {

    var items = [];

    var data = WS_.localStorageGetAll();

    $.each( data, function( key, value ) {

        if( value.fullDomain === fullDomain ){

            var item  = {"sku": value.sku, "quantity": value.quantity ,"price": value.price,"discount":"0"};

            items.push(item);

        }

    })

    return items;
}

// Odrer data - array from local storage
// TODO: Refactor
WS_.localStorageDataArrayForAnalyticEvents = function() {

    var items = [];

    var data = WS_.localStorageGetAll();

    $.each( data, function( key, value ) {

        if( value.fullDomain === fullDomain ){

            if( value.sku == WS_.storage()['sku']){
                var item  = {"sku": value.sku, "quantity": value.quantity ,"price": value.price,"discount":"0", "is_main": 1 };
            }else{
                var item  = {"sku": value.sku, "quantity": value.quantity ,"price": value.price, "name":value.productName};
            }
            items.push(item);

        }

    })

    return items;
}

// Round price per country / currency
// Handles these cases: x9, x.9, x.99
WS_.priceRounding = function( amount, currency = currency_iso ) {

    switch(currency) {

        //x99 - round to two decimals with 99 on end
        //case 'EUR':
        //return Math.floor(amount) + 0.99;
        //break;

        //x90 - round to first hundred
        case 'MKD':  case 'RSD':
            return Math.ceil(amount.toFixed(0) / 100) * 100;
            //Math.ceil(number/100)*100
            break;
        case 'CZK':  case 'HUF':
            return amount.toFixed(0);
            //Math.ceil(number/100)*100
            break;

        //x9 - round without decimals
        //case 'HRK':
        //    return amount.toFixed(0);
        //break;
        default:
            return amount

    }

}

// -- BONUS (fees / package security / priority shipping / warranty )
//================================================================
// TODO: Refactor
WS_.bonus = function() {
    var bonusArray            = [];
    WS_.bonus['bonus_items']  = [];
    var cod_delivery_fee      = {"sku": cod_sku, "quantity": "1", "price": cod_fee, "discount": "0"};

    // -- Bundle product format
    if( typeof(bundle_data) !== "undefined" )
        var _bundle_tmp           = {"sku": bundle_data['bundle_sku'],"quantity": bundle_data['bundle_quantity'],"price": bundle_data['bundle_price'],"discount":"0"};

    // -- Surprise gift product format
    if(typeof surpriseProductPrice != 'undefined'){
        var _surprise_tmp = {"sku": ch_gift_sku, "quantity": "1", "price": surpriseProductPrice ,"discount":"0"};
    }else{
        var _surprise_tmp = {"sku": ch_gift_sku, "quantity": "1", "price": ch_gift_price  ,"discount":"0"};
    }
    if( typeof(getPostage) !== 'undefined' && getPostage == 0 ){

        $('.postage-row').css('display','none');

    }
    // -- Add postage into order items if postage is active
    if( getPostage == 1 && typeof new_system !== 'undefined'  ){
        var _postage_tmp = {"sku": postage_sku, "quantity": "1", "price": postage_ ,"discount":"0"};
        if(!cart.hasBonus(postage_sku))
            bonusArray.push(_postage_tmp);
    }

    // -- Additional format conditions
    var bonus_lock            = false;
    var surprise_el_lock      = false;

    // Check is there payment option active on page
    var url_param         = location.search;
    var payment_status    = epay == 'on' ? true : false;
    var bonus_status      = bonus != 'off' ? true : false

    // -- This is in case GEO doesnt have package safety enabled by default
    if( typeof(bundle_data) !== "undefined" )
        WS_.bonus['bonus_items'].push(_bundle_tmp);


    $('#surprise-gift').on('change',function() {

        removedSurpriceProduct = $("#surprise-gift").prop('checked') == true ? 0 : 1;

    });

    // Form bonus (below form)
    $('.the-btn, #surprise-gift-label').on('click', function(e) {


        // -- Pick up first class of clicked element;
        var clicked_el = e.currentTarget.classList[0];

        // Change css/class on click
        if( clicked_el == 'the-btn' &&  (!$(this).hasClass('priority-delivery') && !$(this).hasClass('standard-delivery') ) )
            $(this).toggleClass('clicked');

        // -- Adjust translation if button is clicked

        if( clicked_el == 'the-btn' && (!$(this).hasClass('standard-delivery') && !$(this).hasClass('priority-delivery') ) ) {
            if ( $(this).hasClass('clicked') ) {
                $(this).html(CS_TEXT_7);
            } else {
                $(this).html(CS_TEXT_6);
            }
        }

        // -- Get Basic info
        var sku       = $(this).attr('data-sku');
        var quantity  = $(this).attr('data-quantity');
        var price     = $(this).attr('data-price');
        var discount  = $(this).attr('data-discount');

        if (!sku || !price) { return; }

        var format = {"sku": sku, "quantity": quantity, "price": price, "discount": discount};

        // -- Validate input
        if( clicked_el == 'the-btn') {
            var error           = keyDuplicates(bonusArray, format);

            if ( !error ) {
                // -- Add bonus element to array
                bonusArray.push(format);

            } else {
                // -- Refactor object and remove empty shit
                bonusArray = removeDuplicates(bonusArray);

            }
        }


        if( clicked_el != 'the-btn' || clicked_el == 'checkbox') {
            var surprise_gift   = keyDuplicates(bonusArray, _surprise_tmp);

            if ( !surprise_gift ){
                // -- Add gift to array
                bonusArray.push(_surprise_tmp);
            } else {
                // -- Refactor object and remove empty shit
                bonusArray = removeDuplicates(bonusArray);
            }
        }

        // -- Import bundle tmp on click (only once)
        if( typeof(bundle_data) !== "undefined" && bundle_data['bundle_sku'] != '' && !bonus_lock ) {
            bonusArray.push(_bundle_tmp);

            bonus_lock = true;
        }

        // -- Save bonus items
        WS_.bonus['bonus_items'] = bonusArray.filter(function(e){return e !== undefined});

        // -- Call Convertor
        WS_.convertionInit();
    });

    // -- Additional fee calculator ( COD )
    if( WS_.payment['method'] == 'cod' && payment_status ) {

        bonusArray.push(cod_delivery_fee);

        // -- Save bonus
        if( !bonus_status || codPayment == 'on' )
            WS_.bonus['bonus_items'] = bonusArray.filter(function(e){return e !== undefined});
    }else{

        $('.cod-payment-box').hide();
        $('.payment-cod').hide();
        // $('.payment-btn').hide();
    }

    // -- Additional fee calculator on method change ( COD )
    payment_button.on('click', function() {

        // -- IF COD is picked
        if( WS_.payment['method'] == 'cod' && payment_status ){

            var fee_error = keyDuplicates(bonusArray, cod_delivery_fee);

            if ( !fee_error ) {

                // -- Add to array
                bonusArray.push(cod_delivery_fee);

            } else {
                // -- Refactor object and remove empty shit
                bonusArray = removeDuplicates(bonusArray);
            }

            // -- Save shit
            WS_.bonus['bonus_items'] = bonusArray.filter(function(e){return e !== undefined});
            $('div[data-sku="SCOD-666-11062"]').show();

        }

        else

        {

            // -- IF other payment method is picked
            for ( var i = 0; i < bonusArray.length; i++ ) {
                if (bonusArray[i]['sku'] == 'SCOD-666-11062' ) {

                    // -- Delete if found
                    delete bonusArray[i];

                    // -- Refactor object and remove empty shit
                    bonusArray = removeDuplicates(bonusArray);

                    // -- Save shit
                    WS_.bonus['bonus_items'] = bonusArray.filter(function(e){return e !== undefined});
                    $('div[data-sku="SCOD-666-11062"]').hide();
                }
            }

        }

        // -- Call Convertor
        WS_.convertionInit();
    });

    // -- Initially add #1 bonus as default (only if bonus is initiated on current page)
    // if( getCountry != 'BE' && getCountry != 'AT'  && getCountry != 'NL'  && getCountry != 'DE' && bonus_status && (!_checkout || _isCheckout) ) {
    if( bonus_status && (!_checkout || _isCheckout) ) {

        $('.the-btn-1').click();
        $('.the-btn-2').click();

        if( typeof(WSCh_checkout_bonus) !== 'undefined' )
            WSCh_checkout_bonus($('.the-btn-1'));

    }
}

// TODO: Refactor
// As far as I can see,
// the only real thing this does is setting WS_.storage['bonus_sum']
WS_.storage = function() {
    var output = {};

    if ( getCountry == "BA" ){
        // LPB form values
        var basePrice   = $("#product option").eq(0).val();
        basePrice       = basePrice.replace(/,/g, '.');
        basePrice       = basePrice.match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];

        if( $('#product option:nth-child(2)').length > 0){
            var secondPrice     = $("#product option").eq(1).val();
            secondPrice         = secondPrice.replace(/,/g, '.');
            secondPrice         = secondPrice.match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];
        }

        output.upsell       = basePrice * 0.5;

        // output.price        = basePrice;
        output.price        = $("#product option:selected").val().replace(/,/g, '.').match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];
        output.quantity     = $("#product")[0].selectedIndex + 1;
        output.state        = getCountry;
        var fullPriceVal    = $("#product").val();
    } else {
        var fullPriceVal    = $("#product").val();
        output.price        = fullPriceVal.match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];
        output.quantity     = $("#product")[0].selectedIndex + 1;
        output.state        = getCountry;
    }

    output.sku            = $('#dsku_form').val();
    output.postage        = getPostage;
    output.formBonus      = WS_.bonus['bonus_items'];

    if(typeof suprise_gift !== 'undefined' && suprise_gift == true ){
        if(typeof(surpriseProductPrice) != 'undefined'){
            output.surpriseProduct   = {price: surpriseProductPrice, full_sku: ch_gift_sku}
        }else{
            output.surpriseProduct   = {price: ch_gift_price, full_sku: ch_gift_sku}
        }
    }

    // -- Calculate total price combined with all bonuses/fees
    var bonus_price_sum   = 0;
    var bonus             = WS_.bonus['bonus_items'];
    bonus = typeof(bonus) == "undefined" ? [] : WS_.bonus['bonus_items'];

    for( var i = 0; i < bonus.length; i++ ) {
        if(bonus[i]['sku'] != 'POST-666-0038'){
            var temp          = parseFloat(bonus[i]['price']);
            bonus_price_sum   = parseFloat(bonus_price_sum) + temp;
        }
    }

    // -- Total bonuses summed up
    output.summed_bonus = bonus_price_sum.toFixed(2);

    WS_.storage['bonus_sum'] = bonus_price_sum.toFixed(2);

    return output;
}

// -- PAYMENT INIT
//================================================================
// TODO: Refactor
// Takes an element with selector '.payment-btn'
// Takes 'data-*' values and sets WS_.payment[xxx] values
// Based on the passed 'el' element
// Also does UI stuff like deselecting other payment methods, cleanup, etc.
WS_.payment = function(el) {

    // Variables
    var method          = $(el).attr('data-payment');
    var buttons         = $('.payment-btn input[type="radio"]');
    var system          = $(el).attr('data-system');
    var submethod       = "";
    var methodPrefix    = "";
    var submethodName   = "";

    if (system == "klarna"){
        submethod = $(el).attr('data-method');

        if(submethod == "klarna_pl"){
            //Klarna pay later
            methodPrefix = "pl";
            submethodName= "pay_later";
        } else if (submethod == "klarna_pn"){
            //Klarna Pay Now
            methodPrefix = "pn";
            submethodName= "pay_now";
        } else if (submethod == "klarna_pot"){
            //Klarna Pay Over time
            methodPrefix = "pot";
            submethodName= "pay_over_time";
        }
    }

    // -- Go through all payment methods and unselect currently selected
    for( i = 0; i < buttons.length; i++) {
        if(buttons[i].getAttribute('checked') == 'checked') {

            if( (method == 'cc' || method == 'pp') && buttons[i].id == 'card' && buttons[i].getAttribute('checked') == 'checked' ) {
                continue;
            }
            buttons[i].removeAttribute('checked');
        }
    }

    // -- Selected clicked payment method
    $(el).find('input[type="radio"]').attr('checked', true);

    // -- Store payment method
    WS_.payment['method']       = method;
    WS_.payment['system']       = system;
    WS_.payment['submethod']    = submethod;
    WS_.payment['methodPrefix'] = methodPrefix;
    WS_.payment['submethodName']= submethodName;

    // -- Set environment
    WS_.environment( system );

    WS_.callPaymentProcessor();
}

// Order form error handling
// It doesn't really handle any errors
// It just catches inputs on 'blur' and call insightCheck()
// Also removes class focused on blur
// ---- why are we adding class 'focused' when there's a selector for that?
WS_.errorHandler = function() {

    $('#order-form input').on('blur', function () {
        if( $(this).hasClass('invalid_field') && !$(this).hasClass('focused') ) {
            insightCheck( this );
        }

        if( $(this).hasClass('focused') )
            $(this).removeClass('focused');
    });

    // Initiate handler
    WS_.errorHandler['insight']   = [];
}

// What?
WS_.id = function(id = undefined, res = undefined) {

    var method = WS_.payment['method'];

    WS_.id['id'] = id;

    WS_.id['res'] = res;

}

// TODO: Refactor
WS_.checkoutStock = function() {
    
    var propStatus      = $('.sel-prop option:selected').val();
    var _propSelector   = $('.color-selector');
    var _mainProp       = $( '#mainProperty' ).val();

    var propertyArray   = [];

    //-- Get all properties
    $(".sel-prop:first option").each(function(e) {

        let prop = $(this).attr('data-variation');

        if( prop != null){
            propertyArray.push( $(this).attr('data-variation') );
        }

    });


    $.each( propertyArray, function( key, value ) {

        //-- Get all properties
        var stockArray = [];
        $('.comb[data-' + _mainProp + '="' + value + '"]').each(function(e) {

            let prop = $(this).attr('data-in-stock');

            stockArray.push(prop);

        });

        $('.comb[data-35="' + value + '"]').each(function(e) {

            let prop = $(this).attr('data-in-stock');

            stockArray.push(prop);

        });



        var totalStock = 0;

        //-- Get total stock
        for (var i = 0; i < stockArray.length; i++) {

            totalStock += stockArray[i] << 0;

        }
        $('.color-item').addClass('invalid_prop');

        // -- If picked property is in stock allow property
        if ( totalStock > 0 )  {
            $('.color-item-disabled[data-color="c' + value + '"]').addClass('color-item invalid_prop').removeClass('color-item-disabled');
            $('.sel-prop-form option[data-variation="'+ value +'"]').attr('disabled', false).removeClass('color-item-disabled');
        } else {

            $('.color-item[data-color="c' + value + '"]').removeClass('active').removeClass('color-item').addClass('color-item-disabled');
            $('.sel-prop-form option[data-variation="'+ value +'"]').attr('disabled', 'disabled').addClass('color-item-disabled');

            // Bind event when user pick some property to remove visual validation
            _propSelector.find('.color-item').on('click', function() {

                //   _propSelector.find('.color-item').removeClass('invalid_prop');

            });}

    });

}

// TODO: Refactor
WS_.checkoutVariationStock = function( property, variation, option = 1 ) {

    var propStatus      = $('.sel-prop option:selected').val();
    var _propSelector   = $('.color-selector');
    var firstProperty   = $(".sel-prop:first ").attr('data-property')
    var secoundProperty = $(".sel-prop:not(:first)").attr('data-property')
    var _mainProp       = $( '#mainProperty' ).val();
    var selectedQuantity = $('.choice-selected').data('quantity')

    var productVariation = '.product-variation-' + option + ' ';

    //- Get all properties
    var propertyArray = [];

    $(".sel-prop:eq(1) option").each(function(e) {

        let prop = $(this).attr('data-variation');

        if( prop != null){
            propertyArray.push( $(this).attr('data-variation') );
        }

    });


    $.each( propertyArray, function( key, value ) {
        var stockArray = [];

        $('.comb[data-' + secoundProperty + '="' + value + '"][data-' + firstProperty + '="' + variation + '"]').each(function(e) {

            let prop  = $(this).attr('data-in-stock');

            stockArray.push(prop);

            variationImage =  $(this).attr('data-img');


        });


        if(stockArray.length === 0 && (property !== _mainProp || firstProperty === secoundProperty)){ return }

        //-- Get total stock
        var totalStock = 0;
        for (var i = 0; i < stockArray.length; i++) {
            totalStock += stockArray[i] << 0;
        }

        // -- If picked property is in stock allow redirect to cart
        if ( totalStock > 0 ){

            $(productVariation + '.color-item-disabled[data-color="c' + value + '"]').addClass('color-item').removeClass('color-item-disabled');
            $('.sel-prop-form option[data-variation="'+ value +'"]').attr('disabled', false).removeClass('color-item-disabled');


        } else {

            $(productVariation + '.color-item[data-color="c' + value + '"]').removeClass('active').removeClass('color-item').addClass('color-item-disabled');
            $('.sel-prop-form option[data-variation="'+ value +'"]').attr('disabled', 'disabled').addClass('color-item-disabled');

            // Bind event when user pick some property to remove visual validation
            _propSelector.find('.color-item').on('click', function() {
                // _propSelector.find('.color-item').removeClass('invalid_prop');
            });
        }

    });
}

// TODO: Refactor
WS_.checkoutSystem = function( state ) {

    var _formBox        = $('.c076').length != 0 ? $('.c076') : $('#the-order-form');
    var propStatus      = $('.sel-prop option:selected').val();
    var _selector       = $('.selector-holder');
    var _propSelector   = $('.color-selector');
    var isSinglePage    = window.location.href.indexOf('checkout.php') != -1 ? 'checkout' : 'single';

    if( _checkout && state == 'load' ) {
        WS_.checkoutSystem['page'] = isSinglePage;

        _formBox.hide();
    }

    if( _checkout && ( propStatus != '' || propStatus == undefined ) && state == 'click' ) {


        var urlString   = '';
        var count       = 0;
        var _prop       = ($('.sel-prop option:selected').attr('data-variation') != undefined || $('.sel-prop option:selected').attr('data-variation') != null) ? $('.sel-prop option:selected').attr('data-variation') : '';
        var _mainProp   = $( '#mainProperty' ).val();
        var _stock      = $('.comb[data-' + _mainProp + '="' + _prop + '"]').attr('data-in-stock');



        var pickedPrice = $('#product option:selected').val().replace(/,/g, '.').match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];

        if( typeof(prices) !== "undefined" && typeof(prices) == "string" ) {

            prices = JSON.parse(prices);

        } else if( typeof(prices) === "undefined" ) {

            prices = {'default':{}};

            for(var i = 0; i < $('#product option').length; i++ ) {

                prices['default']['price_0'+(i+1)] = parseFloat($("#product option").eq(i).val().replace(/,/g, '.').match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0]);

            }
        }

        // -- Array of params to pass through query string

        let date        = new Date().getTime();
        let sku         = $( '#dsku_form' ).val();
        let onlyUrl     = window.location.href.replace(window.location.search,'');

        // -- Image exception for webshop and single pages
        let imgFullPath = (typeof templateType !== 'undefined' && templateType == 'webshop' ) ? 'https://' + fullDomain + '/' +product_image : onlyUrl + product_image;


        var dataArray = {
            "pr1x"         : JSON.stringify(prices['default']['price_01']),
            "pr2x"         : JSON.stringify(prices['default']['price_02']),
            "pr3x"         : JSON.stringify(prices['default']['price_03']),
            "paramVal"     : _prop,
            "param"        : ($('.sel-prop option:selected').val() != undefined || $('.sel-prop option:selected').val() != null) ? $('.sel-prop option:selected').val() : '',
            "sku"          : $('#dsku_form').val(),
            "productName"  : product,
            "quantity"     : $('.selectBox option:selected').text().replace('x', ''),
            "price"        : pickedPrice,
            "currency"     : _currency,
            "image"        : imgFullPath,
            "date"         : date.toString(),
            "fullDomain"   : fullDomain,
            "fbcat"        : fbcat,
            "gcat"         : gcat,
            "deliveryDay"  : deliveryDay,
            "deliveryDate" : deliveryDate,

        }


        var splitFullDomain = fullDomain.split('/')[0];
        // Set cookie - last added product sku
        document.cookie="last_product_sku="+sku+";path=/; domain="+splitFullDomain;

        var bundleProduct   = 0;
        var data = JSON.parse(localStorage.getItem("cartData"));

        $.each( data, function( key, value ){

            if(value.fullDomain === fullDomain && value.bundleProduct != undefined){
                bundleProduct = value.bundleProduct;
            }

        })


        if(bundleProduct == 1){

            $.each( data, function( key, value ){

                if(value.fullDomain === fullDomain){

                    bundleProductSku = value.sku;
                    // Set cookie - last added product sku
                    document.cookie="last_product_sku="+bundleProductSku+";path=/; domain="+splitFullDomain;

                    return false;

                }

            })

        }
        if(typeof(hasCheckout) != 'undefined' && hasCheckout == 1 && $('.color-selector')[0]){

            selectedProducts = [];
            if( typeof( $('.product-variation-1 .active').data('variation')) !== 'undefined' ){
                quantityPrice = pickedPrice;
            }
            if( typeof( $('.product-variation-2 .active').data('variation')) !== 'undefined' && typeof( $('.product-variation-2 .active').data('variation')) !== 'undefined' ){
                quantityPrice = (Number(pickedPrice) / 2).toFixed(2);
            }
            if( typeof( $('.product-variation-3 .active').data('variation')) !== 'undefined' && typeof( $('.product-variation-2 .active').data('variation')) !== 'undefined' && typeof( $('.product-variation-3 .active').data('variation')) !== 'undefined'  ){
                quantityPrice = (Number(pickedPrice) / 3).toFixed(2);
            }
            if( typeof( $('.product-variation-1 .active').data('variation')) !== 'undefined' ){
                dataArray.paramVal = $('.product-variation-1 .active').data('variation').toString();
                dataArray.quantity = '1';
                dataArray.price    = quantityPrice.toString();
            }
            if( typeof($('.product-variation-1 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-1 .active:eq(1)').data('sku')) !== 'undefined' ){

                let property1 = $('.product-variation-1 .active:eq(0)').data('property')
                let property2 = $('.product-variation-1 .active:eq(1)').data('property')
                let variation1 = $('.product-variation-1 .active:eq(0)').data('variation')
                let variation2 = $('.product-variation-1 .active:eq(1)').data('variation')
                let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                var variationSku = sku

            }else{
                var variationSku = $('.product-variation-1 .active').data('sku');
            }
            selectedProducts.push(variationSku);
            sku  = variationSku;
            dataArray.param    = $('.product-variation-1 .active').first().text() ? $('.product-variation-1 .active').first().text() : $('.product-variation-1 .active').first().data('property-name');
            dataArray.sku      =sku;
            let currentImage   = $('.product-variation-1 .active').find('.property-image').attr('src')
            if(currentImage != '' && typeof(currentImage) !== 'undefined'){  dataArray.image    = 'https://' + fullDomain + '/' + currentImage; }

        }

        // -- Add item to local storage
        WS_.localStorageAddItem( sku, dataArray );

        if(typeof(hasCheckout) != 'undefined' && hasCheckout == 1 && $('.color-selector')[0]){

            if( typeof( $('.product-variation-2 .active').data('variation')) !== 'undefined' ){
                if( typeof($('.product-variation-2 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-2 .active:eq(1)').data('sku')) !== 'undefined' ){
                    let property1 = $('.product-variation-2 .active:eq(0)').data('property')
                    let property2 = $('.product-variation-2 .active:eq(1)').data('property')
                    let variation1 = $('.product-variation-2 .active:eq(0)').data('variation')
                    let variation2 = $('.product-variation-2 .active:eq(1)').data('variation')
                    let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                    variationSku = sku
                }else{
                    variationSku = $('.product-variation-2 .active').data('sku');
                }
                selectedProducts.push(variationSku);
                let paramVal = $('.product-variation-2 .active').first().text() ? $('.product-variation-2 .active').first().text() : $('.product-variation-2 .active').first().data('property-name');
                let quantity = selectedProducts.filter(x => x === variationSku).length
                let price = (quantity * quantityPrice).toFixed(2);
                dataArray.param = paramVal;
                dataArray.sku = variationSku;
                dataArray.quantity = String(selectedProducts.filter(x => x === variationSku).length);
                dataArray.paramVal = $('.product-variation-2 .active').data('variation').toString();
                dataArray.price = price.toString();
                let currentImage   = $('.product-variation-2 .active').find('.property-image').attr('src')
                if(currentImage != '' && typeof(currentImage) !== 'undefined'){  dataArray.image    = 'https://' + fullDomain + '/' + currentImage; }
                WS_.localStorageAddItem( variationSku, dataArray );
            }


            if( typeof( $('.product-variation-3 .active').data('variation')) !== 'undefined' ){
                if( typeof($('.product-variation-3 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-2 .active:eq(1)').data('sku')) !== 'undefined' ){
                    let property1 = $('.product-variation-3 .active:eq(0)').data('property')
                    let property2 = $('.product-variation-3 .active:eq(1)').data('property')
                    let variation1 = $('.product-variation-3 .active:eq(0)').data('variation')
                    let variation2 = $('.product-variation-3 .active:eq(1)').data('variation')
                    let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                    variationSku3 = sku
                }else{
                    variationSku3 = $('.product-variation-3 .active').data('sku');
                }
                selectedProducts.push(variationSku3);
                let paramVal3 = $('.product-variation-3 .active').first().text() ? $('.product-variation-3 .active').first().text() : $('.product-variation-3 .active').first().data('property-name');
                let quantity = selectedProducts.filter(x => x === variationSku3).length
                let price = (quantity * quantityPrice).toFixed(2);
                dataArray.param = paramVal3;
                dataArray.sku = variationSku3;
                dataArray.quantity = String(selectedProducts.filter(x => x === variationSku3).length);
                dataArray.paramVal = $('.product-variation-3 .active').data('variation').toString();
                dataArray.price =  price.toString();
                let currentImage   = $('.product-variation-3 .active').find('.property-image').attr('src')
                if(currentImage != '' && typeof(currentImage) !== 'undefined'){  dataArray.image    = 'https://' + fullDomain + '/' + currentImage; }
                WS_.localStorageAddItem( variationSku3, dataArray );
            }

        }


        WS_.freeShipingCheck()

        for ( item in dataArray ) {
            var sign = count == 0 && window.location.search == '' ? '?' : '&';

            urlString += sign + item + '=' + Base64.encode(dataArray[item]); count ++;
        }

        // -- If property is defined, check property stock
        // -- If picked property is in stock allow redirect to cart
        if ( _prop == '' || ( _prop != ''  ) ) {
            // display add to cart box
            let addedToCart = document.querySelector('.addedToCart');

            if(_checkout){
                addedToCart.style.display = 'flex';
            }
            // -- Redirect user
            setTimeout(function(){
                //EVENTFULL DAY
                //FB
                if(typeof fbq == 'function' && fbq != 'undefined'){
                    fbq('track', 'AddToCart', {
                        content_ids: [WS_.storage()['sku']],
                        content_name: product,
                        value: parseFloat(WS_.convertToEUR(WS_.storage()['price']).toFixed(2)),
                        currency:'EUR',
                        content_type: 'product'
                    });
                }

                //GA
                if(typeof gtag == 'function' && gtag != 'undefined'){
                    gtag('event', 'add_to_cart', {
                        items: [{
                            item_id: WS_.storage()['sku'],
                            item_name: product,
                            price: parseFloat(WS_.convertToEUR(WS_.storage()['price']).toFixed(2)),
                            item_category: gcat,
                            quantity: WS_.storage()['quantity'],
                            currency:'EUR'
                        }]
                    });
                }

                // Pintrest
                if(typeof pintrk == 'function' && pintrk != 'undefined'){
                    pintrk('track', 'AddToCart', {
                        product_price: parseFloat(WS_.convertToEUR(WS_.storage()['price']).toFixed(2)),
                        currency: 'EUR',
                        product_category: gcat,
                        product_id: WS_.storage()['sku'],
                        product_name: product
                    });
                }

                // Tiktok
                if(typeof ttq == 'object' && ttq != 'undefined'){
                    ttq.track('AddToCart', {
                        content_id: WS_.storage()['sku'],
                        content_type: 'product',
                        content_name: product,
                        quantity: WS_.storage()['quantity'],
                        price: parseFloat(WS_.convertToEUR(WS_.storage()['price']).toFixed(2)),
                        currency: 'EUR',
                    });
                }

                // Z Optimize redirection handler
                var cartRedirectLocation
                if(typeof Z_OPTI_cartRedirect != 'undefined' && Z_OPTI_cartRedirect != ""){
                    cartRedirectLocation = Z_OPTI_cartRedirect;
                }else{
                    cartRedirectLocation = 'cart.php'
                }

                // Check if cartRedirect is defiend ( 1/0/undefined )
                if(typeof cartRedirect !== 'undefined' ){

                    if( cartRedirect == 0){

                        if(typeof(directCheckoutRedirect) != 'undefined' && directCheckoutRedirect == 1){

                            if(_checkout){
                                window.location.href ='checkout.php' + window.location.search;
                            }

                        }else{

                            if(_checkout){
                                window.location.href = cartRedirectLocation + window.location.search;
                            }
                        }

                    }else if( cartRedirect == 1){

                        SideCart_.start();

                    }
                }else{
                    //  if directCheckoutRedirect is defined
                    if(typeof(directCheckoutRedirect) != 'undefined' && directCheckoutRedirect == 1){

                        if(_checkout){
                            window.location.href ='checkout.php' + window.location.search ;
                        }
                    }
                    //  if cartRedirect is undefiend
                    if(_checkout){
                        window.location.href = cartRedirectLocation + window.location.search;
                    }
                }

            },500);

        } else {

            //  $('.color-item[data-color="c' + _prop + '"]').removeClass('active').addClass('invalid_prop');
            // Bind event when user pick some property to remove visual validation
            _propSelector.find('.color-item').on('click', function() {
                _propSelector.find('.color-item').removeClass('invalid_prop');
            });
        }


    } else {

        $('.sel-prop').append('<option value="" selected disabled hidden>' + chooseText + '</option>');

        // -- Add visual validation
        _propSelector.find('.color-item').addClass('invalid_prop');

        // Bind event when user pick some property to remove visual validation
        _propSelector.find('.color-item').on('click', function() {
            //  _propSelector.find('.color-item').removeClass('invalid_prop');
        });
        // -- Scroll user to property picker
        if( state == 'click' ) {
            $('.c049').select();
            $('html, body').animate({
                //    scrollTop: $(".c049").offset().top - 200
            }, 1000);
        }

        return false;

    }

}

// TODO: Refactor
// Sets WS_.orderFormValidation['status']
WS_.orderFormValidation = function(check = false) {
    var a           = {};
    var error       = false;
    var inputs  = $('#order-form input');
    var select  = $('#order-form select[data-mandatory="true"]');
    var special = $('[data-special="select"]');
    var propStatus  = $('.sel-prop option:selected').val();
    var _prop       = ($('.sel-prop option:selected').attr('data-variation') != undefined || $('.sel-prop option:selected').attr('data-variation') != null) ? $('.sel-prop option:selected').attr('data-variation') : '';

    if( typeof(propStatus) != 'undefined' && _prop == '' && check == false && hasCheckout != 1 ){

        $('html, body').animate({
            scrollTop: $(".c049").offset().top - 200
        }, 1000);

        return false;

    }

    if( special.length > 0 ) {

        inputs = [...inputs, ...special];

    }

    for (var i = 0; i < inputs.length; i++) {

        var field       = $(inputs[i]).attr('data-field');
        var placeholder = $(inputs[i]).attr('placeholder');
        var mandatory   = $(inputs[i]).attr('data-mandatory') == 'true' ? true : false;
        var specialBox  = $(inputs[i]).next().find('.select2-selection--single');

        // -- Take only inputs that have defined data-field
        // -- so categorization is possible
        if( field ) {

            if( mandatory && $(inputs[i]).val() == '' || $(inputs[i]).val() == placeholder || ( field == 'name' && !checkUsername() ) || $(inputs[i]).val() == null ) {

                if( !check ) {
                    $(inputs[i]).addClass('invalid_field');

                    $(inputs[i]).parent().find('.mandatory_field').addClass('appear');

                    if ( $(inputs[i]).attr('data-special') )
                        specialBox.addClass('ease-out invalid_select');

                    insightCheck( inputs[i] );
                }

                if ( !failed.includes( $(inputs[i]).attr('name') ) )
                    failed.push( $(inputs[i]).attr('name') );

                if ( !submitInsight.includes( $(inputs[i]).attr('name') ) ) {
                    submitInsight.push( $(inputs[i]).attr('name') );
                }

                error = true;

            } else {

                if ( $(inputs[i]).attr('data-special') )
                    specialBox.removeClass('ease-out invalid_select');

                /**
                 * Check if key already exists in payload object
                 * If exists add field value on already existing value
                 * If not just set new input
                 */
                if ( field in a ) {

                    if ( $(inputs[i]).val() != '' ){

                        if( field == 'comment' ) {
                            a[field] += ' ' + $(inputs[i]).attr('id') + ' ' + $(inputs[i]).val();
                        } else {
                            a[field] += ' ' + $(inputs[i]).val();
                        }

                    }

                } else {

                    if( field == 'comment' ) {
                        a[field] = $(inputs[i]).attr('id') + ' ' + $(inputs[i]).val();
                    } else {
                        a[field] = $(inputs[i]).val();
                    }
                }

                for( key in failed ) {

                    if( failed[key] == $(inputs[i]).attr('name') ) {
                        delete failed[key];

                        failed = failed.filter(function(item) {return item !== undefined});
                    }
                }

                for( key in submitInsight ) {

                    if( submitInsight[key] == $(inputs[i]).attr('name') ) {
                        delete submitInsight[key];

                        submitInsight = submitInsight.filter(function(item) {return item !== undefined});
                    }
                }

            }

        }

    }

    // -- Property validator (color, size etc...)
    if(typeof new_system === 'undefined'){
        var property_ = $('select[name^=prop_]');
        property_.each(function(i){
            if(property_[i].length > 0 && $('option:selected',property_[i]).text() == chooseText || $('option:selected',property_[i]).text() == prop_static[i] || $('option:selected',property_[i]).attr('disabled')){
                error = true;

                if( !check )
                    stockController(error, 'submit');

            } else {
                stockController(false, this);
            }
        });
    }

    // -- Only for IT
    if (getCountry == "IT") {
        a.region = $("#province").val();
    }

    if(typeof mlId != 'undefined' && typeof pflId != 'undefined'){
        a.lidms = mlId;

        if (pflId != ''){
            Number(pflId);
        }

        a.profile = pflId;
    }

    var order_items = $.merge($.merge([], WS_.storage()['formBonus']), WS_.localStorageDataArray());


    if (typeof new_system !== 'undefined'){
        var postage_key = 0;
    }else{
        var postage_key = WS_.storage()['postage'];
    }


    // -- Data
    var data = WS_.localStorageGetAll();

    // -- Sum all items quntity
    var sumQuantity = 0;
    $.each( data, function( key, value ){
        if( value.fullDomain === fullDomain ){
            sumQuantity += parseFloat( value.quantity )
        }
    })

    // Products handling for old system
    if(typeof new_system === 'undefined'){
        a.price         = WS_.storage()['price'];
        a.quantity      = WS_.storage()['quantity'];
        a.getSku        = WS_.storage()['sku'];
        a.formBonus     = JSON.stringify( WS_.storage()['formBonus'] );



        var selectedQuantity = $('.choice-selected').data('quantity')

        productsSku = [];
        if( typeof(prices) !== "undefined" && typeof(prices) == "string" ) {
            prices = JSON.parse(prices);
        } else if( typeof(prices) === "undefined" ) {
            prices = {'default':{}};
            for(var i = 0; i < $('#product option').length; i++ ) {
                prices['default']['price_0'+(i+1)] = parseFloat($("#product option").eq(i).val().replace(/,/g, '.').match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0]);
            }
        }


        if( typeof( $('.product-variation-1 .active').data('variation')) !== 'undefined' ){
            if( typeof($('.product-variation-1 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-1 .active:eq(1)').data('sku')) !== 'undefined' ){
                let property1 = $('.product-variation-1 .active:eq(0)').data('property')
                let property2 = $('.product-variation-1 .active:eq(1)').data('property')
                let variation1 = $('.product-variation-1 .active:eq(0)').data('variation')
                let variation2 = $('.product-variation-1 .active:eq(1)').data('variation')
                let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                variationSku1 = sku
            }else{
                variationSku1 = $('.product-variation-1 .active').data('sku');
            }
            productsSku.push(variationSku1);
            var price =  prices['default']['price_01']
            a.quantity = 1;
            a.price = Number(price);
        }

        if( typeof( $('.product-variation-2 .active').data('variation')) !== 'undefined' ){
            if( typeof($('.product-variation-2 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-2 .active:eq(1)').data('sku')) !== 'undefined' ){
                let property1 = $('.product-variation-2 .active:eq(0)').data('property')
                let property2 = $('.product-variation-2 .active:eq(1)').data('property')
                let variation1 = $('.product-variation-2 .active:eq(0)').data('variation')
                let variation2 = $('.product-variation-2 .active:eq(1)').data('variation')
                let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                variationSku2 = sku
            }else{
                variationSku2 = $('.product-variation-2 .active').data('sku');
            }
            productsSku.push(variationSku2);
            var price =  prices['default']['price_02']
            a.quantity = 1;
            a.price = WS_.priceRounding(Number(price / 2));
        }


        if( typeof( $('.product-variation-3 .active').data('variation')) !== 'undefined' ){
            if( typeof($('.product-variation-3 .active:eq(0)').data('sku')) !== 'undefined' && typeof($('.product-variation-3 .active:eq(1)').data('sku')) !== 'undefined' ){
                let property1 = $('.product-variation-3 .active:eq(0)').data('property')
                let property2 = $('.product-variation-3 .active:eq(1)').data('property')
                let variation1 = $('.product-variation-3 .active:eq(0)').data('variation')
                let variation2 = $('.product-variation-3 .active:eq(1)').data('variation')
                let sku = $('.comb[data-'+property1+'="'+variation1+'"][data-'+property2+'="'+variation2+'"]').data('sku');
                variationSku3 = sku
            }else{
                variationSku3 = $('.product-variation-3 .active').data('sku');
            }
            productsSku.push(variationSku3);
            var price =  prices['default']['price_03']
            a.quantity = 1;
            a.price = WS_.priceRounding(Number(price / 3));
        }


        if (productsSku.length != 0) {
            a.getSku   = productsSku;
        }

    }else{
        a.formBonus     = JSON.stringify(order_items);
        a.quantity      = sumQuantity;

    }

    // custom param for clearance
    if (brandID == 9 || brandID == 15 || brandID == 22) {
        a.sellout = 1;
    }


    // forward flow param to OMG
    var pageFlow;
    if(hasCheckout == 1){
        pageFlow = 'cart'
    }else{
        pageFlow = 'direct'
    }

    //check stock
    if(bundleStockCheck() == true && typeof(bundleSku) !== "undefined" && bundleSku != "null"){
        a.bundleSku = JSON.stringify(bundleSku);
    }else{
        //default
        a.bundleSku = 'null';
    }

    a.postage                = postage_key;
    a.bonus                  = bonus != 'off' ? 'on' : 'off';
    a.epay                   = epay;
    a.paymentmethod          = WS_.payment['method'].toUpperCase();
    a.state                  = getCountry;
    a.comment                = $('#komentar').val();
    a.shop_id                = typeof(shopIdentifier) !== undefined ? shopIdentifier : '';
    a._fbp                   = fbp_c;
    a._fbc                   = fbclid_c;
    a.pageFlow               = pageFlow;
    spr                      = WS_.storage()['price'];
    cCode                    = WS_.storage()['state'];
    usrn                     = a.name;
    usurn                    = typeof(a.surname) !== 'undefined' ? a.surname : '';
    cty                      = a.city;
    pstl                     = a.postcode;
    ueml                     = a.email;
    phne                     = a.telephone;
    SIBListId                = SIBListId;
    // couponUrlString          = liveTap['coupon'] ? liveTap['coupon'] : '';
    couponUrlString          = '';
    skulog                   = WS_.storage()['sku'];
    // a.coupon                 = liveTap['coupon'];
    // a.couponType             = liveTap['couponType'];
    // a.couponValue            = liveTap['couponValue'];
    // a.couponCalculatedPrices = JSON.stringify(liveTap['couponCalculatedPrices']);
    if(zOptimizeTestData != ''){
        a.zOptimizeTestDataObject = zOptimizeTestData;
    }else if(typeof(breakdownFormTestData) != 'undefined'){
        a.zOptimizeTestDataObject = breakdownFormTestData;
    }


    // Temporary country check, until this is scaled to other countries
    if (WS_.storage()['state'] != 'SI' && WS_.storage()['state'] != 'BG' && WS_.storage()['state'] != 'RS' && WS_.storage()['state'] != 'BA') {
        a.skipBook = !$('.book-bonus-element').length || $('.book-bonus-element .the-btn.clicked').length ? 0 : 1;
    }

    if((typeof suprise_gift !== 'undefined' && suprise_gift == true) && (typeof removedSurpriceProduct != 'undefined' && removedSurpriceProduct != 1 )){
        if(typeof surpriseProductPrice != 'undefined'){
            a.surpriseProduct        = {price: surpriseProductPrice, full_sku: ch_gift_sku}
        }else{
            a.surpriseProduct        = {price: ch_gift_price, full_sku: ch_gift_sku}
        }
    }

    if (typeof new_system !== 'undefined'){
        a.newSystem     = new_system;
    }

    if( typeof(a.surname) != "undefined" ) {
        usurn = a.surname;
    } else {
        usurn = '';
    }

    if (typeof(a.houseno) != "undefined") {
        addr = a.address + ' ' + a.houseno;
    } else {
        addr = a.address;
    }

    // -- Return data format
    var payload = {"status": error, "payload": a};

    // -- Direct status
    WS_.orderFormValidation['status'] = error;

    return payload;
}

// TODO: Refactor
// Didn't go into this one, my guess is it handles the [1-2-3] steps on the form
// But I'm not sure
WS_.multistep = function(direction) {

    var step            = WS_.multistep['step'];
    var error           = false;
    var previous_step   = $('div[class*="-module"][data-step="' + step + '"]');
    var inputs          = $('div[class*="-module"][data-step="' + step + '"] input');
    var step_btn        = $('.step-button-wrapper');
    var order_btn       = $('.order-button-wrapper');
    var previous_btn    = $('.step-button[data-direction="previous"]');

    // -- Validate all steps in current step/module
    for (var i = 0; i < inputs.length; i++) {

        var field       = $(inputs[i]).attr('data-field');
        var placeholder = $(inputs[i]).attr('placeholder');
        var mandatory   = $(inputs[i]).attr('data-mandatory') == 'true' ? true : false;

        // -- Take only inputs that have defined data-field
        // -- so categorization is possible
        if( field && direction == 'next' ) {

            if( mandatory && $(inputs[i]).val() == '' || $(inputs[i]).val() == placeholder) {

                $(inputs[i]).addClass('invalid_field');

                $(inputs[i]).parent().find('.mandatory_field').addClass('appear');

                error = true;

            }

        }

    }

    // -- Error check
    if ( !error ) {

        // -- Hide all boxes in previous step
        for(var i = 0; i < previous_step.length; i++) {
            $(previous_step[i]).hide();
        }

        // -- Count next step (depending on direction)
        WS_.multistep['step'] = direction == 'next' ? step + 1 : ( step > minStep ? step - 1 : 1 );

        // -- Hide all boxes in previous step
        var next_step   = $('div[class*="-module"][data-step="' + WS_.multistep['step'] + '"]');

        for(var i = 0; i < next_step.length; i++) {
            $(next_step[i]).show();
        }

    }

    // -- Detect last step
    if ( WS_.multistep['step'] == totalSteps ) {

        step_btn.hide();
        order_btn.show();

        if( WS_.payment['method'] == 'show' )
            $('.payment-block-wrapper').show();

    } else {

        step_btn.show();
        order_btn.hide();

        if( WS_.payment['method'] == 'show' )
            $('.payment-block-wrapper').hide();

    }


    // -- Show previous button
    if( WS_.multistep['step'] > 1)
        $('.step-button[data-direction="previous"]').show();


    // -- Hide order button if previous step is returned user to 1st step
    if( direction == 'previous' &&  WS_.multistep['step'] == 1 ) {

        previous_btn.hide();
        step_btn.show();
        order_btn.hide();

    }

}

// Calls apropriate payment processor method based on WS_.payment['method'] and WS_.payment['system']
// Which are set in the WS_.payment() method
// This also needs to be removed since we're doing payment processor initialization in each component
// (see views/components/checkout/payment-processors/js/stripe.blade.php)
WS_.callPaymentProcessor = function() {
    var method      = WS_.payment['method'];
    var system      = WS_.payment['system'];

    if ( method == 'cod' ) {
        // -- If something is needed define here ?!
    }

    else if ( method == 'cc' && (system == 'stripe' || system == 'ideal' || system == 'p24') && !WS_.state['cod'] && WS_.stripe['payload'] == undefined ) {
        // -- Initiate stripe checkout
        WS_.stripe();
    }

    else if ( method == 'pp' && system == 'paypal' ) {
        // -- Show loading modal
        $('.paypal-modal').css({"display":"flex"});

        // -- Initiate paypal express checkout
        WS_.paypal();
    } else if (method == 'cc' && system == 'giropay' ){

        // -- Initiate stripe Giropay checkout
        WS_.stripe();

    } else if (method == 'cc' && system == 'klarna' ){

        WS_.klarna();
    }
}

// I think:
// Sets the flags for turning payment methods on/off
// This is probably not needed since we're doing that in the backend
// Via the Zoho Fuse Box Payment Control panel and API
WS_.dashboardSubmit = function(status) {
    var method = WS_.payment['method'];

    if (status) {
        WS_.dashboardSubmit['status'] = {[method]: true};
    }
}
WS_.dashboardSubmit['status'] = {'pp': false, 'cc': false, 'cod': false};

// -- Main validate event for PayPal
// TODO: Refactor
WS_.paypal_validate = function(event, actions = false) {

    // -- Form validation
    var form_validation = WS_.orderFormValidation('data');

    // -- This condition is mandatory due to OMG spliting later on
    form_validation['payload'].paymentmodel = 'paypal';

    if( actions )
        WS_.paypal_validate['actions'] = actions;

    if( event == 'init' ) {
        // -- Hide loading modal
        $('.paypal-modal').hide();
    }

    // ** On initial checkout load
    if( event == 'load' ) {
        // -- Save status
        WS_.paypal_validate['error'] = form_validation['status'];
    }

    // ** On PayPal flow initialization
    else if ( event == 'init' && form_validation['status'] ) {

        // -- Save status
        WS_.paypal_validate['error'] = true;

        // -- Disable PayPal button
        WS_.paypal_validate['actions'].disable();

        // -- Get all mandatory form inputs
        var inputs          = $('#order-form input[data-mandatory="true"]').not('#email');

        var temp_validation = {};

        insightCheck( false, 'pp_validation', 'User clicked order button but form was not valid.' );

        // -- Set event for every input field
        for( i = 0; i < inputs.length; i++) {

            $(inputs[i]).on('blur', function() {

                var el      = $(this);
                var id      = el.attr('id');
                var class_  = $(this).attr('class');

                // -- Check if element have invalid_field class
                var cond    = class_.indexOf('invalid_field') > -1 ? true : false;

                if( !cond )
                    temp_validation[id] = 'valid';

                if( Object.keys(temp_validation).length == inputs.length ){

                    // -- Save status
                    WS_.paypal_validate['error'] = false;

                    // -- Enable Paypal Button
                    WS_.paypal_validate['actions'].enable();

                }
            });

        }

    }

    // ** On PayPal button click
    else if ( event == 'click' ) {

        // -- Trigger custom order form validation (visual one)
        WS_.orderFormValidation();

        // -- Call form modal
        if ( !WS_.orderFormValidation['status'] ) {

            // -- Remove bind event from username field
            window.removeEventListener('beforeunload', goinSomewhereMaybe, true);

            loadingState(true);

            // -- Send to OMG (only ONCE)
            if( !WS_.dashboardSubmit['status']['pp'] ) {

                // -- This is hardcoded due to PayPal paymentmethod issue
                form_validation['payload'].paymentmethod = 'PP';

                orderComplete( form_validation['payload'] );

                // -- Lock order
                WS_.dashboardSubmit(true);
            };
        }

    }
}

// REFACTORED
// Converts nativeCurrency value to EUR and returns it - NOT ALL METHOD RETURN RESULTS
WS_.convertedCurrency = function() {
    WS_.convertedCurrency['value'] = WS_.nativeCurrency['value'] / getExchangeRate();
    return WS_.convertedCurrency['value'];
}

// REFACTORED
// Adds fees + services to either the 'price' argument and converts to EUR,
// or converts nativeCurrency value to EUR if price if failsy
WS_.convertedCurrencyWithCoupon = function(price = 0) {
    let nativeCurrency = WS_.nativeCurrency['value'];

    // If arbitrary price was provided in argument, add fees and postage to given price
    // and don't use real base price from cart object
    if (price) {
        nativeCurrency = price + (nativeCurrency - WS_.nativeCurrencyBasePrice['value']);
    }

    WS_.convertedCurrencyWithCoupon['value'] = nativeCurrency / getExchangeRate();
}

// REFACTORED
// Converts given value to EUR
WS_.convertToEUR = function(value){
    return value / getExchangeRate();
}

// REFACTORED
// Returns pricec of products + fees + services
// In shop's currency
WS_.nativeCurrency = function() {
    let basePrice = WS_.nativeCurrencyBasePrice['value'];
    let bonusPrice = (WS_.bonus['bonus_items'] != undefined
        && WS_.bonus['bonus_items'].length > 0) ? WS_.storage()['summed_bonus'] : 0;

    // -- IN case bonuses or fees are added
    let nativePrice = basePrice + parseFloat(bonusPrice);

    // -- If postage is defined count it in
    if (getPostage == "1")
        nativePrice += parseFloat(postage_);

    WS_.nativeCurrency['value'] = parseFloat(nativePrice).toFixed(2);
}

// REFACTORED
// Returns price of only products in cart
// In shop's currency
WS_.nativeCurrencyBasePrice = function() {
    let data = WS_.localStorageGetAll()
    let sum = 0;

    $.each( data, function(key, value){
        if( value.fullDomain === fullDomain ) { sum += parseFloat( value.price ); }
    });

    let basePrice = parseFloat(sum);

    if(typeof(hasCheckout) !== "undefined" && !hasCheckout) { basePrice = parseFloat(WS_.storage()['price']); }

    WS_.nativeCurrencyBasePrice['value'] = parseFloat(basePrice).toFixed(2);
}

// REFACTORED
// Runs methods that populate the "function arrays"
// Based on items in user's cart
WS_.convertionInit = function(param) {
    WS_.convertedCurrency();
    WS_.convertedCurrencyWithCoupon()
    WS_.nativeCurrency();
    WS_.nativeCurrencyBasePrice();
}

// REFACTORED
// Sets array values onto function - I think this should not be done like this
// Flags for each payment method
// Sets up a redirect for 1500ms if 'condition' is true - it's always true?
WS_.state = function(state) {
    WS_.state['cod' ]   = false;
    WS_.state[ 'cc' ]   = false;
    WS_.state[ 'pp' ]   = false;

    if(state !== 'default') { WS_.state[state] = true; }

    // -- Catch method
    var method = WS_.payment['method'];

    // -- Declare redirect condition
    var condition = WS_.state[ 'cod' ];

    if (method !== 'cod') {
        if (WS_.state['cod'] && WS_.state[method]) {
            setCookie(method + '_submitted', true, 1);
        }
    }

    // If condition is fulfilled redirect to thanks
    if(condition) { redirect(1500); }
}

// REFACTORED
// Sets 'env' variable based on 'pdev' - why?
WS_.environment = function(system) {
    let env = 'live';

    if(pdev === 'on') {
        env = 'dev';

        if (system === 'payu' || system == 'paypal') {
            env = 'sandbox';
        }
    }

    WS_.environment['env'] = env;
}

// Triggers all method required for functionality
// These were previously thrown around zohomerce.js
// This will probably be fine even for our production
// It just needs to be packed properly and implemented
WS_.initialize = function() {
    WS_.convertionInit();
    WS_.freeShipingCheck();
    WS_.errorHandler();
    WS_.id();
    WS_.bonus();
    WS_.storage();
    WS_.environment();
    WS_.checkoutSystem('load');
    WS_.state('default');

    // -- Set default method payment
    if ( !WS_.payment['method'] ) {
        if ( getCountry == 'LV' && codPayment == 'off') {

            WS_.payment['method'] = 'show';

        } else if( getCountry == 'FI' || getCountry == 'DK' || getCountry == 'FR' || getCountry == 'DE' || getCountry == 'NL' || getCountry == 'BE' || getCountry == 'SE' || getCountry == 'GB' ) {

            if( ccPayment != 'off' ) {

                if( getCookie('cc_submited') != 'true' ) {
                    WS_.payment['method'] = 'cc';
                } else {
                    WS_.payment['method'] = 'show';
                }

            } else {

                WS_.payment['method'] = 'pp';

            }


        } else {
            WS_.payment['method'] = 'cod';
        }
    }

    //-- Check all warehouse check
    if( warehouseCheck != 'off' || warehouseCheck != 'eu1'){

        //-- Check all properties
        setTimeout(function(){ WS_.checkoutStock() }, 200);

    }
}

// This is a mess of logic that was placed
// In several '.ready' and 'on('load')' calls
// They were "chronologically" copies into this function
// TODO: Refactor and move to dedicated functions
function onLoadHandling() {

    $(document).on('click', '.btn2', function(){

// Buttons scroll to selector if property not selected (on webshop product pages)
        if ( (window.templateType === 'webshop') && (document.querySelector('.c088') !== null)) {
            $('html, body').animate({
                scrollTop: $('.c088').offset().top - $(".c088").height() *3
            }, 1000);
        }

        if(typeof gtag == 'function' && gtag != 'undefined'){
            gtag('event', 'buttonClick', {'event_category': 'Button click', 'event_label': 'redirect'});
        }
    });

    $('.input-item input').not('#email').keyup(
        function greenField () {

            // -- Control variables
            var condition   = false;

            // -- Check is field valid
            if ( !$(this).hasClass('crvenaS') && $(this).val().length > 1 ) {

                if( $(this).attr('id') == 'ime' ) {

                    if ( checkUsername() )
                        condition = true;

                } else if( $(this).attr('id') != 'ime' ) {

                    condition = true;

                }

            }

            // -- Condition / on the fly validation ( real-time validation )
            if(condition) {

                $(this).css({"background-color":"#eaf9f0","border":"1px solid #eaf9f0", "box-shadow":"0px 0px 5px #2ecc71"});

            } else {

                $(this).removeAttr("style");

            }
        });

    //E-mail input check
    $('#email').keyup(
        function emailGreenField (){
            if($('#email').val().length > 1 && $('#email').val().match(emailUzorak)) {
                $('#email').css({"background-color":"#eaf9f0","border":"1px solid #eaf9f0", "box-shadow":"0px 0px 5px #2ecc71"});
            } else {
                $('#email').removeAttr("style");
            }
        });

    //Phone
    $('#phone').keypress(
        function isNumberKey(evt){

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;

        }
    );

    var mainPid = $( '#mainProperty' ).val();

    var selNumber = $( '.sel-prop' ).length;

    $('.sel-prop').on( 'change', function(){

        let pid     = $( this ).attr( 'data-property' );
        let vid     = $( this ).find( 'option:selected' ).attr( 'data-variation' );
        let comb    = findCombination();

        if ( comb && $( '.c038 > .img1 > .c039[src="' + comb.attr( 'data-img' ) + '"]' ).length ) {

            if( comb.attr( 'data-img' ) ){

                //define global product image when its changed
                product_image = comb.attr( 'data-img' );

                //change local image based on poduct variation
                $( ".product_img" ).attr( 'src', product_image );

            }

        }

        if ( !comb ) { comb = $( '.comb.default' ); }
        $( '.sel-prop-form[data-property="' + pid + '"]' ).find( 'option[data-variation="' + vid + '"]' ).prop( 'selected', true );

        if ( (typeof warehouseCheck !== typeof undefined && ( warehouseCheck === 'false' || warehouseCheck === 'on'  || warehouseCheck === 'eu1' ) ) && typeof mainPid !== typeof undefined && mainPid && String( mainPid ) !== "0" && typeof selNumber !== typeof undefined  && ( String( selNumber ) === "1" || String( selNumber ) === "2" ) ) {

            let mainVid = $( '.sel-prop[data-property="' + mainPid + '"]' ).find( 'option:selected' ).attr( 'data-variation' );

            let relevantCombinations = String( selNumber ) === "2" ? $( '.comb[data-' + mainPid + '="' + mainVid + '"]' ) : $( '.comb[data-' + mainPid );

            let length = relevantCombinations.length;

            for ( let index = 0; index < length; index++ ) {

                let combination = $( relevantCombinations[ index ] );

                let attributes = JSON.parse( JSON.stringify( combination.data() ) );

                let inStock = attributes[ "inStock" ];


                if( attributes['inStock'] == '' )
                    out_of_stock_ +=1;

                delete attributes.sku;
                delete attributes.img;
                delete attributes[ "inStock" ];
                delete attributes.price;
                if ( String( selNumber ) === "2" ) delete attributes[ mainPid ];
                for ( let pid in attributes ) {

                    let vid = attributes[ pid ];

                    let propOption = $( '.sel-prop[data-property="' + pid + '"]' ).find( 'option[data-variation="' + vid + '"]' );

                    let propText = propOption.text();

                    let propFormOption = $( '.sel-prop-form[data-property="' + pid + '"]' ).find( 'option[data-variation="' + vid + '"]' );

                    let propFormText = propFormOption.text();

                    if ( typeof inStock !== typeof undefined && ( String( inStock ) === "" || String( inStock ) === "0" ) ) {

                        // propOption.text( propText.replace( ' - ' + soldOutText, '') + ' - ' + soldOutText );

                        //  propFormOption.text( propFormText.replace( ' - ' + soldOutText, '') + ' - ' + soldOutText );

                        propOption.prop( 'disabled', true );
                        propFormOption.prop( 'disabled', true );

                        // -- Hide out of stock models
                        propOption.hide();
                        propFormOption.hide();

                    } else {

                        // propOption.text( propText.replace( ' - ' + soldOutText, '') );

                        // propFormOption.text( propFormText.replace( ' - ' + soldOutText, '') );

                        propOption.prop( 'disabled', false );
                        propFormOption.prop( 'disabled', false );

                        // -- Show out of stock models
                        propOption.show();
                        propFormOption.show();
                    }

                }


            }

        }


        // -- Stock controller
        if($('select[data-property="36"] option:selected').attr('disabled')) {
            stockController(true);
        } else {
            stockController(false);
        }


        let price1 = comb.attr( 'data-price-1' );
        let price2 = comb.attr( 'data-price-2' );
        let price3 = comb.attr( 'data-price-3' );

        let getPostageBool = getPostage === "0" ? false : true;

        tmpPostage = "";

        if ( getPostageBool ) {

            tmpPostage = ' + ' + getPostageText;

        }

        let selQuantity = $( '.choice-selected' ).attr( 'data-quantity' );

        $( '.input-item > #product' ).html( '<option value="' + price1 + '">1 x - ' + price1.split(' | ')[ 0 ] + tmpPostage  +'</option>' +
            '<option value="' + price2 + '" ' + ( selQuantity == 2 ? 'selected' : '' ) + '>2 x - ' + price2.split(' | ')[ 0 ] + tmpPostage  + '</option>' +
            '<option value="' + price3 + '" ' + ( selQuantity == 3 ? 'selected' : '' ) + '>3 x - ' + price3.split(' | ')[ 0 ] + tmpPostage  + '</option>' );

        $( '.c049 > .c051 .selectBox' ).html( '<option value="' + price1 + '">1x</option>' +
            '<option value="' + price2 + '" ' + ( selQuantity == 2 ? 'selected' : '' ) + '>2x</option>' +
            '<option value="' + price3 + '" ' + ( selQuantity == 3 ? 'selected' : '' ) + '>3x</option>' );

        let activePrice = $( '.c049 > .c051 .selectBox' ).val().split( ' | ' )[ 0 ];
        $(".price1 > span").html( activePrice );
        if( typeof(ud_price_percentage) != 'undefined' && ud_price_percentage != '' ){
            let undiscountedPrice = Math.round( parseFloat( activePrice.replace( /\D[.]/g, '' ) ) /  ( ( 100 - ud_price_percentage ) / 100 ) ).toFixed( 0 );

            $('.t9-discount > span, .circle_holder > span').text( '-' + ud_price_percentage + '%' )
            $('.discount').text( '-' + ud_price_percentage + '%' )
            $(".c052, .old_p").html( undiscountedPrice);
            $('.price-x2').text(  undiscountedPrice  + _currency )
        }else{
            $(".price1 > .c052").html( ( parseFloat( activePrice.replace( /\D[.]/g, '' ) ) * 2 ).toFixed( 0 ) );
        }
        $( "#dsku_form" ).val( comb.attr( 'data-sku' ) );

    });

    function changeSelection(pakiranje) {
        var eID = document.getElementById("i001");
        switch (pakiranje) {
            case 1:
                eID.options[0].selected = "true";
                break;
            case 2:
                eID.options[1].selected = "true";
                break;
            case 3:
                eID.options[2].selected = "true";
                break;
        }
    }

    // handlePropLoad();

    $('.img1').click(function() {

        $( ".selector_img" ).attr('src', $(this).find('img').attr('src'));

        if ( !$( this ).hasClass( 'bl-sl' ) ) {

            $(".product_img").attr('src', $(this).find('img').attr('src'));

        }

    });

    $(".selectBox").change(function() {
        $("#product").val($(this).val());
        var value = $(this).val();

        let activePrice = $( '.c049 > .c051 .selectBox' ).val().split( ' | ' )[ 0 ];
        $(".price1 > span").html( activePrice );
        $(".new_p ").html( activePrice );
        if( typeof(ud_price_percentage) != 'undefined' && ud_price_percentage != '' ){
            let undiscountedPrice = Math.round( parseFloat( activePrice.replace( /\D[.]/g, '' ) ) /  ( ( 100 - ud_price_percentage ) / 100 ) ).toFixed( 0 );

            $('.t9-discount > span, .circle_holder > span').text( '-' + ud_price_percentage + '%' )
            $('.discount').text( '-' + ud_price_percentage + '%' )
            $(".c052, .old_p").html( undiscountedPrice);
            $('.price-x2').text(  undiscountedPrice  + _currency )
        }else{
            $(".price1 > .c052").html( ( parseFloat( activePrice.replace( /\D[.]/g, '' ) ) * 2 ).toFixed( 0 ) );
        }
        $('.value1, .value2, .value3').each(function() {
            if ($('.value1').prop("selected") == true) {
                $(".price1").show();
                $(".c056").hide();
                $(".c057").hide();
            } else if ($('.value2').prop("selected") == true) {
                $(".c056").show();
                $(".price1").hide();
                $(".c057").hide();
            } else if ($('.value3').prop("selected") == true) {
                $(".c057").show();
                $(".price1").hide();
                $(".c056").hide();
            }

            $.each($(".selectBox"), function() {
                $(this).val(value);
            });
        });


    });

    $(".c089").change(function() {
        $("#select_d").val($(this).val());

    });

    $("#select_d").change(function() {
        $(".c089").val($(this).val());

    });

    $(".select_color").change(function() {
        $("#kuciste").val($(this).val());

    });

    $("#kuciste").change(function() {
        $(".select_color").val($(this).val());

    });


    // Link ka Kontakt Formi
    $('.btn2').click(function() {

        if( $('.product-variation-1 .color-selector:eq(0)').find('.active').length < 1){
            $('.product-variation-1 .color-selector:eq(0)').find('.color-item').addClass('invalid_prop');
        }

        if( $('.product-variation-1 .color-selector:eq(1)').find('.active').length < 1){
            $('.product-variation-1 .color-selector:eq(1)').find('.color-item').addClass('invalid_prop');
        }

        if( $('.product-variation-2 .color-selector:eq(0)').find('.active').length < 1){
            $('.product-variation-2 .color-selector:eq(0)').find('.color-item').addClass('invalid_prop');
        }
        if( $('.product-variation-2 .color-selector:eq(1)').find('.active').length < 1){
            $('.product-variation-2 .color-selector:eq(1)').find('.color-item').addClass('invalid_prop');
        }

        if( $('.product-variation-3 .color-selector:eq(0)').find('.active').length < 1){
            $('.product-variation-3 .color-selector:eq(0)').find('.color-item').addClass('invalid_prop');
        }
        if( $('.product-variation-3 .color-selector:eq(1)').find('.active').length < 1){
            $('.product-variation-3 .color-selector:eq(1)').find('.color-item').addClass('invalid_prop');
        }
        if( typeof(_checkout) === 'undefined' || !_checkout || _checkout == false) {


            //$('.c015, .c092').hide();
            $('#ime3_v2').select();
            $('html, body').animate({
                scrollTop: $("#ime3_v2").offset().top
            }, 1000);


        } else {

            var _propertyBox    = $('.c049').is(':visible');

            // -- Custom fix indended only for pages that dont have property selector visible
            if ( !_propertyBox && $('.sel-prop').length > 0 ) {
                // -- Take all properties
                var properties_ = $('.sel-prop option');

                // -- Make sure first in-stock property is picked
                for ( var i = 0; i < properties_.length; i++ ) {

                    if ( $(properties_[i]).attr('data-variation') != '' && $(properties_[i]).attr('style') != 'display: none;' && $(properties_[i]).attr('disabled') != 'disabled' ) {

                        $(properties_[i]).prop('selected', true).change();

                        break;
                    }

                }
            }

            WS_.checkoutSystem('click');

            if(typeof gtag == 'function' && gtag != 'undefined'){
                gtag('event', 'buttonClick', {'event_category': 'Button click', 'event_label': 'redirect'});
            }

        }

        var quantity = $('.choice-selected').data('quantity')

        if( quantity == 1 && $('.product-variation-1 .color-selector:eq(0)').length && $('.product-variation-1 .color-selector:eq(0)').find('.active').length < 1){ return }
        if( quantity == 1 && $('.product-variation-1 .color-selector:eq(1)').length && $('.product-variation-1 .color-selector:eq(1)').find('.active').length < 1){ return }

        if( quantity == 2 && $('.product-variation-1 .color-selector:eq(0)').length && ( $('.product-variation-1 .color-selector:eq(0)').find('.active').length < 1 || $('.product-variation-2 .color-selector:eq(0)').length && $('.product-variation-2 .color-selector:eq(0)').find('.active').length < 1 )){ return }
        if( quantity == 2 && $('.product-variation-1 .color-selector:eq(1)').length && ( $('.product-variation-1 .color-selector:eq(1)').find('.active').length < 1 || $('.product-variation-2 .color-selector:eq(1)').length && $('.product-variation-2 .color-selector:eq(1)').find('.active').length < 1 )){ return }

        if( quantity == 3 && $('.product-variation-1 .color-selector:eq(0)').length && ( $('.product-variation-1 .color-selector:eq(0)').find('.active').length < 1 || $('.product-variation-2 .color-selector:eq(0)').length && $('.product-variation-2 .color-selector:eq(0)').find('.active').length < 1 || $('.product-variation-3 .color-selector:eq(0)').length && $('.product-variation-3 .color-selector:eq(0)').find('.active').length < 1)){ return }
        if( quantity == 3 && $('.product-variation-1 .color-selector:eq(1)').length && ( $('.product-variation-1 .color-selector:eq(1)').find('.active').length < 1 || $('.product-variation-2 .color-selector:eq(1)').length && $('.product-variation-2 .color-selector:eq(1)').find('.active').length < 1 || $('.product-variation-3 .color-selector:eq(1)').length && $('.product-variation-3 .color-selector:eq(1)').find('.active').length < 1)){ return }



    });


    $('.sel-prop-form').change(function(){

        let pid = $( this ).attr( 'data-property' );
        let vid = $( this ).find( 'option:selected' ).attr( 'data-variation' );
        $( '.sel-prop[data-property="' + pid + '"]' ).find( 'option[data-variation="' + vid + '"]' ).prop( 'selected', true );
        $( '.sel-prop' ).trigger( 'change' );

    });

    if ( $( '.c038 > .img1.co-mb' ).length ) {

        $( '.c038 > .img1.co-mb:first' ).trigger( 'click' );

    }

    if ( $( '.c038 > .img1.bl-sl' ).length ) {

        $( ".c038 > .img1.bl-sl:first" ).trigger( 'click' );

    }

    $( '.sel-prop' ).trigger( 'change' );

    if (typeof pId != 'undefined' && dds_state != true){
        dataStoring();
        $('input[name=email]').keydown(function(e) {
            var code = e.keyCode || e.which;
            if (code === 9) {
                e.preventDefault();
            }
        });
    };

    if( typeof(bundleSku) !== "undefined" && bundleSku != "null"){
        WS_.pageBundle(false);
    }

    $('#text_change #1').hide();
    $('#text_change #2').hide();
    var counter = 0;
    changeText();

    var mainProp = $( '#mainProperty' ).val();
    var main_sel_prop = $('select.sel-prop[data-property="'+mainProp+'"]');

    var index = 0;
    var propCount = Object.keys(prop_static).length;

    $( 'select.sel-prop, select.sel-prop-form' ).each( function() {

        $(this).attr('style', 'border: 1px solid red!important; background-color: #ffeded!important;color: red!important;');

        if( out_of_stock_ == main_sel_prop.find('option').length ) {

            $( this ).append( '<option value="" selected disabled hidden>' + soldOut + '</option>' );

        } else {

            $( this ).append( '<option value="" selected disabled hidden>' + prop_static[index] + '</option>' );

        }

        index = (index + 1) % propCount;
    });

    var lastScrollTop   = 0,
        navbar              = $('.t3-navbar'),
        navline             = $('.nav-line'),
        cstm_c_h_wrap       = $('.cstm_c_h_wrap'),
        cstm_c_h_inner      = $('.cstm_c_h_inner'),
        cstm_c_h_inner_     = $('.cstm_c_h_inner_'),
        sticky_bottom_line  = $('.sticky-bottom-line'),
        sticky_chat         = $('.chat-box'),
        sticky_chat_bubble  = $('.custom-chat-bubble'),
        order_form_box      = $('.modular-form-wrapper'),
        covid_disclaimer    = $('.c19-disclaimer'),
        c19_close_19        = $('span#c19-close-19'),
        screen_width        = $(window).width();
    pwaPopup            = $('#popup_pwa');

    // -- Make sure screen_width is adjusted on viewport resize
    $(window).resize(function(){
        screen_width = $(window).width()
    });

    if(navline != null && navline != undefined && sticky_bottom_line != null && sticky_bottom_line != undefined && covid_disclaimer != null && covid_disclaimer != undefined && c19_close_19 != null && c19_close_19 != undefined && (typeof(brandID) != undefined && brandID != '12') ){

        // -- Scroll event
        $(window).scroll(function(event){

            var sticky_liveChat = $('#chat-widget-container');

            // Catch event
            var direction = $(this).scrollTop();

            if (direction > lastScrollTop){

                if( screen_width < 575 ){
                    cstm_c_h_inner.css({"transition":"0.9s", "top": "-" + cstm_c_h_wrap.innerHeight() - 20  + "px"});
                    cstm_c_h_inner_.css({"transition":"0.9s", "top": "-" + cstm_c_h_wrap.innerHeight() - 20  + "px"});
                }
                navline.css({"transition":"0.3s", "top":"0px"});
                sticky_bottom_line.css({"transition":"0.3s", "bottom":"0px"});
                covid_disclaimer.css({"transition":"0.3s", "bottom":"0px"});
                c19_close_19.css({"top":"-18px"});


                if( screen_width < 575 ){
                    sticky_chat.css({"transition":"0.3s", "bottom":sticky_bottom_line.innerHeight() + 10});
                    sticky_chat_bubble.css({"transition":"0.3s", "bottom":sticky_bottom_line.innerHeight() + 5 + sticky_chat.innerHeight() + 10});

                    sticky_liveChat.removeClass('moveBottDown');
                    sticky_liveChat.addClass('moveBottUp');

                }

            } else {

                cstm_c_h_inner.css({"transition":"0.9s", "top" : "0px"});
                cstm_c_h_inner_.css({"transition":"0.9s", "top" : "20px"});
                navline.css({"transition":"0.3s", "top": cstm_c_h_wrap.innerHeight() + "px"});
                sticky_bottom_line.css({"transition":"0.3s", "bottom": "-" + sticky_bottom_line.innerHeight() + "px"});

                if( screen_width < 575 ){
                    sticky_chat.css({"transition":"0.3s", "bottom":"10px"});
                    sticky_chat_bubble.css({"transition":"0.3s", "bottom": sticky_chat.innerHeight() + 15});

                    sticky_liveChat.removeClass('moveBottUp');
                    sticky_liveChat.addClass('moveBottDown');

                    covid_disclaimer.css({"transition":"0.3s", "bottom": "-" + covid_disclaimer.innerHeight() + "px"});
                    c19_close_19.css({"top" : "0px"});

                }

            }

            lastScrollTop = direction;

            // -- Hide livechat (all chats) when form is in viewport
            if( order_form_box.length > 0 && checkVisible( order_form_box ) ){

                sticky_chat.hide();
                sticky_chat_bubble.hide();
                sticky_liveChat.hide();
                covid_disclaimer.hide();
                sticky_bottom_line.hide();
                pwaPopup.hide();
                $('#fb-root').hide();

            } else {

                sticky_chat.show();
                sticky_chat_bubble.show();
                sticky_liveChat.show();
                covid_disclaimer.show();
                $('#fb-root').show();
                if( screen_width < 575 ){
                    sticky_bottom_line.show();
                }

            }



        });

        /* Check element visibility
        ------------------------------------------------------- */
        function checkVisible( elm, eval ) {
            if(elm.length != 0){
                eval = eval || "object visible";
                var viewportHeight = window.screen.height,
                    scrolltop = $(window).scrollTop(),
                    y = $(elm).offset().top,
                    elementHeight = $(elm).height();

                if (eval == "object visible") return ((y < (viewportHeight + scrolltop)) && (y > (scrolltop - elementHeight + viewportHeight)));
                if (eval == "above") return ((y < (viewportHeight + scrolltop)));
            }
        }
    }

    // -- Detect user click on payment methods
    payment_button.on('click', function() {
        WS_.payment( $(this) );
    });
    var mainPid = $( '#mainProperty' ).val();
    if( mainPid && mainPid == '0' ){
        WS_.checkoutSystem('load');

    }
    // -- Multistep initilization
    if( formStep == 'on' ) {

        // -- Find out how many steps are out there
        var totalSteps = 1;
        var minStep         = 1;
        var total_modules   = $('div[class*="-module"]');

        for(i = 0; i < total_modules.length; i++) {
            tempStep = parseInt( $(total_modules[i]).attr('data-step') );

            if( tempStep > totalSteps ) {
                totalSteps = tempStep;
            }
        }

        // -- Define step for property picker and quantity picker
        // -- Always show them on last step
        $('.property-module').attr('data-step', totalSteps);

        // -- Define default step (starting point)
        WS_.multistep['step'] = 1;

        $('.step-button').on('click', function() {
            var direction = $(this).attr('data-direction');

            WS_.multistep(direction);

            if( totalSteps == WS_.multistep['step'] ) {
                $('.payment-block-wrapper').attr('style','');
            } else {
                $('.payment-block-wrapper').attr('style','display:none');
            }
        });
    }

    // -- Convert base value if user change quantity - order form
    // -- Convert base value if user change quantity - top / middle page
    // -- Convert base value if user change product property (color/size etc..)
    $('#product, .input-item.prop select, .c051 select.selectBox').on('change', function() {
        WS_.convertionInit();
    });

    // ** PICKER SNIPPET
    //================================================
    var colors          = {},
        quantity            = {},
        color_param         = $('.sel-prop option'),
        color_selector      = $('.color-selector'),
        quantity_selector   = $('.quantity-selector'),
        formQuantiyBox      = $('#product'),
        formPropBox         = $('.modular-form-wrapper select[name*="prop_"]'),
        formPriceBox        = $('.order-form-price-box');

    // ** Color
    //================================================
    var variationImageError  = '';

    color_param.each(function(i){
        // Get property ID
        var property_ID = $(this).parent().attr('data-property');

        if( $(this).attr('data-variation') )
            colors[i+1] = $(this).attr('data-variation');
        i += 1;

        if( colors[i] != undefined ) {

            let img = $('.comb[data-'+property_ID+'="'+colors[i]+'"]').data('img');

            if(typeof(img) != 'undefined'){
                //var url =  window.location.href +'/';
                var url = window.location.protocol + "//" + window.location.host + "/";
                var url_image = url + img;

                var image = new Image();
                image.src = url_image;
                if(img == ''){ variationImageError = 1 }
            }
        }
    });

    color_param.each(function(i){

        // Get property ID
        var property_ID = $(this).parent().attr('data-property');

        if( $(this).attr('data-variation') )
            colors[i+1] = $(this).attr('data-variation');

        i += 1;

        // -- Only properties dont have undefined variation
        if( colors[i] != undefined ) {

            let sku = $('.comb[data-'+property_ID+'="'+colors[i]+'"]').data('sku');
            let img = $('.comb[data-'+property_ID+'="'+colors[i]+'"]').data('img');

            if(typeof(img) !== 'undefined' && img != '' && typeof($(this).val()) != 'number' && variationImageError != 1){
                let variation = property_ID == 36 || property_ID == 44 || property_ID == 53 ? '<img style="height75px !important; width:75px !important" class="property-image" src="'+ img +'">' : '<span>' + $(this).val() +'</span>';
                // -- Template
                let style =  property_ID == 36 ||  property_ID == 44 ? '' : '';
                var color_template = '<div style="' + style +' " class="color-item color_'+ i +'" data-color="c'+ colors[i] +'" data-property-name="'+ $(this).val() +'" data-property="'+ property_ID +'" data-variation="'
                    + colors[i] +'" data-property="'+property_ID+'" data-sku="'+sku+'">'+ variation +'</div>';
            }else{
                var color_template = '<div class="color-item color_'+ i +'" data-color="c'+ colors[i] +'" data-property="'+ property_ID +'" data-variation="'
                    + colors[i] +'" data-property="'+property_ID+'" data-sku="'+sku+'"><span>'+ $(this).val() +'</span></div>';
            }
            // -- Find appropriate "color-selector" inside approriate "c051" selector box and append appropriate properties
            color_selector.parent().find('select[data-property="'+property_ID+'"]').parent().next().append(color_template);
        }
    });

    $('.product_text').hide()

    $(document).on('click', '.color-selector .color-item', function(e){

        if ( $( this ).hasClass( "color-item-disabled" ) ) {

            return
        }

        $(this).parent().parent().siblings('.c087').find('.select_property').hide();

        var option = $(this).parent().parent().parent().parent().data('option');


        var getParam     = $(this).attr('data-color');
        var getProperty  = $(this).attr('data-property');
        var getVariation = $(this).attr('data-variation');
        var property = $(this).data('property');
        var propertyName = $(this).data('property-name');

        $(this).parent().parent().siblings('.c087').find('.selected_property').text(propertyName)

        //  if( (warehouseCheck != 'off' || warehouseCheck != 'eu1') && property != '36'){

        if(warehouseCheck != 'off'){


            WS_.checkoutVariationStock( getProperty, getVariation, option );

        }

        $('.c038 div[data-param="'+getParam+'"] img').click();

    });

    // ** Correspondence with real pickers
    //================================================
    var color_temp_elem   = {}
    var selectorVariation = 1
    quantity_temp_elem    = '';

    //  if(typeof(hasCheckout) != 'undefined' && hasCheckout == 1){

    var divToClone = $('.mainSelector');

    divToClone.clone().addClass('product-variation-' + 2 + ' additional-product hidden').removeClass('product-variation-1').attr('data-option', '2').appendTo('.selectorBox').find('.productNumber').text('2')
    divToClone.clone().addClass('product-variation-' + 3 + ' additional-product hidden').removeClass('product-variation-1').attr('data-option', '3').appendTo('.selectorBox').find('.productNumber').text('3')
    //  }

    $(document).on('click', '.product-variation-1 .color-selector:eq(0) .color-item', function(e){
        $(this).siblings().removeClass('active');
        $(this).removeClass('invalid_prop');
        $(this).siblings().removeClass('invalid_prop');
        $(this).find('active');
    })
    $(document).on('click', '.product-variation-1 .color-selector:eq(1) .color-item', function(e){
        $(this).siblings().removeClass('active');
        $(this).removeClass('invalid_prop');
        $(this).siblings().removeClass('invalid_prop');
        $(this).find('active');
    })
    $(document).on('click', '.product-variation-2 .color-selector:eq(0) .color-item', function(e){
        $(this).siblings().removeClass('active');
        $(this).siblings().removeClass('invalid_prop');
        $(this).find('active');
        $(this).removeClass('invalid_prop');
    })
    $(document).on('click', '.product-variation-2 .color-selector:eq(1) .color-item', function(e){
        $(this).siblings().removeClass('active');
        $(this).siblings().removeClass('invalid_prop');
        $(this).find('active');
        $(this).removeClass('invalid_prop');
    })
    $(document).on('click', '.product-variation-3 .color-item', function(e){
        $(this).siblings().removeClass('active');
        $(this).siblings().removeClass('invalid_prop');
        $(this).find('active');
        $(this).removeClass('invalid_prop');
    })
    $(document).on('click', '.quantity-item, .color-item', function(e) {


        var elem        = $(this);
        var data_attr   = elem.attr('data-quantity') ? elem.attr('data-quantity') : elem.attr('data-color');
        var _comb       = findCombination();
        var quantity    = elem.hasClass('quantity-item') ? elem.attr('data-quantity') : $('.quantity-item.choice-selected').attr('data-quantity');


        //    if(typeof(hasCheckout) != 'undefined' && hasCheckout == 1){

        if( quantity == 1 ){
            $('.product-variation-2').css('display', 'none')
            $('.product-variation-3').css('display', 'none')
            $('.product_text').hide()
        }

        if( quantity == 2 ){
            $('.product-variation-2').css('display', 'block')
            $('.product-variation-3').css('display', 'none');
            $('.product_text').show()

        }
        if( quantity == 3 ){
            $('.product-variation-2').css('display', 'block')
            $('.product-variation-3').css('display', 'block')
            $('.product_text').show()
        }

        if ($(this).parent().hasClass("additional-product")) {

            $(this).addClass('active')
        }
        //     }

        if( !_comb )
            _comb = $($('.comb')[1]);


        if( elem.attr('data-quantity') != undefined ) {
            let activePrice = _comb.attr( 'data-price-' + elem.attr('data-quantity') ).split(' | ')[ 0 ];

            // -- On every change change update order form discount box
            formPriceBox.find('.price-x1').text( parseFloat(activePrice) + _currency );
            formPriceBox.find('.price-x2').text(  Math.round( parseFloat( activePrice.replace( /\D[.]/g, '' ) ) /  ( ( 100 - ud_price_percentage ) / 100 ) ).toFixed( 2 )  + _currency )
            formPriceBox.find('.discount').text('-' + ud_price_percentage + '%');

        }

        // -- Quantity functionality
        if( elem.attr('data-quantity') ) {

            $('.choice').removeClass('choice-selected');
            $(this).addClass('choice-selected');
            var value = $(this).attr('data-val');

            data_attr -= 1; // Because select option start count from #0
            $('.selectBox option:eq(' + data_attr + ')').prop('selected', true);
            $('.selectBox').change(); // Trigger event

            quantity_temp_elem = elem; // Store active element for later use

        }

        // -- Color functionality
        if( elem.attr('data-color') ) {

            var property_ID = elem.attr('data-property');


            // -- Everytime when new color is picked quantity must be reset to default value
            //resetQuantity();


            // -- Check temp storage for already active element and deactivate it
            for( i = 0; i < Object.keys(color_temp_elem).length; i++ ) {

                if( color_temp_elem[ property_ID ] != undefined ) {
                    // $( color_temp_elem[ property_ID ]['element'] ).removeClass('active');
                }

            }

            // -- Activate new element (currently clicked)
            elem.addClass('active');

            data_attr = data_attr.replace('c' , ''); // Remove "c" from string -> "c" needed for HTML attr
            $('.c089 option[data-variation="' + data_attr + '"]').prop('selected', true);
            $('.c089').change(); // Trigger event

            color_temp_elem[property_ID] = {'element': elem}; // Store active element for later use
        }



    });

    // -- Sync order form quantity picker with other ones
    formQuantiyBox.on('change', function() {
        var currentQuantity = $(this)[0].selectedIndex + 1;

        $('.quantity-item[data-quantity="' + currentQuantity + '"]').click();
    });

    // -- Sync order form property picker with other ones
    formPropBox.on('change', function() {
        var currentPropValue = $(this).find('option:selected').attr('data-variation');

        $('.color-item[data-color="c' + currentPropValue + '"]').click();
    });

    // ** Reset quantity
    function resetQuantity() {
        // -- Remove all selected items
        $('.quantity-item').removeClass('choice-selected');

        // -- Activate default item
        $('.quantity-item[data-quantity="1"]').addClass('choice-selected');
    }
}

// WS_ initialization
$(document).ready(function() {
    WS_.initialize();
    onLoadHandling();
    $('.payment-btn:first').trigger('click');
});
