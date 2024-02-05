@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;

    /**
    * @var Product $product
    */
@endphp

<div class="add-to-cart {{ $customClass ?? '' }}"
     data-sku="{{$product->longSku}}"
     data-name="{{$product->name}}"
     data-long-name="{{ $product -> longName }}"
     data-price="{{$product->prices->forOne}}"
     data-priceupsell="{{$product->prices->upsell}}"
     data-price1x="{{$product->prices->forOne}}"
     data-price2x="{{$product->prices->forTwo}}"
     data-price3x="{{$product->prices->forThree}}"
     data-currency="{{env('CURRENCY')}}"
     data-image="{{$product->image}}"
     data-quantity="1"
     data-delivery="{{$product->deliveryDate}}"
     data-realName="{{$product->realName}}"
>
    <p>{{ContentHelper::staticText('addToCart') }}</p>
    <img src="{{env('APP_URL')}}/static/{{$icon}}.png" alt="">
</div>

