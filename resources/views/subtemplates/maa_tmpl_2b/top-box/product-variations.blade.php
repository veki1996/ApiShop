@php use App\Helpers\ContentHelper; @endphp

@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/product-variations.css">
@endpush
<div class="selectorBox">

        @for($i = 1; $i <= 3; $i++)
            <div class="mainSelector product-variation-{{$i}}" data-quantity="{{$i}}"
                style="display: {{$i <= 1 ? 'block' : 'none'}}"
            >
            <h4>{{ContentHelper::staticText('product') . ' ' . $i}}</h4>
                <div id="product-text-div-{{$i}}" class="c087 product-text-div"
                    style="display: none">
                    <span class="product_text">
                        {{ContentHelper::staticText('product')}}
                        <span class="productNumber" style="display:inline-block">{{$i}}</span>
                    </span>
                </div>


                @foreach($propertiesData['properties'] as $propertyId => $propertyName)
                    <div class="c088 property-select-div">
                        <div class="c087">
                            <span>{{$propertyName}}:</span>
                            <span class="select_property">{{ContentHelper::staticText('selectProperties')}}</span>
                        </div>
                        <div class="c051 is-large">
                            <div class="color-selector">

                                @foreach($propertiesData['variations'] as $variationId => $variationData)
                                    @if($variationData['property'] === $propertyId)
                                        <button  class="color-item color_1 invalid_prop" data-property-id="{{$propertyId}}"
                                            data-variation-id="{{$variationId}}" >
                                            <span class="variationVal">{{$variationData['name']}}</span>
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                            <p class="outOfStock">{{ContentHelper::staticText('OutOfStock')}}</p>
                        </div>
                    </div>

                    <div class="c003"></div>
                @endforeach
            </div>
        @endfor
</div>

@push('body-js')
  <script>
        let combinations = JSON.parse('{!!json_encode(array_values($propertiesData['combinations']))!!}')
        let productVariations = JSON.parse('{!!json_encode($propertiesData['variations'])!!}')
        let selectedCombinations = [];
        let hasCombinations = !jQuery.isEmptyObject(combinations);
        // let selectedVariations = [];
  </script>
  <script src="{{ env('APP_URL') }}/js/product-variations.js"></script>
@endpush
