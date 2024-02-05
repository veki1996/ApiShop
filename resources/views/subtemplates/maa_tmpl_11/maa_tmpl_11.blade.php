@php
    use App\Helpers\ContentHelper;
    use App\Helpers\ProductHelper;
    $staticContainers = ContentHelper::staticContent();
    $productDescContainers = ProductHelper::getContainers($product->shortSku, '18');
    $productReviews = App\Helpers\ProductHelper::getContainers($product->shortSku, '56');
    $allContainers = ContentHelper::allContainers($product->shortSku);
@endphp

@push('head-css')
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/products.css">
@endpush

@include('subtemplates.maa_tmpl_11.top-box.top-box', compact('product'), [
    'sp' => true,
    'tmpl' => true,
    'propertiesData' => $propertiesData,
    'allContainers' => $allContainers,
])

@include('subtemplates.maa_tmpl_11.single-testimonial')
@include('subtemplates.maa_tmpl_11.characteristics-section')
@include('subtemplates.maa_tmpl_11.specs')
@include('subtemplates.maa_tmpl_11.swiper')
@include('subtemplates.maa_tmpl_11.package')
@include('subtemplates.maa_tmpl_11.survey')
@if (request()->has('flow') && request()->has('flow') == 'direct')
@include('subtemplates.maa_tmpl_2b.checkout-section.checkout-section')
@endif
@include('subtemplates.maa_tmpl_2b.reviews.review')
@include('subtemplates.maa_tmpl_11.gallery')
@include('subtemplates.maa_tmpl_11.faq')

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
