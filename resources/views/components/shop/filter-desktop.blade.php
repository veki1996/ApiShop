@php
    use App\Helpers\ContentHelper;
@endphp
<div class="filter-category">

    @if (env('IS_NICHE'))

        <div class="product-type">
            <h3>{{ ContentHelper::staticText('giftFor') }}</h3> <img src="{{ env('APP_URL') }}/static/down-arrow.png">
        </div>

        <div class="categories-filter">
            @isset($nicheCategories)
                @foreach ($nicheCategories as $category)
                    @isset($category->id)
                        @if (isset($category->child_categories) && !empty($category->child_categories))
                            <div class="parent-category  filter-parent">
                                <div class="parent-name  filter-name">
                                    <a> {!! $category->name !!}</a>
                                    <div><img src="{{ env('APP_URL') }}/static/footer-arrow.png" class="dropdown-arrow"
                                            alt="arrow for dropdown" srcset="">
                                    </div>
                                </div>
                                <div class="child-categories">
                                    @foreach ($category->child_categories as $key => $item)

                                    <label>
                                        <input class="chip" type="checkbox" name="category" data-category-id="{{ $item['id'] }}">
                                        <span data-category-name="{{ $item['name'] }}">{!! $item['name'] !!}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <label>
                                <input class="chip" type="checkbox" name="category" data-category-id="{{ $category->id }}">
                                <span data-category-name="{{ $category->name }}">{!! $category->name !!}</span>
                            </label>
                        @endif
                    @endisset
                @endforeach
            @endisset
        </div>

    @endif

    <div class="product-type">
        <h3>{{ ContentHelper::staticText('categories') }}</h3>
        <img id="toggleCategories" src="{{ env('APP_URL') }}/static/down-arrow.png">
    </div>

    <div class="categories-filter">
        @isset($mainCategories)
            @foreach ($mainCategories as $category)
                @isset($category->id)
                    <label>
                        <input class="chip" type="checkbox" name="category" data-category-id="{{ $category->id }}">
                        <span data-category-name="{{ $category->name }}">{!! $category->name !!}</span>
                    </label>
                @endisset
            @endforeach
        @endisset
    </div>
</div>
