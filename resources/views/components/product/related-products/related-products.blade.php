@php use App\Helpers\ContentHelper; @endphp
@include('subtemplates.tmpl_new_alozzi.related-products.related-products-slider',  ['containers' => ContentHelper::imgTxtUsage($product->shortSku), 'text' => ContentHelper::staticText('productAsThis')])
