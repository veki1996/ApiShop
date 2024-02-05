<div class="t11-order-form-box parent column v-center h-center pdn-top-large pdn-bottom-large bg-blue" id="the-order-form">
    <div class="t11-wrapper parent column select-qt">
        <h3><!-- static|s_text_static_389 --></h3>
        <div class="guarantee-badge">
        <img src="<!-- static|s_img_static_154 -->" alt="">
        <div>
            <h4>
                {{$staticContainers['s_text_static_224']->text}}
            </h4>
            <div>
                {{$staticContainers['s_text_static_388']->text}}
            </div>
        </div>
        </div>
        <div class="t11-quantity parent column bg-color-secondary">
        <div class="t11-select parent row pdn-top-medium c048">
            <div class="selector-holder parent column c049">
                <!-- PROCESS SELECTOR CONTAINER START -->
                @include(
                    'subtemplates.tmpl_11.selector',
                    [
                        'price_1x'     => $product->prices->forOne,
                        'price_2x'     => $product->prices->forTwo,
                        'price_3x'     => $product->prices->forThree,
                        'postage'      => $feeHelper->postageCost(),
                        'currency'     => env('CURRENCY'),
                        'cCode'        => env('COUNTRY_CODE'),
                        'pSku'         => $product->shortSku,
                    ]
                )
                <!-- PROCESS SELECTOR CONTAINER END  -->
            </div>
        </div>
        </div>
        <div class="prev-image-wr window-plus">
        <img src="<!-- container|s_img_var_32 -->" alt="" class="prew-image">
        </div>
        <div class="t11-order-form parent row wrap">
        <div class="t11-order-form-item parent column pdn-medium">
            <!-- ORDER FORM -->
            @include('components.checkout.form.form')
        </div>
        </div>
    </div>
</div>
