@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/banners/gift-banner.css">
@endpush

<div class="gift-banner">
    <img src="{{ $staticImages['4:1']['Desktop'][0] ?? '' }}" class="poklon-desktop" alt="banner image">
    <img src="{{ $staticImages['4:1']['Mobile'][0] ?? '' }}" class="poklon-mobile" alt="banner image">
    <div class="gift-banner-text">
        <h2>{{ContentHelper::staticText('perfectGift') }}</h2>
        <p>{{ContentHelper::staticText('memorableMoments')  }}</p>
    </div>
</div>
