@push('head-css')
<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/categories/categories-rounded.css">
@endpush

<section id="splideRounded" class="splide" aria-label="Basic Structure Example">
    <div class="splide__track">
        <div class="splide__list">

            @foreach($mainCategories as $category)
            @isset($category->id)
            <div class="splide__slide">
                <div class="category-rounded">
                    <a href="{{ env('APP_URL') }}/shop?category={{ $category -> id }}">
                        <img src="{{ $category -> icon }}" alt="No image">
                    </a>
                    <h3>{{ $category->name }}</h3>
                </div>
            </div>
            @endisset
            @endforeach

        </div>
    </div>
</section>

@push('body-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="{{env('APP_URL')}}/js/categories/categories.js"></script>
@endpush