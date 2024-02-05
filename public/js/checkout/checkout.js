$(document).ready(function () {
    if ($('#repp3').is(':visible') || $('#repp33').is(':visible') || $('#repp34').is(':visible')) {
        $('.contact-form-box').css({
            'overflow': 'hidden',
        })
    }

    $('.coupon-btn').on('click', function () {
        cart.checkCoupon();
    })

})

let liveCount = 1 // Counter baseline

let static = {
    ime: 'Ime',
    address: address,
    number: houseNumber,
    postal: postal,
    city: city,
    phone: phone,
    email: 'E-mail',
    komentar: comment,
}

// -- Used parameters
function params(param) {
    const input = $('input[id="' + param + '"]')
    const id = $('input[id="' + param + '"]').attr('id')
    const val = $('input[id="' + param + '"]').val()
    const label = $('label[for="' + param + '"]')
    const mandatory = $('input[id=' + param + '] + .mandatory_field')
    const svg = $('img[data-id="' + param + '"]')
    const email = $('input[id=email]')
    const komentar = $('textarea[id=komentar]')
    const komentarVal = $('textarea[id=komentar]').val()

    let output = []
    output['input'] = input
    output['label'] = label
    output['id'] = id
    output['val'] = val
    output['mandatory'] = mandatory
    output['svg'] = svg
    output['email'] = email
    output['komentar'] = komentar
    output['komentarVal'] = komentarVal

    return output
}

// -- This function detect typing / input
function detectInput(param, elem) {
    let temp = params(param)
    let action = ''
    const mandatory = $(elem).attr('data-mandatory') == 'true' ? true : false

    temp['input'].addClass('color555')

    // -- Check what function is needed and define it
    if (temp['val'] != '') {
        // -- Name is different because of one input
        // -- First name and Last name custom validation is in place
        if (param == 'ime') {
            action = checkUsername() ? 'addClass' : 'removeClass'
        }
        else {
            action = 'addClass'
        }

    }
    else {
        action = 'removeClass'

    }

    if (param == 'komentar' && temp['komentarVal'] == '') {
        action = 'removeClass'
    }

    window[action](temp['input'], 'ease-out active', 'input[id="email"]')

    window[action](temp['label'], 'opacity-1', '')

    window[action](temp['svg'], 'appear', '')

    window[action](temp['email'], 'lowercase', '')

    if (!temp['input'].hasClass('active') && mandatory) {
        window['addClass'](temp['input'], 'ease-out invalid_field', 'input[id="email"]')
        window['addClass'](temp['mandatory'], 'appear', '')
    }
    else {
        window['removeClass'](temp['input'], 'ease-out invalid_field', '')
        window['removeClass'](temp['mandatory'], 'appear', '')
    }
}

// -- This function detect when user clicked / focused element
function detectClickIN(param) {
    const temp = params(param)

    // -- This condition is only for additional user generated fields
    if (param.lastIndexOf('_v') != -1) {
        param = param.substring(0, param.lastIndexOf('_v'))
    }
}

// -- This function detect when user clicked out of element
function detectClickOUT(param, elem) {

    let temp = params(param)
    let action = ''
    let mandatory = $(elem).attr('data-mandatory') == 'true' ? true : false

    // -- Check what function is needed and define it
    if (temp['val'] == '' && mandatory) {

        if (param == 'ime') {
            action = !checkUsername() ? 'addClass' : 'removeClass'
        }
        else {
            action = 'addClass'
        }

    }
    else {

        action = 'removeClass'

    }

    // -- When user is leaving field check if field is empty
    if (temp['val'] == '') {
        window[action](temp['input'], 'ease-out invalid_field', 'input[id="email"]')
        window[action](temp['mandatory'], 'appear', 'input[id="email"]')
    }

}

// -- SUBMIT Button main validation (triggered onclick => in main file)
function validate() {
    const inputs = $('#order-form input[type="text"]')
    const select = $('#order-form select[data-mandatory="true"]')
    let action = ''

    for (const i = 0; i < inputs.length; i++) {
        const input_id = inputs[i].id
        const temp = params(inputs[i].id)

        // -- This condition is only for additional user generated fields
        if (input_id.lastIndexOf('_v') != -1) {
            input_id = input_id.substring(0, input_id.lastIndexOf('_v'))
        }

        // -- Check what function is needed and define it
        (inputs[i].value == '' ||
            inputs[i].value == static[input_id]) ? action = 'addClass' : action = 'removeClass'

        window[action](temp['input'], 'ease-out invalid_field', 'input[id="email"]')
        window[action](temp['mandatory'], 'appear', '')
    }

}

