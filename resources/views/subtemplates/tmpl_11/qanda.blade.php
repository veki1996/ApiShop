<div id="qanda">
    <div class="container grid-fullw center">
        <h3>
            {!!$staticContainers['s_text_static_390']->text!!}
        </h3>
        <p>
            {!!$staticContainers['s_text_static_382']->text!!}
        </p>
    </div>
    <div class="container grid-rew">
        <div>
        <h4>
            {!!$staticContainers['s_text_static_400']->text!!}
        </h4>
        <p>
            {!!$staticContainers['s_text_static_392']->text!!}
        </p>
        </div>
        <div>
        <h4>
            {!!$staticContainers['s_text_static_330']->text!!}
        </h4>
        <p>
            {!!$staticContainers['s_text_static_394']->text!!}
        </p>
        </div>
        <div>
        <h4>
            {!!$staticContainers['s_text_static_395']->text!!}
        </h4>
        <p>
            {!!$staticContainers['s_text_static_396']->text!!}
        </p>
        </div>
        <div>
        <h4>
            {!!$staticContainers['s_text_static_397']->text!!}
        </h4>
        <p>
            {!!$staticContainers['s_text_static_398']->text!!}
        </p>
        </div>
    </div>
    <div class="container ans grid-fullw">
        <p>
            {{$staticContainers['s_text_static_399']->text}}
        <a href="mailto:{{$email}}">
            {{$email}}
        </a>
        </p>
    </div>
</div>

<style>
    #qanda {
        max-width: 800px;
        margin: 0 auto;

        padding: 40px 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 32px;

        overflow: hidden;
        background-size: cover;
        background-position: 50%;
        -moz-background-position: cover;
        -o-background-position: cover;
    }

    #qanda div.container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 32px;

        max-width: 1000px;
        flex-shrink: 0;
        flex: 1;
        width: 100%;
    }

    #qanda div.container:first-child {
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    #qanda h3 {
        margin: 0;

        font-weight: 600;
        font-size: 24px;
        line-height: 32px;
        /* identical to box height, or 133% */

        text-align: center;

        color: #070707;
    }

    #qanda div.container > div {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 8px;
    }

    #qanda h4 {
        margin: 0;

        font-weight: 600;
        font-size: 16px;
        line-height: 19px;
        /* identical to box height */


        color: #070707;
    }

    #qanda p {
        margin: 0;

        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
        /* identical to box height */

        color: #070707;
    }

    #qanda .ans {
        border-top: 1px solid #D9D9D9;
    }

    #qanda .ans p {
        width: 100%;
        margin-top: 16px;

        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
        text-align: center;

        color: #070707;
    }

    #qanda .ans p a:link,
    #qanda .ans p a:visited {
        text-decoration: underline;
    }

    #qanda .ans p a:hover,
    #qanda .ans p a:active {
        text-decoration: none;
    }

    @media screen and (max-width: 768px) {
        #qanda div.container:first-child {
            margin-bottom: 0;
        }
</style>
