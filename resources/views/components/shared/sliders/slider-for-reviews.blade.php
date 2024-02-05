@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_2b/reviews.css">
@endpush

@php
    $reviewTexts = array_values(array_filter($productReviews, function($el) { return $el['type'] === 'text';}));
    $reviewImages = array_values(array_filter($productReviews, function($el) { return $el['type'] === 'image';}));
@endphp

<div id="splideReviews" class="splide">
    <div class="splide__track">
        <div class="splide__list">

            @for($i = 0; $i < count($reviewImages); $i++)
                <div class="splide__slide">
                    <div class="review-box">
                        <img id="main-img" src="{{ strpos($reviewImages[$i]['text'], 'ourshopcdn') !== false ? $reviewImages[$i]['text'] : env('APP_URL') . '/' . $reviewImages[$i]['text'] }}">
                        <p> {!! explode('(##)', $reviewTexts[$i]['text'])[1] ?? explode('(##)', $reviewTexts[$i]['text'])[0] !!} </p>
                       <div class="rating-name-reviews">
                        <div class="review-stars">
                            <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                            <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                            <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                            <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                            <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                        </div>
                        <div class="review-name">
                            <img src="{{ strpos($reviewImages[$i]['text'], 'ourshopcdn') !== false ? $reviewImages[$i]['text'] : env('APP_URL') . '/' . $reviewImages[$i]['text'] }}">
                            <h3>{{ chr(rand(65,86)) . '.' . chr(rand(65,86)) }}</h3>
                        </div>
                       </div>

                    </div>
                </div>
            @endfor

        </div>
    </div>
</div>
