@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/slider/slider.css">
@endpush
@php use App\Helpers\ContentHelper; @endphp

<div class="slider-wrapper">
    <div class="slider-container">
        @if(isset($staticImages['16:9']['Desktop']))
            @foreach($staticImages['16:9']['Desktop'] as $index => $img)
                <div class="slide">
                    <img src="{{ $img }}" alt="" data-mobile="{{ $staticImages['16:9']['Mobile'][$index] ?? '' }}">
                </div>
            @endforeach
        @endif
    </div>

    <div class="slider-content">
       <div class="slider-texts-container">
        <h1 class="slider-text">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_main_slider_text1')}}</h1>
        <h2 class="slider-second-text">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_small_slider_text1')}}</h2>
       </div>
        <a class="slider-btn" href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}">{{\App\Helpers\ContentHelper::staticText('shop') }}
            <img src="{{ env('APP_URL') }}/static/double_arrow_white.png" alt="arrow">
        </a>
    </div>

    <div class="dots">
        @if(isset($staticImages['16:9']['Desktop']))
            @foreach($staticImages['16:9']['Desktop']  as $index => $img)
                <div class="dot @if($index === 0) dot-active @endif"></div>
            @endforeach
        @endif
    </div>
</div>

@push('body-js')
    <script>
        const sliderTexts = @json([
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_main_slider_text1'))),
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_main_slider_text2'))),
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_main_slider_text3')))
    ]);

        const sliderSecondTexts = @json([
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_small_slider_text1'))),
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_small_slider_text2'))),
        ContentHelper::staticText(htmlspecialchars_decode(strtolower(env('BRAND_NAME') . '_small_slider_text3')))
    ]);

    </script>
    <script src="{{ env('APP_URL') }}/js/slider/slider.js"></script>
@endpush