// -- Call function depend on specific event
$('#order-form input, textarea').on('input', function () { detectInput($(this).attr('id'), $(this)) })

$('#order-form input, textarea').on('blur', function () { detectClickOUT($(this).attr('id'), $(this)) })

$('#order-form input, textarea').on('focus', function () { detectClickIN($(this).attr('id'), $(this)) })

function addClass(elm, className, not) {
    return elm.not(not).addClass(className)
}

function removeClass(elm, className, not) {
    return elm.not(not).removeClass(className)
}

function toggleClass(elm, className, not) {
    return elm.not(not).toggleClass(className)
}

// -- Comment stationary palceholder fix (when user is scrolling)
const textarea = $('#komentar')

$('#komentar').on('scroll', function () {
    $(this).scrollTop() == 0 ?? $('.label_komentar').hide()
})

$('.item').click(function () {
    $('.tooltip').removeClass('hide')
    $('.tooltip').addClass('show')
})

$('.tooltip').click(function () {
    $('.tooltip').removeClass('show')
    $('.tooltip').addClass('hide')
})

/* SELECT 2
     =========================================================*/
$(document).ready(function () {

    if ($('.js-select2-single').length > 0) {

        /// POPULATE
        // const getCountry = 'HR';

        $('#select_state').select2()
        $('#select_city').select2({
            language: {
                noResults: function () {
                    return 'Select the county first' // Selecteaza mai intai judetul
                },
            },
        })

        $('#select_zip').select2({
            language: {
                noResults: function () {
                    return 'Select city first' // ne'am prevod za ovo
                },
            },
        })

        // -- Listen for user and request street
        $('#select_city').change(function () {
            populatePostal()
        })

        // ** FETCH POSTAL
        $('#select_state').change(function (e) {

            const postal_input = $('#select_zip')
            postal_input.empty()

            const city_input = $('#select_city')
            city_input.empty()

            const val = $(this).val()
            let state = $('#select_state option:selected').val()

            if (state != '') {
                populateCity(state)
            }

            val == '' && $.ajax({
                url: '//devdomena.com/zeljko/modularForm/base/ro-parse.php',
                type: 'POST',
                data: {
                    request: 'request_state',
                    cCode: getCountry,
                },
                success: function (res) {
                    res = JSON.parse(res)
                    const state_input = $('#select_state')
                    state_input.empty()

                    res = res['State']

                    for (const i = 0; i < res.length; i++) {
                        $(state_input).append('<option value="' + res[i] + '">' + res[i] + '</option>')
                        $(state_input).val('')
                    }
                },
            })
        }).trigger('change')

        // ** FETCH CITY DATA
        function populateCity(state) {
            if (!state) {
                state = false
            }
            const postal_input = $('#select_zip')
            postal_input.empty()

            const val = $('#select_city').val()

            if (state) {
                $.ajax({
                    type: 'POST',
                    url: '//devdomena.com/zeljko/modularForm/base/ro-parse.php',
                    data: {
                        request: 'request_city',
                        cCode: getCountry,
                        state: state,
                    },
                    success: function (res) {
                        res = JSON.parse(res)
                        const city_input = $('#select_city')
                        city_input.empty()

                        for (const i = 0; i < res.length; i++) {
                            $(city_input).append('<option value="' + res[i] + '">' + res[i] + '</option>')
                            $(city_input).val('')
                        }
                    },
                })
            }
        }

        // ** FETCH STREET/POSTAL DATA
        function populatePostal(state) {
            if (!state) {
                state = false
            }
            const postal_input = $('#select_zip')
            postal_input.empty()

            const val = $('#select_city').val()
            city = $('#select_city option:selected').val()

            if (city) {
                $.ajax({
                    type: 'POST',
                    url: '//devdomena.com/zeljko/modularForm/base/ro-parse.php',
                    data: {
                        request: 'request_postal',
                        cCode: getCountry,
                        state: state,
                        city: city,
                    },
                    success: function (res) {
                        res = JSON.parse(res)

                        for (let i = 0; i < res.length; i++) {
                            $(postal_input).
                                append('<option value="' + res[i]['id'] + '">' + res[i]['id'] + '</option>')
                            $(postal_input).val('')
                        }
                    },
                })
            }
        }

        // Validate on change
        $('.js-select2-single').on('change', function (e) {
            const _select = $('.js-select2-single[name="' + e.target.name + '"]')
            const _single = $(
                '.js-select2-single[name="' + e.target.name + '"] + .select2 .select2-selection--single')

            const _allSelects = $('.js-select2-single').not(_select)

            // -- Validate on change (individual field)
            if (e.target.value != '') {
                _single.removeClass('ease-out invalid_select')
            }
            else {
                _single.addClass('ease-out invalid_select')
            }

            // -- Other fields around one that is interacted with
            for (const i = 0; i < _allSelects.length; i++) {

                if (_allSelects[i].value == '') {
                    $(_allSelects[i]).
                        next().
                        find('.select2-selection--single').
                        addClass('ease-out invalid_select')
                }
                else {
                    $(_allSelects[i]).
                        next().
                        find('.select2-selection--single').
                        removeClass('ease-out invalid_select')
                }
            }
        })

    }

})

