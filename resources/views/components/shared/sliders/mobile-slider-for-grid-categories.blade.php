@php use App\Helpers\ContentHelper; @endphp
<div class="categories-slider">
    <div id="splide2" class="splide">
        <div class="splide__track">
            <div class="splide__list">
                @isset($mainCategories)
                @foreach ($mainCategories as $category)
                @isset($category->id)
                <div class="splide__slide item-categ">
                    <a href="{{ route('page.shop') }}" data-id="{{$category->id}}" class="shop_category">
                        <img src="{{$category->icon}}" alt="Category image: {!! $category->name !!}">
                        {{-- <div class="splide-overlay"></div> --}}
                        <h2>{!! $category->name !!}</h2>
                    </a>
                </div>
                @endisset
                @endforeach
                @endisset
            </div>
        </div>
    </div>
</div>
