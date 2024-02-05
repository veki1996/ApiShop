@php
use App\Helpers\ContentHelper;
use App\Helpers\ProductHelper;
$staticContainers = ContentHelper::staticContent();
$productDescContainers = ProductHelper::getContainers($product->shortSku, '18');
$productReviews = App\Helpers\ProductHelper::getContainers($product->shortSku, '56');
@endphp

@include(
'subtemplates.maa_tmpl_2b.top-box.top-box',
compact('product'),
['sp' => false, 'propertiesData' => $propertiesData]
)

@include('components.product.nav-tabs.nav-tabs')
@include('components.product.related-products.related-products')
@include('components.shared.benefits.benefits-section')
