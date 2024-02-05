@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/images-section.css">
@endpush

<div class="images-section">
    @include('components.shared.titles-subtitles.global-title', ['slot' => ContentHelper::staticText('shineWithUs')  ])
    <div class="images-section-images">
        @if(isset($staticImages['1:1']['Desktop']))
            @foreach($staticImages['1:1']['Desktop'] as $staticImage)
                <img src="{{ $staticImage }}" alt="images of our products">
            @endforeach
        @endif
    </div>
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/shared/images-section.js"></script>
@endpush
