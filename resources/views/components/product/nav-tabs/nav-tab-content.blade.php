<div class="nav-tab-content-wrapper">
    <div class="description-tab-content nav-tab-content" data-tab="description">
        @if($productDescContainers)
        <div class="description-content">
            <h2>{!! $productDescContainers[0]['text'] !!}</h2>
            <p> {!! $productDescContainers[1]['text'] !!} </p>
            <h2>{!! $productDescContainers[2]['text'] !!}</h2>
            <p> {!! $productDescContainers[3]['text'] !!} </p>
            <h2>{!! $productDescContainers[4]['text'] !!}</h2>
            <p> {!! $productDescContainers[5]['text'] !!} </p>
        </div>
        @endif
    </div>
    <div class="additional-information-tab-content nav-tab-content" data-tab="additional-info">
        {!! App\Helpers\ContentHelper::dynamicContainers($product->shortSku, 'process|specifications_copy_1') !!}
    </div>
    <div class="reviews-tab-content nav-tab-content" data-tab="reviews">
        <div>
            @include('subtemplates.maa_tmpl_2b.reviews.review')
        </div>
    </div>
    <div class="shipping-return-tab-content nav-tab-content" data-tab="shipping_return">
        @if ($staticContainers)
        <div class="qa-content">
            <h2>{!! $staticContainers['s_text_static_400']->text !!}</h2>
            <p>{!! $staticContainers['s_text_static_392']->text !!}</p>
            <h2>{!! $staticContainers['s_text_static_330']->text !!}</h2>
            <p>{!! $staticContainers['s_text_static_394']->text !!}</p>
            <h2>{!! $staticContainers['s_text_static_395']->text !!}</h2>
            <p>{!! $staticContainers['s_text_static_396']->text !!}</p>
            <h2>{!! $staticContainers['s_text_static_397']->text !!}</h2>
            <p>{!! $staticContainers['s_text_static_415']->text !!}</p>
        </div>
        @endif
    </div>
</div>
