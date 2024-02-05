@php use App\Helpers\ContentHelper; 

    $specificationList = @ContentHelper::dynamicContainers($product->shortSku, 'process|specificationsList_copy_3')?? '';

@endphp

{!! $specificationList !!}

