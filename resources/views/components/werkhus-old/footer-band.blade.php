@php
    use App\Helpers\ContentHelper;

    /**
    * @var string $email
    * @var string $phone
    */
@endphp

<div class="ft_l1_main_wrap ft_l1_main_wrap_1 saftyShopping">
    <div class="ft_l1_wrap ft_l1_wrap_1">
        <div>
            <h2 class="txt-color-white bold">{{ContentHelper::staticText('safeShopping') }}</h2>
            <h3 class="txt-color-white semibold">{{ContentHelper::staticText('moneyRefund') }}</h3>
        </div>

        <div class="parent row">
            <div class="doki-cell-phone txt-color-white h-center v-center" id="d-phone" style="display: flex">
                <img src="{{env('APP_URL')}}/svg/phone.svg">
                {{$phone}}
            </div>
            <div class="doki-mail parent h-center v-center">
                <a href="mailto:{{$email}}" class="doki-mail txt-color-white h-center v-center" style="display:none"
                   id="d-whatsapp"
                >
                    <img src="{{env('APP_URL')}}/svg/email2.svg">
                    {{$email}}
                </a>
            </div>
        </div>

    </div>
</div>

<style>
    .ft_l1_main_wrap h2,
    .ft_l1_main_wrap h3,
    .ft_l1_main_wrap .doki-cell-phone,
    .ft_l1_main_wrap .doki-mail {
        color: #070707 !important;
    }
    .ft_l1_main_wrap.ft_l1_main_wrap_1.bg-color-primary {
        padding: 48px 16px 32px !important;
        background: #F4F4F4;
    }
    .ft_l1_main_wrap:not(.ft_l1_main_wrap_4)
    .ft_l1_wrap.ft_l1_wrap_1
    > div:first-child {
        background: no-repeat url('{{env('APP_URL')}}/static/lock2.png');
        background-position: top 0 center;
        gap: 24px;
    }
    .ft_l1_main_wrap .ft_l1_wrap h2 {
        margin: 82.45px auto 10px;

        width: 250px;
        font-style: italic;
        font-weight: 900 !important;
        font-size: 25.6px;
        line-height: 30px;
        text-align: center;
        text-transform: uppercase;

        color: #070707;

        text-shadow: 0px 3.4px 13.6px #ffffff,
        0px 3.4px 30.6px rgba(255, 255, 255, 0.9), 0px 3.4px 13.6px #ffffff,
        0px 3.4px 30.6px rgba(255, 255, 255, 0.9);
    }
    .ft_l1_main_wrap .ft_l1_wrap h3 {
        width: 265px;
        margin: 0 auto 24px;

        font-weight: 600;
        font-size: 16px;
        line-height: 19px;
        text-align: center;

        color: #070707;
    }
    .ft_l1_wrap_1 .parent {
        gap: 8px;
    }
    .doki-cell-phone,
    .doki-mail {
        margin: 0 auto !important;
        flex-direction: row;
        gap: 8px;
        white-space: nowrap;
        font-weight: 600;
        font-size: 16px;
        line-height: 19px;
        color: #070707;
    }
    /* .doki-cell-phone img {
        content: url('/svg/phone.svg');
        margin: 0;
    } */
    /* .doki-mail img {
        content: url('/svg/email2.svg');
        margin: 0;
    } */
    .saftyShopping{
        padding-top: 47px;
        padding-bottom: 35px; 
    }

    @media screen and (min-width: 769px) {
        .ft_l1_main_wrap_1 .ft_l1_wrap {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 50%;
        }
        .ft_l1_main_wrap:not(.ft_l1_main_wrap_4)
        .ft_l1_wrap.ft_l1_wrap_1
        > div:first-child {
            padding: 0;
            background-position: top center;
        }
        .ft_l1_wrap_1 .parent {
            display: grid;
            align-items: start;
            justify-items: center;
            gap: 12px 16px;
            max-width: 448px;
        }
        .ft_l1_main_wrap h2,
        .ft_l1_main_wrap h3,
        .ft_l1_main_wrap .doki-cell-phone,
        .ft_l1_main_wrap .doki-mail {
            padding: 0;
        }
        .ft_l1_main_wrap .ft_l1_wrap h3 {
            grid-column: 1 / -1;
            margin: 0;
            width: 328px;
            align-self: end;
        }
    }
</style>

<script>
    if ($(window).width() > 768) {
        $('.ft_l1_main_wrap .ft_l1_wrap h3').prependTo('.ft_l1_wrap_1 > .parent');
    }
</script>
