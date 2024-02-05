document.addEventListener('DOMContentLoaded', function () {
    const splide = document.querySelector('#splide');
    if (splide) {
        new Splide(splide, {
            type: 'loop',
            perPage: 3,
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            throttle: 300,
            fixedHeight: '',
            breakpoints: {
                1440: {
                    perPage: 1,
                },
                800: {
                    fixedWidth: '280px',
                }
            },
        }).mount();
    }
    const splide2 = document.querySelector('#splide2');
    if (splide2) {
        new Splide(splide2, {
            type: 'loop',
            perPage: 3,
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '10%',
            throttle: 300,
            gap: '100px',
            breakpoints: {
                1440: {
                    perPage: 1,
                    padding: '30%'
                },
                480: {
                    perPage: 1,
                    fixedWidth: 230,
                    padding: '5%',
                    gap: 10,
                }
            },
            fixedWidth: 240,
        }).mount();
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const splideRelated = document.querySelector('#splideRelated');
    if (splideRelated) {
        const splideRelatedInstance = new Splide(splideRelated, {
            type: 'loop',
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '30%',
            throttle: 300,
            gap: 20,
            breakpoints: {
                768: {
                    perPage: 2,
                    fixedWidth: 180,
                    padding: '5%',
                    gap: 20,
                },
                480: {
                    perPage: 1,
                    fixedWidth: 230,
                    padding: '5%',
                    gap: 20,
                }
            },
            fixedWidth: 330,
        });

        splideRelatedInstance.mount();

        const totalSlides = splideRelated.querySelectorAll('.splide__slide').length;

        if (totalSlides <= 4) {
            splideRelatedInstance.destroy(); // Destroy the initial instance

            new Splide(splideRelated, {
                perPage: 4,
                pagination: false,
                padding: 0,
                gap: 20,
                fixedWidth: 330,
            }).mount();
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {

    const splideReviews = document.querySelector('#splideReviews');

    if (splideReviews) {
        new Splide(splideReviews, {
            type: 'loop',
            perPage: 3,
            focus: 'center',
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '10%',
            throttle: 300,
            gap: '8%',
            breakpoints: {
                1441: {
                    perPage: 3,
                    padding: '30%',
                    fixedWidth: '330px',
                },
                768: {
                    perPage: 2,
                    fixedWidth: '330px',
                },
                576: {
                    perPage: 1,
                    gap: '30%',
                    fixedWidth: '300px',
                },
                321: {
                    perPage: 1,
                    gap: '30%',
                    fixedWidth: '280px',
                },
            },
            fixedWidth: '33%',
        }).mount();
    }
});


document.addEventListener('DOMContentLoaded', function () {

    const splideRounded = document.querySelector('#splideRounded');

    if (splideRounded) {
        new Splide(splideRounded, {
            type: 'loop',
            perPage: 3,
            focus: 'center',
            autoplay: false,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '10%',
            throttle: 300,
            breakpoints: {
                1441: {
                    perPage: 3,
                    padding: '30%',
                    fixedWidth: '330px',
                },
                768: {
                    perPage: 2,
                    fixedWidth: '330px',
                },
                576: {
                    perPage: 1,
                    fixedWidth: '180px',
                },
            },
            fixedWidth: '33%',
        }).mount();
    }
});



document.addEventListener('DOMContentLoaded', function () {
    const splideIndexProducts = document.querySelector('#splideIndexProducts');
    if (splideIndexProducts) {
        const splideIndexInstance = new Splide(splideIndexProducts, {
            type: 'loop',
            focus: 'center',
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '30%',
            throttle: 300,
            gap: 20,
            breakpoints: {
                768: {
                    perPage: 2,
                    fixedWidth: 180,
                    padding: '5%',
                    gap: 20,
                },
                480: {
                    perPage: 1,
                    fixedWidth: 280,
                    padding: '5%',
                    gap: 20,
                }
            },
            fixedWidth: 330,
        });

        splideIndexInstance.mount();

        // const totalSlides = splideRelated.querySelectorAll('.splide__slide').length;

        // if (totalSlides <= 4) {
        //     splideRelatedInstance.destroy(); // Destroy the initial instance

        //     new Splide(splideRelated, {
        //         perPage: 4,
        //         pagination: false,
        //         padding: 0,
        //         gap: 20,
        //         fixedWidth: 330,
        //     }).mount();
        // }
    }
});

document.addEventListener('DOMContentLoaded', function () {

    const splideTmpl11 = document.querySelector('#tmpl_11_slider');

    if (splideTmpl11) {
        new Splide(splideTmpl11, {
            type: 'loop',
            perPage: 1, // Display only one slide at a time
            focus: 'center',
            autoplay: true,
            interval: 3000,
            flickMaxPages: 3,
            updateOnMove: true,
            pagination: false,
            padding: '10%',
            throttle: 300,
            gap: '20%',
            breakpoints: {
                1441: {
                    perPage: 1,
                    fixedWidth: '100%', 
                },
                768: {
                    perPage: 1,
                    fixedWidth: '100%', 
                },
                576: {
                    perPage: 1,
                    fixedWidth: '100%', 
                },
            },
            fixedWidth: '100%', // Set fixedWidth to 100%
        }).mount();
    }
});
