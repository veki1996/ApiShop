@php
use App\Entities\Product;
use App\Helpers\ContentHelper;
$price_01 = 2;
/**
* @var Product $product
*/

$productReviews = App\Helpers\ProductHelper::getContainers($product->shortSku, '56');
@endphp
@push('head-css')
<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/products.css">
@endpush

@include('subtemplates.maa_tmpl_2b.top-box.top-box', compact('product'), ['sp' => true, 'propertiesData' => $propertiesData])
@include('subtemplates.maa_tmpl_2b.img-txt.grid', ['containers' => ContentHelper::imgTxt($product->shortSku)])
@if (request()->has('flow') && request()->has('flow') == 'direct')
@include('subtemplates.maa_tmpl_2b.checkout-section.checkout-section')
@endif
@include('subtemplates.maa_tmpl_2b.reviews.review-slider')

@push('body-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="{{ env('APP_URL') }}/js/categories/categories.js"></script>
<script>
    const days = '{{ContentHelper::staticText('days')}}';
    const standard = '{{ContentHelper::staticText('typeStandard')}}';
    const fast = '{{ContentHelper::staticText('priority')}}';
    const priorityCost = '{{round(($feeHelper->priorityDeliveryCost()),2)}}';
</script>
@endpush
