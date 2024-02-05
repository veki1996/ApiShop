@php
    use App\Entities\Product;

    /**
    * @var Product $product
    */

@endphp
@php use App\Helpers\ContentHelper; @endphp
<div class="ws-frilla-main-wrapper">
    <div id="side-categories" class="side-categories-line">
        <p class="side-categories-title">{{ContentHelper::staticText('categories') }}  <img src="{{env('APP_URL')}}/static/close.png" class="closeBtnCategories"></p>
        <div class="stretch">
            <ul class="side-categories-items">
                @foreach($categories as $id => $category)
                    <li class="order_sorting" data-id="{{$id}}"><div class="categoryIcon"><img src="{{$category->icon}}"></div>{{$category->name}}</li>
                    {{--$category->icon, if not null, contains link to icon image--}}
                @endforeach
            </ul>
            <div class="cartFooter">
                @include(
            'components.shared.footer.help-links',
            [
                'helpLinks' => [
                    [
                        'link' => route('page.tos', ['link' => 'terms_and_conditions']) . "?" . $tosLinks['terms_and_conditions']['params'],
                        'text' => ContentHelper::staticText('tos')
                    ],
                    [
                        'link' => route('page.tos', ['link' => 'privacy_policy']) . "?" . $tosLinks['privacy_policy']['params'],
                        'text' => ContentHelper::staticText('privacyPolicy')
                    ],
                    [
                        'link' => route('page.tos', ['link' => 'cookie_policy']) . "?" . $tosLinks['cookie_policy']['params'],
                        'text' => ContentHelper::staticText('cookiePolicy')
                    ],
                    [
                        'link' => route('page.tos', ['link' => 'frequently_asked_questions']) . "?" . $tosLinks['frequently_asked_questions']['params'],
                        'text' => ContentHelper::staticText('faq')
                    ],
                    [
                        'link' => route('page.tos', ['link' => 'customer_support']) . "?" . $tosLinks['customer_support']['params'],
                        'text' => ContentHelper::staticText('customerSupport')
                    ],
                ]
            ]
        )
            </div>
        </div>
    </div>
    <div class="category-grid">
        <div class="categoryName">{{($categoryName)}}</div>
        @php shuffle($products) @endphp
        @foreach(array_chunk($products, true) as $productsChunk)
            <div class="centerH">
                    @foreach($productsChunk as $product)
                        @include(
                            'components.shared.category-product-box',
                            [
                                'name'     => $product->name,
                                'title'    => $product->longName,
                                'sku'      => $product->shortSku,
                                'image'    => $product->image,
                                'oldPrice' => $product->prices->undiscounted . ' ' . env('CURRENCY'),
                                'newPrice' => $product->prices->forOne . ' ' . env('CURRENCY'),
                                'link'     => $product->pageLink,
                               
                            ]
                        )
                    @endforeach
            </div>
        @endforeach
    </div>    
</div>
<div class="ws-frilla-main-wrapper">
    <div class="titleMar">
        <div class="filters">{{ContentHelper::staticText('seeMoreProducts')}}</div>
    </div>
    <div class="scrolling-wrapper">
        @php shuffle($products) @endphp
        @foreach(array_chunk($products, true) as $productsChunk)
            <div >
                    @foreach($productsChunk as $product)
                        @include(
                            'components.index.product-box',
                            [
                                'name'     => $product->name,
                                'title'    => $product->longName,
                                'sku'      => $product->shortSku,
                                'image'    => $product->image,
                                'oldPrice' => $product->prices->undiscounted . ' ' . env('CURRENCY'),
                                'newPrice' => $product->prices->forOne . ' ' . env('CURRENCY'),
                                'link'     => $product->pageLink,
                               
                            ]
                        )
                    @endforeach
            </div>
        @endforeach
    </div>
</div>    
<div class="bottomHeight"></div>

<style>
    .category-grid{
        display: flex;
        flex-direction: column;
        gap: 30px;
        padding: 16px;   
        /* align-items: center; */
        }
    .bottomHeight{
        height:55px;
    }
    .titleMar{
        margin-top:20px;
    }
    .categoryPage #side-categories{
        display:none;
    }
    @media screen and (min-width: 767px) {
    .category-grid {
        padding-left: 140px;
    }
</style>