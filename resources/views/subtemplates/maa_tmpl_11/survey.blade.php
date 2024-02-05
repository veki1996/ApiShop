<div class="bg-lightblue">
    <div id="survey">
        <div class="grid grid-fullW">
            <h3>{!! $staticContainers['s_text_static_382']->text !!}</h3>
            <img src="{{ $staticContainers['s_img_static_149']->text }}" alt="">
            <div class="sur">
                <div>
                    <h4>{!! $staticContainers['s_text_static_383']->text !!}</h4>
                    <div class="sur_res">
                        <div>a.{!! $staticContainers['s_text_static_384']->text !!}</div>
                        <div><b>234</b></div>
                    </div>
                    <div class="sur_res">
                        <div>b.{!! $staticContainers['s_text_static_385']->text !!}</div>
                        <div><b>214</b></div>
                    </div>
                    <div class="sur_res">
                        <div>c.{!! $staticContainers['s_text_static_386']->text !!}</div>
                        <div><b>197</b></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="grid grid-fullW">
            <div class="face-wr">
                <div class="face-item">
                    <div class="head">
                        <img src="{{ $staticContainers['s_img_static_155']->text }}" alt="">
                        <div>
                            <b>
                                TO
                            </b>
                            <br>
                            <span class="date">
                                &#10003;{!! $staticContainers['s_text_static_387']->text !!}
                            </span>
                        </div>
                    </div>
                    <p>
                        {!! $allContainers['s_text_var_64']->text !!}
                    </p>
                </div>
                <div class="face-item">
                    <div class="head">
                        <img src="{{ $staticContainers['s_img_static_156']->text }}" alt="">
                        <div>
                            <b>
                                MP
                            </b>
                            <br>
                            <span class="date">
                                &#10003;{!! $staticContainers['s_text_static_387']->text !!}
                            </span>
                        </div>
                    </div>
                    <p>
                        {!! $allContainers['s_text_var_65']->text !!}
                    </p>
                </div>
                <div class="face-item">
                    <div class="head">
                        <img src="{{ $staticContainers['s_img_static_157']->text }}" alt="">
                        <div>
                            <b>
                                PB
                            </b>
                            <br>
                            <span class="date">
                                &#10003;{!! $staticContainers['s_text_static_387']->text !!}
                            </span>
                        </div>
                    </div>
                    <p>
                        {!! $allContainers['s_text_var_66']->text !!}
                    </p>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<style>
  .bg-lightblue {
        background: #E4E4E4;
    }

    #survey {
        max-width: 1000px;
        margin: auto;
        text-align: center;
        padding-top: 30px;
        padding-bottom: 30px;
    }

    #survey .grid>h3 {
        font-size: 1.4em;
        margin-bottom: 20px;
        text-align: center;
    }

    #survey .sur h4 {
        margin-bottom: 15px;
        color: #22282f;
        line-height: 1;
        margin-bottom: 6px;
        margin-top: 6px;
        text-align: left;
    }


    #survey .grid>img {
        max-width: 130px;
        display: block;
        margin: 0 auto -50px;
    }

    #survey .sur {
        max-width: 450px;
        width: 100%;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        font-size: 14px;
    }

    #survey .sur_res {
        display: flex;
        margin-bottom: 5px;
        justify-content: space-between;
    }

    .grid-fullW {
        max-width: 1000px;
        flex-shrink: 0;
        flex: 1;
        width: 100%;
        background: #E4E4E4;
    }

    .face-wr {
        
        display: flex;
        margin: auto;
        margin-top: 20px;
      
        max-width: 450px;
        height: 100%;
        overflow-x: scroll !important;
       
    }

    .face-item {
        scroll-snap-align: center;
        flex-shrink: 0;
        font-size: 14px;
        flex-direction: column;
        background-color: #fff;
        border-radius: 8px;
        padding: 30px;
        width: 85%;
        height: -webkit-fit-content;
        height: -moz-fit-content;
        height: fit-content;
        pointer-events: none;
        max-height: -moz-max-content;
        text-align: left;
        
    }

    .face-item,
    .face-item .head {
        display: flex;
    }

    .face-item {
        margin-left: 2.5%;
        margin-right: 2.5%;
    }


    .face-item,
    .face-item .head {
        display: flex;
    }

    .face-item .comment img,
    .face-item .head img {
        width: 30px;
        height: 30px;
        -o-object-fit: cover;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 10px;
        box-shadow: 0 10px 10px -5px rgb(51 51 85 / 21%);
    }

    .face-item .head .date {
        display: flex;
        align-items: center;
        font-size: 11px;
        margin-top: 3px;
        color: #b0b0b0;
    }

    .face-item p {
        font-size: 16px;
        margin-top: 20px;
        position: relative;
    }

  
</style>
