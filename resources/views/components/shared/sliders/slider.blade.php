<div id="splide" class="splide">
    <div class="splide__track">
        <div class="splide__list">
            @isset($nicheCategories )
            @foreach($nicheCategories as $category)
           @isset($category->id)
           <div class="splide__slide" >
            <img src="{{ $category -> icon }}" alt="Category: {{$category->name ?? ''}}">
            <div class="splide-overlay"></div>
            @include('components.shared.sliders.category-button')
            </div>
           @endisset
        @endforeach
            @endisset
        </div>
    </div>
</div>
