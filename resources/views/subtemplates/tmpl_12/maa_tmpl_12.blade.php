@php
    use App\Helpers\ContentHelper;
    use App\Helpers\ProductHelper;
    $staticContainers = ContentHelper::staticContent();
    $productDescContainers = ProductHelper::getContainers($product->shortSku, '18');
    $productReviews = App\Helpers\ProductHelper::getContainers($product->shortSku, '56');
    $allContainers = ContentHelper::allContainers($product->shortSku);
@endphp

@include('subtemplates.tmpl_12.top-box.top-box')
@include('subtemplates.tmpl_12.waranty-box.waranty')
@include('subtemplates.tmpl_12.advantage-box.advantage')
@include('subtemplates.tmpl_12.unique-box.unique')
@include('subtemplates.tmpl_12.grades-box.grades')
@include('subtemplates.tmpl_12.reviews.review')
@include('subtemplates.tmpl_12.package.package')
@if (request()->has('flow') && request()->has('flow') == 'direct')
@include('subtemplates.maa_tmpl_2b.checkout-section.checkout-section')
@endif

<script>
        const days = '{{ContentHelper::staticText('days')}}';
        const standard = '{{ContentHelper::staticText('typeStandard')}}';
        const fast = '{{ContentHelper::staticText('priority')}}';
        const priorityCost = '{{round(($feeHelper->priorityDeliveryCost()),2)}}';
</script>

