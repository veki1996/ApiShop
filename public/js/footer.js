$(document).ready(function () {
    $('.arrow').on('click', function () {
        $(this).toggleClass('rotate');
        $(this).closest('.tos-parag').next('.footer-item').toggleClass('show');
    });
});