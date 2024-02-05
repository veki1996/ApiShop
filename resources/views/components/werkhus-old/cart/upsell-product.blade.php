@php use App\Helpers\ContentHelper; @endphp

<div class="upsell-product">
    <div class="top-row">
        <div class="image"><img src="{{env('APP_URL') . '/' . $product->mainImage}}"></div>
        <p style="font-size:20px"><b>{{$product->name}} @if($product->shortDescription)
                    - {{$product->shortDescription}}
                @endif</b></p>
        <p>{!! $product->longDescription !!}</p>
    </div>

    <div class="clr"></div>

    <div class="bottom-row">
        <div class="checkbox">
            <input class="up-checkbox" type="checkbox"
                   data-sku="{{$product->fullSku}}"
                   data-name="{{$product->name}}"
                   data-price="{{$product->prices['1x']}}"
                   data-price1x="{{$product->prices['1x']}}"
                   data-price2x="{{$product->prices['2x']}}"
                   data-price3x="{{$product->prices['3x']}}"
                   data-image="{{$product->mainImage}}"
            >
            <p class="up-checkbox-text">{{ContentHelper::staticText('addToCart') }}</p>
        </div>

        <div class="price">
            <p>
                <span class="upsell-double-price">{{$product->prices['1x'] * 2}} {{env('CURRENCY')}}</span>
                <span class="upsell-price">{{$product->prices['1x']}} {{env('CURRENCY')}}</span>
            </p>
        </div>
    </div>
</div>

@push('body-js')
    <script>
        $('.up-checkbox').on('change', e => {
            const checkbox = e.target

            const CHECKED_COLOR = 'rgb(232, 249, 234)'
            const UNCHECKED_COLOR = 'rgb(221, 221, 221)'

            const CHECKED_TEXT = '{{ContentHelper::staticText('addToCart') }}'
            const UNCHECKED_TEXT = '{{ContentHelper::staticText('added') }}'

            if (checkbox.checked) {
                $('.upsell-product').css('background-color', CHECKED_COLOR)
                $('.up-checkbox-text').text(UNCHECKED_TEXT)

                cart.addProduct({
                    sku: checkbox.dataset.sku,
                    name: checkbox.dataset.name,
                    price: Number(checkbox.dataset.price),
                    price_1x: Number(checkbox.dataset.price1x),
                    price_2x: Number(checkbox.dataset.price2x),
                    price_3x: Number(checkbox.dataset.price3x),
                    image: checkbox.dataset.image,
                    quantity: 1,
                    bundleProduct: 1,
                })
            }
            else {
                $('.upsell-product').css('background-color', UNCHECKED_COLOR)
                $('.up-checkbox-text').text(CHECKED_TEXT)

                cart.removeProduct(checkbox.dataset.sku)
            }
        })
    </script>
@endpush
