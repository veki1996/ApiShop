$(document).ready(function() {
    if ($('.scroll').length > 0) {
        $('.scroll').on('click', function() {
            $('.checkout-row')[0].scrollIntoView({ behavior: 'smooth' });
        });
    }
});
