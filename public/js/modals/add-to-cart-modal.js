$(".continueShopping").on("click", function() {
    $(".addedToCartPopp").removeClass("showPopup")
    $(".overlay").addClass("hidden")
})

$(".closeBtnPop, .overlay").on("click", function() {
    $(".addedToCartPopp").removeClass("showPopup")
    $(".overlay").addClass("hidden")
})