const userReferenceMessanger = '625558d5a9f76'

// -- New order form username validation
function checkUsername() {

    // -- Control variables
    let whitespace = false
    let condition = false
    const elem = $('#ime')

    // -- Check "Name" field is there whitespace and if is there at least 2 words imported in to the input
    if (typeof $(elem).val().match(/\s/g, '') !== 'undefined' && $(elem).val().match(/\s/g, '') !== null) {

        const fiedValue = $(elem).val()
        const matchWhiteSpace = fiedValue.match(/\s/g, '')

        if (Object.keys(matchWhiteSpace).length > 0) {
            const splitValue = fiedValue.split(' ').filter(function (el) { return el !== '' })

            if (splitValue.length > 1 && splitValue[1].length > 1) {

                whitespace = true

            }

        }
    }

    // -- Check is field valid
    if (!$(elem).hasClass('crvenaS') && $(elem).val().length > 1) {

        if ($(elem).attr('id') == 'ime') {

            if (whitespace) {
                condition = true
            }

        }
        else if ($(elem).attr('id') != 'ime') {

            condition = true

        }

    }

    // -- Condition / on the fly validation ( real-time validation )
    return condition

}

const cartData = JSON.parse(localStorage.getItem(`cart-${brandID}-${countryForm}`) ?? '{}')
window['dataSent'] = false

/**
 * Stores abandoned order
 *
 * @param data
 */
