@php use App\Helpers\ContentHelper; @endphp

<div id="package">
    <div class="container grid-fullW package-container">

        <h3 class="text-center">
            {!!$staticContainers['s_text_static_381']->text!!}
        </h3>
        <div class="window-plus">
        <img src="{{$allContainers['s_img_var_63']->text}}">
        </div>
        <div class="text-container">
            <h3 class="text-center-desktop">
                {!!$staticContainers['s_text_static_381']->text!!}
            </h3>
            <div class="text">
                {!! ContentHelper::dynamicContainers($product->shortSku, 'process|specificationsList') !!}
            </div>
        </div>
    </div>
</div>

<style>
    #package {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: flex-start;
        padding: 32px 24px;
        gap: 8px;

        background: #E4E4E4;
    }

    #package .package-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0px;
        grid-column-gap: 40px;
    }

    #package .text-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
    }

    #package .text-center,
    #package .text-center-desktop {
        margin: 0 0 26px;

        font-weight: 600;
        font-size: 24px;
        line-height: 32px;
        /* identical to box height, or 133% */

        text-align: center;

        color: #070707;
    }

    #package .text-center {
        display: none;
    }

    .window-plus {
        grid-row: 1 / span 2;
        justify-self: end;
        filter: drop-shadow(0px 0px 10px rgba(14, 14, 33, 0.06)) drop-shadow(0px 6px 16px rgba(14, 14, 33, 0.04)) drop-shadow(0px 4px 6px rgba(14, 14, 33, 0.04)) drop-shadow(0px 2px 2px rgba(14, 14, 33, 0.04));
        border-radius: 0px;
    }

    #package .package-container img {
        width: 100%;
        max-width: 400px;
    }

    #package .package-container .text {
        grid-column: 2 / span 1;
        grid-row: 2 / span 1;
        align-self: start;
    }

    #package .package-container .text span:first-child {
        display: none;
    }

    #package .package-container .text ul {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 2px;

        margin: 0 0 0 12.81px;
        text-indent: 8px;
        list-style-type: '✔';
    }


    #package .package-container .text ul li {
        margin: 0;

        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
        /* identical to box height */


        color: #070707;
    }

    #package .package-container .text ul li::marker {
        line-height: 24px;
        color: #C21225;
    }

    @media screen and (max-width: 768px) {
        #package {
            background: none;
        }
        #package .package-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        #package .text-center,
        #package .package-container .text {
            margin : 0 auto 0 auto;
        }
        #package .text-center {
            display: block;
        }
        #package .text-center-desktop {
            display: none;
        }
    }
</style>
