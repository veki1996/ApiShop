@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_2b/reviews.css">
@endpush

{{-- @include('subtemplates.maa_tmpl_2b.reviews.title') --}}

<div class="review-section">
    @php
        $reviewTexts = array_values(array_filter($productReviews, function($el) { return $el['type'] === 'text';}));
        $reviewImages = array_values(array_filter($productReviews, function($el) { return $el['type'] === 'image';}));
    @endphp

    @for($i = 0; $i < count($reviewImages); $i++)
        {!! $i % 2 === 0 ? '<div class="review-row">' : '' !!}
        <div class="review-col">
            <img id="review-main-img" src="{{ strpos($reviewImages[$i]['text'], 'ourshopcdn') !== false ? $reviewImages[$i]['text'] : env('APP_URL') . '/' . $reviewImages[$i]['text'] }}">
            <div class="review-col-content">

                <div class="review-name">
                    <img src="{{ strpos($reviewImages[$i]['text'], 'ourshopcdn') !== false ? $reviewImages[$i]['text'] : env('APP_URL') . '/' . $reviewImages[$i]['text'] }}">
                    <h3>{{ chr(rand(65,86)) . '.' . chr(rand(65,86)) }}</h3>
                </div>
                <div class="review-stars">
                    <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                    <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                    <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                    <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                    <img src="{{ env('APP_URL') }}/static/grade.png" alt="star for rating">
                </div>
                <p> {!! explode('(##)', $reviewTexts[$i]['text'])[1] ?? explode('(##)', $reviewTexts[$i]['text'])[0] !!} </p>
            </div>
        </div>
        {!! $i % 2 === 1 ? '</div>' : '' !!}
    @endfor
</div>