function storeAbandonedOrder(data) {
  
    let aoStorageKey = 'hasAbandonedOrder_' + location.href.replace(location.search, '').replace('https://', '');
    // if AO is not active or a global variable isn't defined
    if (
        typeof ofbSettings === 'undefined'
        || !ofbSettings
        || typeof ofbSettings['splitType'] === 'undefined'
        || data.data.telephone.length > 13
        || data.data.telephone.length < 8
    ) { 
        storeOFBData(data)
        return false
    }

    const totalOrderPrice = parseFloat($('.total-price').text());
    

    if (isNaN(totalOrderPrice)) {
        storeOFBData(data)
        return false
    }

    // split-type-specific checks
    if (ofbSettings['splitType'] === 'percentage') {
        // don't send given percent of orders, or if invalid settings
        if (
            typeof ofbSettings['infobipPercentage'] === 'undefined'
            || isNaN(ofbSettings['infobipPercentage'])
            || Math.random() > (ofbSettings['infobipPercentage'] / 100)
        ) {
            storeOFBData(data)
            return false
        }

    }
    else if (ofbSettings['splitType'] === 'order value') {
        // invalid settings
        if (
            typeof ofbSettings['orderValue'] === 'undefined'
            || isNaN(ofbSettings['orderValue'])
        ) {
            storeOFBData(data)
            return false
        }

        const maxAOPrice = ofbSettings['orderValue']

        // // don't send if larger than maxAOPrice
        // if (totalOrderPrice > maxAOPrice) {
        //     storeOFBData(data)
        //     return false
        // }

    }
    else if (ofbSettings['splitType'] === 'working hours') {
        const today = new Date()
        const now = String(today.getHours()).padStart(2, '0')
            + ':' + String(today.getMinutes()).padStart(2, '0')

        // undefined variables handling
        if (
            ofbSettings['workingHoursStart'] === null
            || ofbSettings['workingHoursEnd'] === null
            || ofbSettings['outsideWorkingHours'] === null
            || ofbSettings['duringWorkingHours'] === null
        ) {
            storeOFBData(data)
            return false
        }

        // don't send if it should happen during WH, but it is outside
        if (!ofbSettings['outsideWorkingHours'] && ofbSettings['duringWorkingHours'] &&
            (now < ofbSettings['workingHoursStart'] || now > ofbSettings['workingHoursEnd'])) {
            storeOFBData(data)
            return false
        }

        // don't send if it should happen outside WH, but it is during
        if (!ofbSettings['duringWorkingHours'] && ofbSettings['outsideWorkingHours'] &&
            (now >= ofbSettings['workingHoursStart'] && now <= ofbSettings['workingHoursEnd'])) {
            storeOFBData(data)
            return false
        }

    }

    // let userData = { name: data.name, phone: data.telephone, email: data.email }

    let page = location.href
    const storedPage = sessionStorage.getItem('AOPage')
    if (storedPage) {
        page = storedPage
        sessionStorage.removeItem('AOPage')
    }

    // arrived from Infobip campaign, do nothing
    if (page.toLowerCase().includes('infobip')) {
        return true
    }


    const coupon = typeof $('#coupon')[0] != 'undefined'
        ? ($('#coupon').val() !== enterCoupon
            ? $('#coupon').val()
            : null)
        : null

    let items = []

    Object.values(cartData.products).forEach(function (item) {
        items.push({
            name: item.name,
            amount: item.quantity,
            price: parseFloat(item.price),
            sku:item.sku
        })
    })

    const shop = app_url.replace('https://', '')
    const campaignId = ofbSettings['campaignId']


    data.data.items = items;
    data.data.campaignId = campaignId;
    data.phone = data.data.telephone;
    data.page = page;
    
    $.ajax({
        url: app_url + '/abandoned-order/store',
        type: 'POST',
        data: data,
        success(response) {
            try {
                localStorage.setItem(aoStorageKey, 'true')
                window['dataSent'] = true
                return true
            }
            catch (error) {
                storeOFBData(data)
                return false
            }
        },
    })
}

/**
 * Stores data to AO or OFB systems
 *
 * @returns {boolean}
 */
function storeData() {
   
    if (window['dataSent'] || $.isEmptyObject(cartData)) {
        return false
    }

    const $nameInput = $('#ime')
    if (
        $nameInput.val().length < 1
        || $nameInput.val() === fullName
    ) {
        return false
    }

    const $phoneInput = $('#phone')
    if (
        $phoneInput.val().length < 1
        || $phoneInput.val() === phone
    ) {
        return false
    }

    getUserIP(function (ip) {

        var aoData = {
            countryCode: country,
            brandId: brandID,
            page: 'shop',
            phone: phone,
            data: {
                name: $nameInput.val(),
                surname: $('#surname').val(),
                telephone: $phoneInput.val(),
                address: $.trim($('#address').val()),
                houseno: $.trim($('#number').val()),
                postcode: $('#postal').val(),
                city: $('#city').val(),
                email: $('#email').val(),
                region: $('#province').val(),
                state: countryForm,
                id: Math.floor(Math.random() * 900000000 + 100000000),
                productId: cartData.products[0].sku.split('-')[2],
                multiproduct: cartData.products.map(product => product.sku.split('-')[2]),
                price: cartData.products[0].price,
                multiproductPrice: cartData.products.map(product => product.price),
                ip: ip,
                page: location.href,
                note: $('#komentar').val(),
                totalPrice: parseFloat($('.total-price').text()),
                paysPostage: 1,  // quasi-boolean, set somewhere in centralization
            }
        };

        storeAbandonedOrder(aoData)
    });

}

/**
 * Stores data in OFB system
 * @param data
 */
