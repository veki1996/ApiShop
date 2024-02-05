<div class="categories-dropdown {{ $customClass ?? '' }}" style="display: none;">
    <div class="categories-container-dropdown">
        @if ($categories)
            @foreach ($categories as $category)
                @isset($category->id)
                    
                        @if (isset($category->child_categories) && !empty($category->child_categories))
                            <div class="parent-category">
                                <div class="parent-name">
                                    <a> {!! $category->name !!}</a>
                                    <div><img src="{{ env('APP_URL') }}/static/footer-arrow.png" class="dropdown-arrow" alt="arrow for dropdown"
                                            srcset="">
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
                        <div class="category-dropdown category-dropdown-container">
                            <a href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}"
                                data-id="{{ $category->id }}" class="shop_category">
                                {!! $category->name !!}
                            </a>
                        </div>
                        @endif


                  
                @endisset
            @endforeach
        @endif
    </div>
</div>
