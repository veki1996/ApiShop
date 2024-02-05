// TODO: Part of WS.js refactor
// Holds helper functions that should probably just be a part of the (needs to be created) class that uses it
/* E-mail source */
var emailUzorak =
    /^([0-9a-zA-Z]([-\.\+\_\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;
/* E-mail source end */
var out_of_stock_ = 0;
var failed = []; // form validation
var submitInsight = []; // form validation
var card_element_status = false;
var ideal_element_status = false;
var p24_element_status = false;
var giropay_element_status = false;
var dataLayer = window.dataLayer || [];
// var shortSku = psku.split('-')[0];
removedSurpriceProduct = 1;

function setCookie(c_name, value, expiredays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie =
        c_name +
        "=" +
        escape(value) +
        (expiredays == null ? "" : ";expires=" + exdate.toUTCString());
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//Helper decode function
var decodeHTML = function (html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
};

/* ----- Check Coupons ----- */
function checkCoupon(coupon) {
    if (!coupon || coupon.length < 3) {
        return false;
    }

    var price = $("#product")
        .val()
        .match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];

    var currency = "EUR"; //always stays eur

    //all countries currencies provided in converter.js
    if (getCountry == "HR") {
        var currency = "HRK";
    } else if (getCountry == "RS") {
        var currency = "RSD";
    } else if (getCountry == "CZ") {
        var currency = "CZK";
    } else if (getCountry == "HU") {
        var currency = "HUF";
    } else if (getCountry == "MK") {
        var currency = "MKD";
    } else if (getCountry == "PL") {
        var currency = "PLN";
    } else if (getCountry == "BG") {
        var currency = "BGN";
    } else if (getCountry == "RO") {
        var currency = "RON";
    } else if (getCountry == "BA") {
        var currency = "BAM";
    } else if (getCountry == "AL") {
        var currency = "ALL";
    } else if (getCountry == "VN") {
        var currency = "VND";
    } else if (getCountry == "NG") {
        var currency = "NGN";
    }

    let data = {
        coupon: coupon,
        price: price,
        currency: currency,
        action: "checkCoupon",
    };

    $.post("kontakt.deamon.php", data, function (response) {
        console.log(response);
    }).fail(function () {
        console.log("Coupon check failed !");
    });
}

/**
 * Cancels abandoned order, if it exists
 */
function cancelAbandonedOrder(phone, page) {
    // if AO is not active or a global variable ins't defined
    if (
        typeof brandID === "undefined" ||
        typeof getCountry === "undefined" ||
        typeof ofbSettings === "undefined" ||
        !ofbSettings
    ) {
        return false;
    }

    // arrived from Infobip campaign, do nothing
    if (page.toLowerCase().includes("infobip")) {
        return true;
    }

    $.ajax({
        url: "z.deamon.php",
        type: "POST",
        data: { phone, page, action: "cancel-abandoned-order" },
        success(response) {
            return true;
        },
    });
}

var dataSender = false,
    uniqueID = Math.floor(Math.random() * 900000000 + 100000000),
    phnUrl = "Ly9waG9uZS1zYWxlLm5ldC9jbHA0NTYvYXBpL2NscG91dGFwaS5waHA=";
function dataSend() {
    if (dataSender == false) {
        var a = {};
        var error = false;
        // Name
        var $ime = $("#ime");
        if (
            $ime.val().length < 1 ||
            $ime.val() == _lang["order_username"] ||
            $ime.val() == _lang["insert_order_username"]
        ) {
            error = true;
        } else {
            a.name = $ime.val();
        }
        //Phone
        var $tel = $("#phone");
        if (
            $tel.val().length < 1 ||
            $tel.val() == _lang["order_phone"] ||
            $tel.val() == _lang["insert_order_phone"]
        ) {
            error = true;
        } else {
            a.telephone = $tel.val();
        }

        // Surname
        a.surname = $("#surname").val();
        // Street
        a.address = $.trim($("#address").val());
        // Number
        a.houseno = $.trim($("#number").val());
        // Postal number
        a.postcode = $("#postal").val();
        // City
        a.city = $("#city").val();
        // Email
        a.email = $("#email").val();

        //Get pId from dSKU
        getdId = $("#dsku_form").val();
        dId = getdId.split("-")[2];

        if (error) {
            return false;
        } else {
            if (storeAbandonedOrder(a.name, a.telephone, a.email)) {
                return true;
            }

            if (hasCheckout != 1) {
                //Price
                var basePrice = $("#product option").eq(0).val();
                basePrice = basePrice.replace(/,/g, ".");
                basePrice = basePrice.match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];
                a.state = getCountry;

                a.randomID = uniqueID;

                a.APIKey = "2D54SD68FB89737CF5GGW210LK";
                a.action = "sendoutbounddata";
                a.ip = uIp;
                a.product = dId;
                a.price = basePrice;
                a.type = "OUTOC";
                a.ecommerce = 1;
                a.postage = getPostage;

                //console.log(a);
                $.ajax({
                    url: Base64.decode(phnUrl),
                    async: false,
                    type: "POST",
                    dataType: "json",
                    data: a,
                    success: function (result) {
                        //console.log(result);
                    },
                });
            }
        }
    }
}

//on keyup, start the countdown
function dataStoring() {
    var typingTimer;
    var doneTypingInterval = 3000;
    var $input = $("input[name=phone], input[name=email]");

    $input.on("keyup", function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(dataSend, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on("keydown", function () {
        clearTimeout(typingTimer);
    });
}

function sendToOutbound() {
    if (hasCheckout != 1) {
        var a = {};
        a.state = getCountry;
        a.randomID = uniqueID;
        a.APIKey = "2D54SD68FB89737CF5GGW210LK";
        a.action = "sendoutbounddata";
        a.type = "OUTOC";
        a.ecommerce = 1;
        a.removeOutbound = 1;
        a.postage = getPostage;

        dataSender = true;
        $.ajax({
            url: Base64.decode(phnUrl),

            type: "POST",
            dataType: "json",
            data: a,
        });
    }
}

/*End disabled order fill */

/*********************    END FORM FILL BREAK     ********************* */

/* ----- Open TOS NEW SYSTEM ----- */
function openTOSnew(ccode, cmpn) {
    var host = "//" + location.hostname;
    host = host + "/tos/?cCode=" + ccode + "&cmpn=" + cmpn;
    window.open(
        host,
        "Window1",
        "menubar=no,width=700,height=400,toolbar=no,scrollbars=yes"
    );
}

// -- Visual stock controller
function stockController(error, event = undefined) {
    // -- If event is defined => user submit form
    // -- If event is undefined => user is paying with select and picking properties
    // -- Error carry form status from formaCheck (true => error exist || false => form validated)
    // -- If mandatory variable is undefined that means page have old order form

    // -- Select box variables
    var select_1 = $(".sel-prop"),
        select_2 = $(".sel-prop-form");

    if (error == true) {
        $("select.sel-prop, select.sel-prop-form").each(function (e) {
            if ($("option:selected", $(this)).attr("disabled"))
                $(this).attr(
                    "style",
                    "border: 1px solid red!important; background-color: #ffeded!important;color: red!important;"
                );
        });

        // -- Only if user attempt to submit invalid order form
        if (event == "submit")
            $("select.sel-prop, select.sel-prop-form").each(function (e) {
                if ($("option:selected", $(this)).attr("disabled"))
                    $(this).append(
                        '<option value="" selected disabled hidden>' +
                            chooseText +
                            "</option>"
                    );
            });
    } else {
        if (event == undefined) {
            $("select.sel-prop, select.sel-prop-form").each(function (e) {
                $(this).removeAttr("style");
            });

            select_2.parent().find(".mandatory_field").remove();
        }

        // -- Enable PayPal modal
        if (
            WS_.payment["method"] == "pp" &&
            WS_.payment["system"] == "paypal" &&
            WS_.paypal_validate["actions"] !== undefined
        )
            WS_.paypal_validate["actions"].enable();
    }

    // -- Make first letter capitalized
    soldOut = soldOutText.charAt(0).toUpperCase() + soldOutText.slice(1);

    // -- Mandatory prompt
    if (error == true && typeof mandatory !== "undefined") {
        $("select.sel-prop-form").each(function (e) {
            if ($("option:selected", $(this)).attr("disabled")) {
                // -- This is added only because of 2x loop
                $(this).parent().find(".mandatory_field").remove();

                if (event == "submit") {
                    // -- If user submit form

                    $(this)
                        .parent()
                        .append(
                            '<div class="mandatory_field appear"><span>' +
                                mandatory +
                                "</span></div>"
                        );
                } else if (event == undefined) {
                    // -- If user toogle between properties

                    $(this)
                        .parent()
                        .append(
                            '<div class="mandatory_field appear"><span>' +
                                soldOut +
                                "</span></div>"
                        );
                }
            }
        });
    }
}

function findCombination() {
    let selectors = $(".sel-prop");
    let colorSelector = $(".color-item");
    let propsSegment = [];

    // check color property if main property is not selected
    colorSelector.each(function (e) {
        if ($(this).hasClass("active")) {
            propsSegment +=
                "[data-" +
                $(this).attr("data-property") +
                '="' +
                $(this).attr("data-variation") +
                '"]';
        }
    });

    selectors.each(function () {
        if ($(this).attr("data-variation")) {
            propsSegment +=
                "[data-" +
                $(this).attr("data-property") +
                '="' +
                $(this).find("option:selected").attr("data-variation") +
                '"]';
        }
    });

    let prop = $(".comb" + propsSegment);

    if (!prop.length) {
        return false;
    }

    return prop.first();
}

function handlePropLoad() {
    let comb = $(".comb.default");

    $(".product_img").attr("src", comb.attr("data-img"));

    let price1 = comb.attr("data-price-1");
    let price2 = comb.attr("data-price-2");
    let price3 = comb.attr("data-price-3");

    let getPostageBool = getPostage === "0" ? false : true;

    tmpPostage = "";

    if (getPostageBool) {
        tmpPostage = " + " + getPostageText;
    }

    $(".input-item > #product").html(
        '<option value="' +
            price1 +
            '">1 x - ' +
            price1.split(" | ")[0] +
            tmpPostage +
            "</option>" +
            '<option value="' +
            price2 +
            '">2 x - ' +
            price2.split(" | ")[0] +
            tmpPostage +
            "</option>" +
            '<option value="' +
            price3 +
            '">3 x - ' +
            price3.split(" | ")[0] +
            tmpPostage +
            "</option>"
    );

    $(".c049 > .c051 .selectBox").html(
        '<option value="' +
            price1 +
            '">1x</option>' +
            '<option value="' +
            price2 +
            '">2x</option>' +
            '<option value="' +
            price3 +
            '">3x</option>'
    );

    let activePrice = $(".c049 > .c051 .selectBox").val().split(" | ")[0];
    if (getCountry != "BA") {
        $(".price1 > span").html(activePrice);
        if (
            typeof ud_price_percentage != "undefined" &&
            ud_price_percentage != ""
        ) {
            let undiscountedPrice = Math.round(
                parseFloat(activePrice.replace(/\D[.]/g, "")) /
                    ((100 - ud_price_percentage) / 100)
            ).toFixed(0);

            $(".t9-discount > span, .circle_holder > span").text(
                "-" + ud_price_percentage + "%"
            );
            $(".discount").text("-" + ud_price_percentage + "%");
            $(".c052, .old_p").html(undiscountedPrice);
            $(".price-x2").text(undiscountedPrice + _currency);
        } else {
            $(".price1 > .c052").html(
                (parseFloat(activePrice.replace(/\D[.]/g, "")) * 2).toFixed(0)
            );
        }
    }
    $("#dsku_form").val(comb.attr("data-sku"));
}

/* Image defer */
function imageDeferer() {
    var imgDefer = document.getElementsByTagName("img");
    for (var i = 0; i < imgDefer.length; i++) {
        if (imgDefer[i].getAttribute("data-src")) {
            imgDefer[i].setAttribute(
                "src",
                imgDefer[i].getAttribute("data-src")
            );
        }
    }
}
imageDeferer();

function calculateDeliveryDate(packagingTime = daysToPack) {
    // console.log(packagingTime);
    //DATE

    var currentDate = new Date();

    //
    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth() + 1;
    var currentMonthDay = currentDate.getDate();
    var currentWeekDay = currentDate.getDay();

    var packagingTime = packagingTime;

    //Calculate number of days in current month
    function daysInCurrentMonth(year, month) {
        return new Date(year, month, 0).getDate();
    }
    var daysInCurrentMonth = daysInCurrentMonth(currentYear, currentMonth);

    //Winte.. erm, weekend is coming.
    function isWeekendClose() {
        //Friday
        if (currentWeekDay === 5) {
            // set monday delivery
            return {
                currentWeekDay: 5,
                deliveryWeekDay: 1,
                deliveryMonthDate: currentMonthDay + packagingTime + 2,
                jump: true,
            };
        }
        //Saturday
        if (currentWeekDay === 6) {
            // set tuesday delivery
            return {
                currentWeekDay: 6,
                deliveryWeekDay: 2,
                deliveryMonthDate: currentMonthDay + packagingTime + 2,
                jump: true,
            };
        }
        //Sunday
        if (currentWeekDay === 0) {
            // set tuesday delivery
            return {
                currentWeekDay: 0,
                deliveryWeekDay: 2,
                deliveryMonthDate: currentMonthDay + packagingTime + 1,
                jump: true,
            };
        }

        //All others
        return {
            deliveryWeekDay: 0,
            deliveryMonthDate: currentMonthDay + packagingTime,
            jump: false,
        };
    }

    //Returns object that defines delivery day in week and delivery date in month, taking weekend into consideration.
    var weekendJump = isWeekendClose(
        currentWeekDay,
        currentMonthDay,
        packagingTime
    );

    //Calculate Delivery day [0-6]
    function calcDay() {
        if (weekendJump.deliveryWeekDay != 0) {
            return weekendJump.deliveryWeekDay;
        } else {
            return currentWeekDay + packagingTime - packagingTime + 1;
        }
    }

    //Calculate Delivery date [1-31 - depends on month]
    function calcDayInMonth() {
        //WEEKEND
        if (weekendJump.jump != false) {
            //End of month case for friday,saturday, sunday
            if (weekendJump.deliveryMonthDate > daysInCurrentMonth) {
                //End of month on Weekend friday and saturday
                //Friday
                if (weekendJump.currentWeekDay === 5) {
                    return (
                        "" +
                        (currentMonthDay +
                            packagingTime -
                            daysInCurrentMonth +
                            2) +
                        "." +
                        (currentMonth + 1) +
                        ""
                    );
                }
                //Saturday
                if (weekendJump.currentWeekDay === 6) {
                    return (
                        "" +
                        (currentMonthDay +
                            packagingTime -
                            daysInCurrentMonth +
                            2) +
                        "." +
                        (currentMonth + 1) +
                        ""
                    );
                }

                //Sunday
                return (
                    "" +
                    (currentMonthDay + packagingTime - daysInCurrentMonth) +
                    "." +
                    (currentMonth + 1) +
                    ""
                );
            }

            //regular month days
            return (
                "" + weekendJump.deliveryMonthDate + "." + currentMonth + "."
            );

            //OTHER DAYS
        } else {
            //End of month of month case all other days
            if (weekendJump.deliveryMonthDate > daysInCurrentMonth) {
                return (
                    "" +
                    (currentMonthDay + packagingTime - daysInCurrentMonth) +
                    "." +
                    (currentMonth + 1) +
                    ""
                );
            }

            //regular month days
            return (
                "" +
                (currentMonthDay + packagingTime) +
                "." +
                currentMonth +
                "."
            );
        }
    }

    //PRINT TO HTML

    // //Delivery date day
    // var deliveryDate = calcDay();
    // //Get day name from array: days
    // var deliveryWriteDay = days[deliveryDate];
    // //Get delivery date
    // var deliveryWriteDate = calcDayInMonth();

    //Print to html
    if (document.querySelector(".prDate")) {
        // document.querySelector('.prDate').textContent = deliveryWriteDay + ', ' + deliveryWriteDate;

        // This line uses calculator above, commented to use Z system calculated ones
        //$('.prDate').text(deliveryWriteDay + ', ' + deliveryWriteDate);

        //ZOHO SYSTEM DATES DEFINED IN FOOTER
        if (
            typeof deliveryDay != "undefined" &&
            typeof deliveryDate != undefined
        ) {
            $(".prDate").text(deliveryDay + ", " + deliveryDate);
        }
    }
}

//Returns delivery date, set packaging time in days as parameter, default is 1
calculateDeliveryDate();

// -- Point user to invalid field (scroll to) REFACTORED
function scrollToError(scrollTO) {
    let offset = 150;

    if ($(window).width() > 1023) {
        // -- Focus element and give it a focus class that helps with errorHandler fn
        $('input[name="' + scrollTO + '"]')
            .addClass("focused")
            .select();
    }

    $("html, body").animate(
        {
            scrollTop:
                $('input[name="' + scrollTO + '"]').offset().top - offset,
        },
        1000
    );
}

// -- Loading state modify - REFACTORED
function loadingState(state) {
    $(".sending").hide();
    $(".order-info").show();

    if (state) {
        $(".sending").show();

        if (state === "hide") {
            $(".sending").hide();
            $(".order-info").hide();
        }
    }
}

// -- Clear localstorage
function clearStorage() {
    localStorage.clear();
}

// -- Redirect to thanks
function redirect(delay) {
    // cancel abandoned order, if it exists
    if (
        localStorage.getItem(aoStorageKey) &&
        WS_.id["res"].result === "OK" &&
        typeof $("#phone") !== "undefined"
    ) {
        localStorage.removeItem(aoStorageKey);
        cancelAbandonedOrder($("#phone").val(), location.href);
    }

    // -- Clear cart dta from localsorage
    WS_.localStorageClear();

    setTimeout(function () {
        getOrderRedirect(WS_.id["res"], WS_.payment["method"]);
    }, delay);
}

function keyDuplicates(object, format) {
    for (i = 0; i <= object.length; i++) {
        if (
            typeof object[i] != "undefined" &&
            object[i]["sku"] == format["sku"]
        ) {
            delete object[i];
            return true;
        }
    }

    return false;
}

function removeDuplicates(object) {
    return object.filter((value) => Object.keys(value).length !== 0);
}

// -- New order form username validation
function checkUsername() {
    // -- Control variables
    var whitespace = false;
    var condition = false;
    var elem = $("#ime");

    // -- Check "Name" field is there whitespace and if is there at least 2 words imported in to the input
    if (
        typeof $(elem).val().match(/\s/g, "") !== "undefined" &&
        $(elem).val().match(/\s/g, "") !== null
    ) {
        var fiedValue = $(elem).val();
        var matchWhiteSpace = fiedValue.match(/\s/g, "");

        if (Object.keys(matchWhiteSpace).length > 0) {
            var splitValue = fiedValue.split(" ").filter(function (el) {
                return el !== "";
            });

            if (splitValue.length > 1 && splitValue[1].length > 1) {
                whitespace = true;
            }
        }
    }

    // -- Check is field valid
    if (!$(elem).hasClass("crvenaS") && $(elem).val().length > 1) {
        if ($(elem).attr("id") == "ime") {
            if (whitespace) condition = true;
        } else if ($(elem).attr("id") != "ime") {
            condition = true;
        }
    }

    // -- Condition / on the fly validation ( real-time validation )
    return condition;
}

// Convert eur to local currency
function convertEurToLocal(price) {
    let baseCurrency = "eur";
    let targerCurrenct = currency_value.toLowerCase();
    let exRate = frCrExRs[baseCurrency]["rate"] / frCrExRs["hrk"]["rate"];
    let convertedValue = (price / exRate).toFixed(2);

    return convertedValue;
}

function convertEurToLocal(price, country) {
    let baseCurrency = "eur";
    var targetCurrency = targetCurrency
        ? getTargetCurency(country)
        : getTargetCurency(getCountry);

    let exRate =
        frCrExRs[baseCurrency]["rate"] / frCrExRs[targetCurrency]["rate"];

    let convertedValue = (price / exRate).toFixed(2);

    return convertedValue;
}

function getTargetCurency(country) {
    var targetCurrency;

    var getCountry = country ? country : getCountry;

    if (getCountry == "HR") {
        targetCurrency = "hrk";
    } else if (getCountry == "RS") {
        targetCurrency = "rsd";
    } else if (getCountry == "CZ") {
        targetCurrency = "czk";
    } else if (getCountry == "HU") {
        targetCurrency = "huf";
    } else if (getCountry == "MK") {
        targetCurrency = "mkd";
    } else if (getCountry == "PL") {
        targetCurrency = "pln";
    } else if (getCountry == "BG") {
        targetCurrency = "bgn";
    } else if (getCountry == "RO") {
        targetCurrency = "ron";
    } else if (getCountry == "BA") {
        targetCurrency = "bam";
    } else if (getCountry == "AL") {
        targetCurrency = "all";
    } else if (getCountry == "VN") {
        targetCurrency = "vnd";
    } else if (getCountry == "NG") {
        targetCurrency = "ngn";
    } else if (getCountry == "DK") {
        targetCurrency = "dkk";
    } else if (getCountry == "GB") {
        targetCurrency = "gbp";
    } else if (getCountry == "SE") {
        targetCurrency = "sek";
    } else if (
        getCountry == "SI" ||
        getCountry == "SK" ||
        getCountry == "IT" ||
        getCountry == "GR" ||
        getCountry == "LV" ||
        getCountry == "LT" ||
        getCountry == "EE" ||
        getCountry == "ES" ||
        getCountry == "PT" ||
        getCountry == "FR" ||
        getCountry == "NL" ||
        getCountry == "BE" ||
        getCountry == "DE" ||
        getCountry == "AT" ||
        getCountry == "FI" ||
        getCountry == "IE" ||
        getCountry == "EN"
    ) {
        targetCurrency = "eur";
    }

    return targetCurrency;
}

function getWidgetLocale() {
    var wLocale = "en-GB";

    if (getCountry == "DE") {
        wLocale = "de-DE";
    } else if (getCountry == "AT") {
        wLocale = "at-AT";
    } else if (getCountry == "IT") {
        wLocale = "it-IT";
    }

    return wLocale;
}

function getUrlParam(name) {
    var url = new URL(window.location.href);
    var parameter = url.searchParams.get(name);
    return parameter;
}

function resetCoupon() {
    $(".couponActivatedSum").hide();
    $(".afterCouponTotal").hide();
    $(".checkout_total_price").css("text-decoration", "none");
}

function loadServicesBox() {
    $(".checkout-product-info").empty();

    var data = JSON.parse(localStorage.getItem("cartData"));
    var checkout_product_info = $(".checkout-product-info");

    $.each(data, function (key, value) {
        if (value.fullDomain === fullDomain) {
            var shortSku =
                value.sku.split("-")[0] + "-" + value.sku.split("-")[1];
            if (psku == shortSku) {
                var peram = value.param ? " - " + value.param : "";
                var bundleProduct = value.bundleProduct ? "bundle_product" : "";
                var cancelBundle = value.bundleProduct
                    ? "<a style='display:inline'><img data-sku=" +
                      value.sku +
                      " style='margin:5px 0 -5px 5px' class='remove-bundle-product' src='/static/remove.png'></a>"
                    : "";

                var bundle_row_template =
                    "" +
                    '<div class="flex row ' +
                    bundleProduct +
                    '">' +
                    '<div class="cell mw245px">' +
                    value.productName +
                    peram +
                    cancelBundle +
                    "</div>" +
                    '<div class="cell mw75px">' +
                    value.quantity +
                    "x</div>" +
                    '<div class="cell mw160px">' +
                    value.price +
                    _currency;
                "</div>" + "</div>";

                checkout_product_info.append(bundle_row_template);
            }
        }
    });

    $(".payment-btn").on("click", function () {
        if (WS_.payment["method"] === "pp") {
            $(".checkout-payment-btn").slideUp();
        } else {
            $(".checkout-payment-btn").slideDown();
        }
    });

    // -- Price for user
    if (page_bundle != "") {
        page_free_bundle_display(page_bundle);
    }

    WS_.dashboardSubmit["cod"] = false;

    $(".ws_submit_btn").on("click", function () {
        if (!WS_.orderFormValidation("value")["status"]) {
            $(".payu-modal").show();
        }
    });
}

function insightCheck(elem, id = false, error = false) {
    var id_pointer = id ? id : $(elem).attr("name");
    var id_found = false;

    for (var i = 0; i < Object.keys(WS_.errorHandler["insight"]).length; i++) {
        if (id_pointer == WS_.errorHandler["insight"][i]["id"]) {
            // -- If error is already recorderd update it's counter
            WS_.errorHandler["insight"][i]["count"]++;

            id_found = true;
        }
    }

    // -- If order form error occured
    if (!id) error = "order_field_error";

    // -- If not found add new id
    if (!id_found) {
        WS_.errorHandler["insight"].push({
            id: id_pointer,
            error: error,
            count: 1,
        });
    }
}

function changeText() {
    if (counter > 2) {
        counter = 0;
    }

    if (counter == 0) {
        $("#text_change #0").show();
        $("#text_change #1").hide();
        $("#text_change #2").hide();
    } else if (counter == 1) {
        $("#text_change #0").hide();
        $("#text_change #1").show();
        $("#text_change #2").hide();
    } else {
        $("#text_change #0").hide();
        $("#text_change #1").hide();
        $("#text_change #2").show();
    }

    setTimeout(function () {
        changeText();
    }, 5000);
    counter++;
}
