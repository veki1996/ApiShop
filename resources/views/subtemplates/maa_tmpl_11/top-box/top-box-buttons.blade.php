
@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/buttons/top-box-buttons.css">
@endpush

@php
    // rounding
    $numOfDecimals = ["HU" => 0, "PL" => 0, "CZ" => 0, "RO" => 0, "BG" => 0, "RS" => 0, "BA" => 0];
@endphp
<div class="wrapper-bounce">
    <div class="pr btn2">
        <div class="current">{{round($product->prices->forOne, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}
        </div>
        <div class="del">{{round($product->prices->undiscounted, $numOfDecimals[env('COUNTRY_CODE')] ?? 2)}}{{env('CURRENCY')}}
        </div>
    </div>
    @include(
            'components.shared.buttons.add-to-cart',
            [
                'product' => $product,
                'id'      => uniqid('add-to-cart-'),
                'icon' => 'add-to-cart'
            ]
    )
</div>