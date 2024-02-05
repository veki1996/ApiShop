
$(document).ready( ()=> {

    if($('.book-checkbox img').show())
    {   
        $('.books-section').addClass('books-active')
    }

    $('.book-checkbox').on('click', function() {
        $(this).find('img').toggle();
        $(this).closest('.books-section').toggleClass('books-active');
    })
})

