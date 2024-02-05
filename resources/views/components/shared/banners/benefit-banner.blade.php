@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/banners/benefit-banner.css">
@endpush

<div class="benefit-banner-container">
    <img class="benefit-banner-background" src="{{ $staticImages['4:1']['Desktop'][1] ?? '' }}">
    <h1>{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_banner_header')}}</h1>
    <div class="benefits-banner-items">
        @include('components.shared.benefit', ['icon' => 'benefit4.png', 'benefitText' => ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit4')])
        @include('components.shared.benefit', ['icon' => 'benefit5.png', 'benefitText' => ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit5')])
         @include('components.shared.benefit', ['icon' => 'benefit6.png', 'benefitText' => ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit6')])
        @include('components.shared.benefit', ['icon' => 'benefit7.png', 'benefitText' => ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit7')])
        @include('components.shared.benefit', ['icon' => 'benefit8.png', 'benefitText' =>  ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit8')])
        @include('components.shared.benefit', ['icon' => 'benefit9.png', 'benefitText' =>  ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_benefit9')])
    </div>
</div>