<?php use App\Helpers\ContentHelper; ?>

<div class="reviews-container">
    <div class="reviews-title">{{ContentHelper::staticText('messagesOfOurSatisfiedCustomers') }}</div>
    <div id="reviews">
        @foreach($products as $product)
            <div class="slick-slide">
                <img src="{{ContentHelper::allContainers($product->shortSku)['s_img_var_33']->text}}" alt="" class="review-image">
                <div class="review-user">
                    <div class="review-profile">
                        <img src="{{ContentHelper::staticContent()['s_img_static_158']->text}}" alt="">
                    </div>
                    <div
                        class="review-initials"><?php echo range('A', 'Z')[rand(0, 25)] . range('A', 'Z')[rand(0, 25)] ?></div>
                </div>
                <div class="review-rating">
                    <span class="review-stars">★★★★★</span> 5/5
                </div>
                <div
                    class="review-comment">{{ContentHelper::allContainers($product->shortSku)['s_text_var_63']->text}}</div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .reviews-container {
        padding: 88px 16px 50px;
    }
    .reviews-title {
        font-weight: 600;
        font-size: 40px;
        line-height: 47px;
        text-align: center;
        margin-bottom: 48px;
    }
    #reviews {
        display: flex;
        justify-content: center;
    }
    #reviews button.slick-prev,
    #reviews button.slick-next {
        transition: all .2s;
    }
    #reviews button.slick-prev,
    #reviews button.slick-prev:hover,
    #reviews button.slick-next,
    #reviews button.slick-next:hover {
        display: inline-block !important;
    }
    #reviews .slick-prev:before,
    #reviews .slick-next:before {
        content: '';
    }
    #reviews .slick-prev:hover,
    #reviews .slick-prev:focus,
    #reviews .slick-next:hover,
    #reviews .slick-next:focus {
        background-color: rgba(0,0,0,0.2);
    }
    #reviews .slick-prev:hover,
    #reviews .slick-prev:focus {
        background-image: url("{{env('APP_URL')}}/static/left_arrow.png");
    }
    #reviews .slick-next:hover,
    #reviews .slick-next:focus {
        background-image: url("{{env('APP_URL')}}/static/right_arrow.png");
    }
    #reviews .slick-list {
        width: 92%;
        padding: 16px 0;
    }
    #reviews .slick-track {
        display: flex !important;
    }
    #reviews .slick-slide {
        height: inherit !important;
        margin: 0 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 16px;
        gap: 8px;

        background: #FEFEFE;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
    }
    .review-image {
        margin-bottom: 16px;
    }
    .review-user {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .review-profile {
        width: 40px;
        height: 40px;
        font-size: 12px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ededed;
        text-transform: uppercase;
        position: relative;
        pointer-events: none;
    }
    .review-profile img {
        width: 100%;
        /*max-width: 35px;*/
        /*height: fit-content;*/
        /*max-height: 35px;*/
        border-radius: 50%;
        border: 1px solid rgb(177 177 177 / 45%);
    }
    .review-initials {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 20px;
        line-height: 23px;
        text-align: center;
    }
    .review-comment {
        font-size: 16px;
        line-height: 19px;
        text-align: center;
    }
    .review-rating {
        font-size: 16px;
        line-height: 16px;
    }
    .review-stars {
        color: #FEC000;
        font-size: 20px;
    }
    @media screen and (max-width: 424px) {
        .reviews-container {
            padding: 40px 16px 24px;
        }
        .reviews-title {
            font-size: 24px;
            line-height: 28px;
            margin-bottom: 24px;
        }
    }
</style>

<script>
    $('#reviews').slick({
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 425,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
