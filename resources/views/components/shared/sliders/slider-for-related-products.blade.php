<div id="splideRelated" class="splide {{$customClass ?? ''}}">
    <div class="splide__track">
        <div class="splide__list">
            @foreach ($similarProducts as $product)
                <div class="splide__slide">
                    @include('components.shared.products.product-box', [
                        'name' => $product->name,
                        'title' => $product->shortDescription,
                        'sku' => $product->shortSku,
                        'image' => $product->image,
                        'oldPrice' => $product->prices->undiscounted . ' ' . env('CURRENCY'),
                        'newPrice' => $product->prices->forOne . ' ' . env('CURRENCY'),
                        'link' => $product->pageLink,
                        
                        'customClass' => 'full-size',
                    ])
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    /* .splide__slide .add-to-cart-products{
        border: 1px solid #323232;
    background: #fefefe;
    color: #323232;
    font-family: 'Didact Gothic';
    margin-bottom: 8px;
    }
    .splide__slide  .add-to-cart-products img {
        filter: brightness(0)
    } */
</style>