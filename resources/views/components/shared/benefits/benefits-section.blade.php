@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/benefits.css">
@endpush

<div class="benefits-section-wrapper">
    <img src="{{ $staticImages['40:7']['Desktop'][0] ?? '' }}" class="desktop-benefits" alt="banner image">
    <img src="{{ $staticImages['40:7']['Mobile'][0] ?? '' }}" class="mobile-benefits" alt="banner image">
    <div class="benefits-images">
        @include('components.shared.benefit', ['icon' => 'delivery.png', 'benefitText' => ContentHelper::staticText('freeAndQuickDelivery') , 'customClass' => 'align' ])
        @include('components.shared.benefit', ['icon' => 'safe.png', 'benefitText' => ContentHelper::staticText('safeShopping')  , 'customClass' => 'align' ])
        @include('components.shared.benefit', ['icon' => 'pay.png', 'benefitText' => ContentHelper::staticText('safePayments')  , 'customClass' => 'align'])
    </div>
</div>
