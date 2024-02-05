@php
    use App\Entities\Product;
    
    /**
     * @var Product $product
     */
    use App\Helpers\ContentHelper;

@endphp

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/maa_tmpl_2b/top-box.css">
@endpush

<div class="product-top-box-section">
    @include('subtemplates.maa_tmpl_2b.top-box.product-image-box')
    @include('subtemplates.maa_tmpl_11.top-box.product-top-box-text')
</div>
