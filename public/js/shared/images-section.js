const bannerSlider = document.querySelector('.images-section-images');
let pixelPosition = 0;
const imageSelector = $('.images-section-images > img');
const imageSize = imageSelector.first(0).width();

setInterval(function() {
    bannerSlider.scroll({
        left: pixelPosition,
        behavior: "smooth",
    });
    pixelPosition += imageSize;

    if(pixelPosition > imageSize * imageSelector.length) {
        pixelPosition = 0;
    }
    console.log();
}, 4000);
