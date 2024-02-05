@push('head-css')
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/sliders.css">
@endpush
{{-- @include('components.shared.sliders.desktop-grid-for-grid-categories') --}}
@include('components.shared.sliders.mobile-slider-for-grid-categories')
@push('body-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{env('APP_URL')}}/js/categories/categories.js"></script>
@endpush