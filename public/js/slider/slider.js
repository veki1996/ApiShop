let sliderContainer = document.querySelector('.slider-container');
const sliderDivSelector = $('.slider-container > .slide');
const sliderDots = $('.dots > .dot');
let divIndex = 0;

function slideOn(index) {
    let sliderDivSize = sliderDivSelector.first(0).width();
    let position = index * sliderDivSize;

    sliderContainer.scroll({
        left: position,
        behavior: "smooth",
    });

    sliderDots.removeClass('dot-active');
    sliderDots.eq(index).addClass('dot-active');
    divIndex = index;
    $('.slider-text').first().text(sliderTexts[index % 3]);
    $('.slider-second-text').first().text(sliderSecondTexts[index % 3]);
}

setInterval(function () {
    slideOn(divIndex);
    divIndex++;

    if (divIndex > sliderDivSelector.length) {
        divIndex = 0;
        slideOn(divIndex);
    }
}, 4000);

$(document).ready(function () {

    // if on mobile change slider images content to mobile
    if($(window).width() < 600) {
        sliderDivSelector.each(function() {
            let img = $(this).find('img').first();
            img.attr('src', img.data('mobile'));
        })
    }

    $('.dot').on('click', function () {
        let index = sliderDots.index($(this));
        slideOn(index);
        divIndex = index;
    });
});

