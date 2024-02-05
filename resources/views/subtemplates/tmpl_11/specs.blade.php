@php use App\Helpers\ContentHelper; @endphp

<div id="specs">
    <div class="container grid-fullW">
        <div class="specs accordion">
        <div class="head accordion__intro">
            <h1>{{$staticContainers['s_text_static_380']->text}}</h1>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_102_2734" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                    <rect width="24" height="24" fill="#D9D9D9"/>
                </mask>
                <g mask="url(#mask0_102_2734)">
                    <path d="M12 15.375L6 9.37498L7.4 7.97498L12 12.575L16.6 7.97498L18 9.37498L12 15.375Z" fill="#070707"/>
                </g>
            </svg>
        </div>
        <div class="accordion__content">
            {!! ContentHelper::dynamicContainers($product->shortSku, 'process|specifications_copy_1') !!}
        </div>
        </div>
    </div>
</div>

<style>
    .accordion {
        width: 100%;
        overflow: hidden;
        margin-top: 20px;
    }

    .accordion__intro {
        position: relative;
        padding: 20px;
        cursor: pointer;
    }

    .accordion__content {
        max-height: 0;
        overflow: hidden;
        will-change: max-height;
        transition: all 0.25s ease-out;
        opacity: 0;

        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        width: 100%;
        max-width: 780px;
        padding: 0px;
    }

    .accordion__active .accordion__content {
        opacity: 1;
    }

    .accordion__content .c063 {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0 16px;
        gap: 14px;
        width: 50%;
    }

    .accordion__content .c063 .c065 {
        opacity: 1;
        margin: 0;

        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
    }

    .accordion__content .c063 .c065 div p {
        margin: 0;

        font-weight: 400;
        font-size: 16px;
        line-height: 19px;

        color: #070707;
    }

    .accordion__content .c063 .c065 div:first-child p {
        font-weight: 600;
        font-size: 16px;
        line-height: 19px;
        /* identical to box height */


        color: #070707;
    }

    #specs {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 56px 16px 40px;
        gap: 4px;
    }

    .grid-fullW {
        max-width: 1120px;
        flex-shrink: 0;
        flex: 1;
        width: 100%;
    }

    #specs .specs {
        margin: 0 auto;
        overflow: hidden;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 40px;
    }

    #specs .specs .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 4px;
    }

    #specs .specs .head h1 {
        margin: 0;

        font-weight: 600;
        font-size: 20px;
        line-height: 23px;

        color: #070707;
    }


    #specs .specs .items {
        transition: all .2s cubic-bezier(.075, .82, .165, 1);
        transition-property: max-height, padding, opacity;
        padding: 0 15px;
    }

    #specs .specs .items {
        font-size: 14px;
    }

    #specs .accordion__active .items {
        max-height: 400px;
        opacity: 1;
        margin: 15px 0px;
    }

    #specs .specs .head svg {
        transition: all .2s ease-in-out;
        transition-property: transform;
    }

    #specs .accordion__active svg {
        transform: rotate(180deg);
    }


    #specs .specs .items h3 {
        font-size: 16px;
    }

    #specs .specs .items p {
        font-size: 14px;
    }

    @media screen and (max-width: 768px) {
        .accordion {
            max-width: 500px;
        }
        #specs {
            padding-top: 0;
        }
        #specs .specs {
            align-items: flex-start;
            gap: 16px;
        }
        .accordion__content {
            flex-direction: column;
            gap: 14px
        }
        .accordion__content .c063 {
            width: initial;
        }
    }
</style>

<script>
    const accordions = document.querySelectorAll(".accordion");

    const openAccordion = (accordion) => {
        const content = accordion.querySelector(".accordion__content");
        accordion.classList.add("accordion__active");
        content.style.maxHeight = content.scrollHeight + "px";
    };

    const closeAccordion = (accordion) => {
        const content = accordion.querySelector(".accordion__content");
        accordion.classList.remove("accordion__active");
        content.style.maxHeight = null;
    };

    accordions.forEach((accordion) => {
        openAccordion(accordion);

        const intro = accordion.querySelector(".accordion__intro");
        const content = accordion.querySelector(".accordion__content");

        intro.onclick = () => {
            if (content.style.maxHeight) {
                closeAccordion(accordion);
            } else {
                accordions.forEach((accordion) => closeAccordion(accordion));
                openAccordion(accordion);
            }
        };
    });
</script>
