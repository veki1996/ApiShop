@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/categories-burger/categories-burger.css">
@endpush
<div class='burger-overlay' style="display: none;"></div>
<div class="categories-burger" style="display: none;">
    <div class="filter-category block">
        <div class="close-sidebar-burger"> ✕</div>
        @if (env('IS_NICHE'))
            <div class="product-type-burger">
                <h3>{{ ContentHelper::staticText('giftFor') }}</h3>
            </div>

            <div class="categories-filter-burger">
                @isset($nicheCategories)
                    @foreach ($nicheCategories as $category)
                        @isset($category->id)
                            @if (isset($category->child_categories) && !empty($category->child_categories) )
                                <div class="parent-category burger">
                                    <div class="parent-name burger-name">
                                        <a> {!! $category->name !!}</a>
                                        <div><img src="{{ env('APP_URL') }}/static/footer-arrow.png" class="dropdown-arrow"
                                                alt="arrow for dropdown" srcset="">
                                        </div>
                                    </div>
                                    <div class="child-categories">
                                        @foreach ($category->child_categories as $key => $item)
                                            <a href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}"
                                                data-id="{{ $item['id'] }}" class="child_category">
                                                {!! $item['name'] !!}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <label>
                                    <span data-category-name="{{ $category->name }}">
                                        <a href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}"
                                            data-id="{{ $category->id }}" class="shop_category">
                                            {!! $category->name !!}
                                        </a>
                                    </span>
                                </label>
                            @endif
                        @endisset
                    @endforeach
                @endisset
            </div>
        @endif

        <div class="product-type-burger">
            <h3>{{ ContentHelper::staticText('categories') }}</h3>
        </div>

        <div class="categories-filter-burger">
            @isset($mainCategories)
                @foreach ($mainCategories as $category)
                    @isset($category->id)
                        <label>
                            <span data-category-name="{{ $category->name }}">
                                <a href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}"
                                    data-id="{{ $category->id }}" class="shop_category">
                                    {!! $category->name !!}
                                </a>
                            </span>
                        </label>
                    @endisset
                @endforeach
            @endisset
        </div>
        <a href='{{ env('APP_URL') }}/about{{ \App\Helpers\RouteHelper::appendParameters() }}'
            class="burger-about">{{ App\Helpers\ContentHelper::staticText('about') }}</a>
    </div>
</div>
