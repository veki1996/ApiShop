$(document).ready(function() {
    $('.add-gift-bag').on('click', function() {
       let btn = $(this);

       if(btn.hasClass('checked')) {
           btn.html('');
           btn.removeClass('checked');

            // TODO: remove gift bag from cart!
           return;
       }

       btn.addClass('checked');
       btn.html(`<img src="${app_url}/static/checkmark.png">`);

        // TODO: add gift baf to cart!
    });
});
