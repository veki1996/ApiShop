@php use App\Helpers\ContentHelper; 

    $specificationList = @ContentHelper::dynamicContainers($product->shortSku, 'process|specificationsList')?? '';

@endphp

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/package.css">
@endpush


<div class="package-section">
    <div class="package-content">
        <div class="package-title">
            <h1> {!! $staticContainers['s_text_static_381']->text ?? '' !!} </h1>
        </div>
        <div class="package-image">
            <img src="{!! $allContainers['s_img_var_63']->text ?? '' !!}">
        </div>
        <div class="package-text">
            {!! trim(ContentHelper::dynamicContainers($product->shortSku, 'process|specificationsList')) ?? '' !!}
        </div>
    </div>
</div>