function storeOFBData(data) {
    $.ajax({
        url: app_url + '/order-fill-break/store',
        type: 'POST',
        dataType: 'json',
        data,
        success: function (result) {
            if(result.status != 'failed') window['dataSent'] = true;
        },
    })
}

$(_ => {
    let typingTimer = null
    const doneTypingInterval = 3000
    const $input = $('input[name=phone], input[name=email]')

    $input.on('keyup', function () {
        clearTimeout(typingTimer)
        typingTimer = setTimeout(storeData, doneTypingInterval)
    })

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer)
    })

})

if (cart.products.length === 0 && location.href.includes('/checkout')) {
    window.location.href = app_url;
}
const form = new Form(createRoute, klarnaRoute);

if (typeof fbq === 'function' && getUrlParam("flow") != "direct") {
    fbq(
        'track',
        'InitiateCheckout',
        {
            content_ids: cart.products.map(product => product.sku),
            value: cart.totalEurPrice,
            num_items: cart.products.length,
        },
    )
}

$('a.payment-btn:not(.active)').on('click', function (e) {
    e.preventDefault();
    let payment = $(this).attr('data-payment');
    let initFunction = $(this).attr('data-init');
    $('input.payment-radio').prop('checked', false);
    $('a.payment-btn').removeClass('active');
    $(this).find('input.payment-radio').prop('checked', true);
    $(this).addClass('active');

    $('div.checkout-payment-block > div:not(.surprise-gift-box)').hide();
    $(`div.${payment}-payment-box`).show();

    if (typeof window[initFunction] === 'function') {
        window[initFunction]();
    }
})

$(".payment-btn:first").css("border-radius","8px 8px 0 0");
$(".payment-btn:nth-of-type(2)").css("border-radius","0 0 0 0");
$(".payment-btn").last().css("border-radius","0 0 8px 8px");

$('.rotate-toggler').each(function() {
    $(this).on('click', function() {
        $(this).closest('.bonuses').find('.bonusText').toggleClass('display-bonus-text');
        $(this).closest('.bonuses').find('#toggleCategories').toggleClass('rotate-toggler');
        $(this).closest('.bonuses').find('.bonusDes').toggleClass('border-none');
    });
});

function getUserIP(callback) {
    $.getJSON("https://api.ipify.org?format=json", function (data) {
        callback(data.ip);
    });
}

    function setDeliveryDay()
    {
    const productWithDeliveryDay = cart.products.find(product => product.deliveryDay);
    const standardDelivery = !productWithDeliveryDay ? `(3 - 5 ${days})` : createDeliveryRange(productWithDeliveryDay.deliveryDay, 2, true);
    const priorityDelivery = !productWithDeliveryDay ? `(1 - 3 ${days})` : createDeliveryRange(productWithDeliveryDay.deliveryDay, 1);

    $('.typeTitle.standard').append(`
        <span> ${standard} <span id="days">${standardDelivery}</span></span>
        <div class="timeAndPrice">
            <div class="typePriceStandard">0&nbsp;${currencySymbol}</div>
        </div>
    `);

    $('.typeTitle.priority').append(`
        <span> ${fast} <span id="days">${priorityDelivery}</span></span>
        <div class="timeAndPrice">
            <div class="typePriceFast">${priorityCost}&nbsp;${currencySymbol}</div>
        </div>
    `);
    }

    function createDeliveryRange(deliveryDay, num, isStandard = false)
    {
    
    let dateParts = String(deliveryDay).split('.');
    let currentDate = new Date(new Date().getFullYear(), parseInt(dateParts[1]) - 1, parseInt(dateParts[0]));

    if (isStandard) {
        currentDate.setDate(currentDate.getDate() + 1);
    }
   
    let nextDate = new Date(currentDate);
    nextDate.setDate(currentDate.getDate() + num);
    
    let formattedCurrentDate = currentDate.toLocaleDateString('sr-RS', { day: 'numeric', month: 'numeric' });
    let formattedNextDate = nextDate.toLocaleDateString('sr-RS', { day: 'numeric', month: 'numeric' });
    
    let result = formattedCurrentDate + ' - ' + formattedNextDate;
    
    return result;
    }

    setTimeout(function() {
        setDeliveryDay();
    }, 500);