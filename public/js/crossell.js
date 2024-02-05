let deadline = new Date().getTime() + 3 * 60 * 1000;
let x        = setInterval(function () {
    let now     = new Date().getTime();
    let t       = deadline - now;
    let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((t % (1000 * 60)) / 1000);

    minutes = String(minutes).padStart(2, "0");
    seconds = String(seconds).padStart(2, "0");
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);

    if (t < 0) {
        clearInterval(x);
        $("#minutes").text("00");
        $("#seconds").text("00");
        // location.href = appUrl + '/thanks';
    }
}, 1000);

$(document).ready(function () {
    $(".approved").on("click", function () {
        const dataArr = [];
        $(".added-btn").each(function () {
            const box      = $(this).closest(".box");
            const sku      = box.find(".quantityBox").data("sku");
            const price    = parseFloat(box.find("option:selected").data("price"));
            const quantity = parseInt(
                box.find(".cart-quantity-selector").val()
            );

            const discount = 0;

            const itemData = {
                full_sku: sku,
                quantity: quantity,
                price: price.toFixed(2),
                discount: discount,
            };
            dataArr.push(itemData);
        });

        if (dataArr.length === 0) {
            $('#validationMsg').show();
            $('html, body').animate({
                scrollTop: 200
            }, 1000);
            return;
        }
    
        $.ajax({
            url: url,
            data: {
                'sHref': hashId,
                'orderData': dataArr,
            },
            type: 'POST',
            success(response) {
                console.log("success");
                location.href = appUrl + '/thanks'
             },
            error(xhr) {
                console.log(xhr.responseText)
            },
        })
    });

    $(".cart-quantity-selector").on("change", function () {
        const sku = $(this).attr("data-sku");
        const quantity = $(this).val();
        const price = Number(
            $(this).children("option:selected").attr("data-price")
        );

        $(`.price[data-sku="${sku}"]`).text(`${price} ${currency}`);
    });

    $(".refuse").on("click", function () {
        location.href = appUrl + "/thanks";
    });

});

window.addEventListener("DOMContentLoaded", function () {
    cart.products = [];
    cart.update();
    // drawCart();

    var buttons = document.querySelectorAll(".add-btn");

    buttons.forEach(function (button) {
        var textElement  = button.querySelector("p");
        var imageElement = button.querySelector("img");

        button.addEventListener("click", function () {
            if (textElement.textContent === add) {
                textElement.textContent = added;
                imageElement.src = appUrl + "/static/done.png";
                this.classList.add("added-btn");
                $('.cs-sticky-buttons-container').css('display', 'flex')
            } else  {
                textElement.textContent = add;
                imageElement.src = appUrl + "/static/add-to-cart-gold.png";
                this.classList.remove("added-btn");
            }
            const addedBtnCrossell = document.querySelectorAll(".added-btn");
            if (addedBtnCrossell.length === 0) {
                console.log('0')
                $('.cs-sticky-buttons-container').css('display', 'none')
            }
        });
    });
});
