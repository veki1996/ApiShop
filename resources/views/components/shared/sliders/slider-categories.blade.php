@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/sliders.css">
@endpush

<div class="slider-categories-wrapper">
    <center> @include('components.shared.titles-subtitles.global-title', ['slot' => ContentHelper::staticText('dearestPeople') ])</center>
    <center> @include('components.shared.titles-subtitles.subtitle', ['slot' => ContentHelper::staticText('giftFor') ])</center>
    @include('components.shared.sliders.slider')
</div>

@push('body-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{env('APP_URL')}}/js/categories/categories.js"></script>
@endpush

