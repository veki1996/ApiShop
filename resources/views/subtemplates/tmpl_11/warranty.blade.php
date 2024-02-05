<div class="t11-warranty-box parent column v-center h-center bg-color-white">
    <div class="t11-wrapper parent column">
        <h3>
            {!!$allContainers['s_text_var_3']->text!!}
        </h3>
        <div class="t11-media-warranty parent row h-center pdn-small">
        <div class="media-holder parent column h-center v-center pdn-small deskWidth">
            <img class="images-3box" src="{{$allContainers['s_img_var_16']->text}}">
        </div>
        <div class="benefits-holder parent column pdn-small">
            <div class="benefit parent row v-center pdn-small">
                <div class="parent column v-center h-center">
                    <img src="{{$allContainers['s_img_var_1']->text}}">
                </div>
                <div class="parent column">
                    <h4>{!!$allContainers['s_text_var_4']->text!!}
                    </h4>
                    <p>
                        {!!$allContainers['s_text_var_5']->text!!}
                    </p>
                </div>
            </div>
            <div class="benefit parent row v-center pdn-small">
                <div class="parent column v-center h-center">
                    <img src="{{$allContainers['s_img_var_2']->text}}">
                </div>
                <div class="parent column">
                    <h4>
                        {!!$allContainers['s_text_var_6']->text!!}
                    </h4>
                    <p>
                        {!!$allContainers['s_text_var_7']->text!!}
                    </p>
                </div>
            </div>
            <div class="benefit parent row v-center pdn-small">
                <div class="parent column">
                    <img src="{{$allContainers['s_img_var_3']->text}}">
                </div>
                <div class="parent column">
                    <h4>
                        {!!$allContainers['s_text_var_8']->text!!}
                    </h4>
                    <p>
                        {!!$allContainers['s_text_var_9']->text!!}
                    </p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<style>
    .t11-warranty-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 16px 24px;
        gap: 25px;

        background: #E4E4E4;
    }

    .t11-warranty-box h3 {
        margin: 0 0 25px;

        font-weight: 600;
        font-size: 18px;
        line-height: 32px;
        /* or 133% */

        text-align: center;

        color: #070707;
    }

    .t11-warranty-box .t11-media-warranty {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 0px;
        gap: 40px;
    }

    .t11-warranty-box .media-holder {
        filter: drop-shadow(0px 0px 10px rgba(14, 14, 33, 0.06)) drop-shadow(0px 6px 16px rgba(14, 14, 33, 0.04)) drop-shadow(0px 4px 6px rgba(14, 14, 33, 0.04)) drop-shadow(0px 2px 2px rgba(14, 14, 33, 0.04));
    }

    .benefits-holder {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 16px;
    }

    .benefit {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 16px;

        border-bottom: 0.5px solid #979797;
    }

    .benefit:last-child {
        border: none;
    }

    .benefit:last-child .parent:last-child {
        padding: 0;
    }

    .benefit .parent:last-child {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0 0 16px;
        gap: 4px;
    }

    .t11-warranty-box .benefits-holder img {
        max-width: 56px;
        filter: invert(50%);
    }

    .t11-warranty-box .benefits-holder h4 {
        margin: 0;

        font-weight: 600;
        font-size: 18px;
        line-height: 24px;
        /* identical to box height, or 133% */


        color: #070707;
    }

    .t11-warranty-box .benefits-holder p {
        margin: 0;

        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
        /* or 143% */


        color: #070707;
    }

    @media screen and (max-width:768px) {
        .t11-warranty-box .t11-media-warranty {
            flex-direction: column;
        }
        .benefit {
            gap: 8px;
        }
    }
</style>
