@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/gallery.css">  

@endpush
<div id="gallery">
    <h3>
        {!!$staticContainers['s_text_static_391']->text ?? '' !!}
    </h3>
    <div class="container grid-gall">
        {!! ContentHelper::dynamicContainers($product->shortSku, 'process|gallery') ?? '' !!}
    </div>
</div>

<style>
  
</style>
