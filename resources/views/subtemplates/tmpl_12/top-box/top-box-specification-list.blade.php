@php 
use App\Helpers\ContentHelper; 
use App\Helpers\ProductHelper;

    $specificationListTopBox = @ContentHelper::dynamicContainers($product->shortSku, 'process|specificationsList')?? '';
    $specList = App\Helpers\ProductHelper::getContainers($product->shortSku, '78');
    $specText = array_values(array_filter($specList, function($el) { return $el['type'] === 'text';}));

@endphp

<ul class="top-box-ul">
    @foreach($specText as $specItem)
        <li>
            {{$specItem['text']}}
        </li>
     @endforeach
</ul>


