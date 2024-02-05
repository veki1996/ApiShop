
@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/subtitle.css">
@endpush

<div class="global-subtitle">
    <div class="subtitle-line"></div>
    <p>{{ $slot }}</p>
    <div class="subtitle-line"></div>
</div>
