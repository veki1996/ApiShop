<div class="single testimonial" id="socialOne">
    <div class="container grid grid-fullW">
        <div class="social-one m0a">
        <img src="{{$allContainers['s_img_var_28']->text}}" alt="">
        <div class=deskStyle>
            <div class="social-one_text">
                {!!$allContainers['s_text_var_63']->text!!}
            </div>
            <div class="social-one_image">
                <img src="{{$staticContainers['s_img_static_146']->text}}" alt="">
                <div>
                <div class="rating">
                    <span id="stars">★★★★★</span> 5/5
                </div>
                <h4>
                    MT
                </h4>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

<style>
    #socialOne {
        margin: 0 auto 24px;
        padding: 0;
        width: 92%;
        min-width: auto;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 32px;
    }

    .save-money {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 16px 24px;
        gap: 16px;
        justify-content: center;
        background: #070707;

        font-weight: 400;
        font-size: 18px;
        line-height: 21px;

        color: #F4F4F4;

        text-align: initial;
    }

    .social-one {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 16px;
        gap: 16px;

        background: #FEFEFE;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);

        max-width: 616px;
        margin: 0 auto;
    }

    #socialOne .social-one > img {
        filter: drop-shadow(0px 0px 10px rgba(14, 14, 33, 0.06)) drop-shadow(0px 6px 16px rgba(14, 14, 33, 0.04)) drop-shadow(0px 4px 6px rgba(14, 14, 33, 0.04)) drop-shadow(0px 2px 2px rgba(14, 14, 33, 0.04));
    }

    .social-one_text {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        /* or 150% */

        text-align: center;

        color: #070707;
    }

    .social-one_image {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 12px;
        justify-content: center;
        margin-top:10px;
    }

    .social-one_image img {
        width: 48px;
        height: 48px;
        border-radius: 40px;
    }

    .social-one_image > div {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 8px;
    }
    .social-one img{
        max-width: 390px !important; 
    }

    #stars {
        display: initial !important;
        color: #FEC000 !important;
        font-size: 18px;
    }

    #socialOne h4 {
        margin: 0;
        
        font-weight: 600;
        font-size: 20px;
        line-height: 23px;
        text-align: center;

        color: #070707;
    }


    @media screen and (max-width: 768px) {
        .social-one_image {
            flex-direction: column;
        }
        .social-one_image > div {
            align-items: center;
        }
    }

    @media screen and (min-width: 768px){
        .social-one{
            flex-direction: row;
        }
        .social-one_image{
            justify-content: flex-start;
        }
        .deskWidth{
            width: 100%;
        }
        .t11-wrapper h3{
            font-size: 24px !important;
        }
    }
</style>
