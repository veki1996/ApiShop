@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;
    // $allContainers    = ContentHelper::allContainers($product->shortSku);
    // $staticContainers = ContentHelper::staticContent();
    // $specCopy1        = ContentHelper::dynamicContainers($product->shortSku, 'process|specifications_copy_1');
@endphp

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/modals/add-to-cart-modal.css">
@endpush

<div class="addedToCartPopp">
    <img alt="icon for close popUp" src="{{ env('APP_URL') }}/static/close.png" class="closeBtnPop">
    @include('components.shared.modals.add-to-cart-modal.message')
    <div class="popupBtns col centerV centerH">
        @include('components.shared.modals.add-to-cart-modal.go-to-cart')
        @include('components.shared.modals.add-to-cart-modal.continue-shoping')
        @if (!empty($product->complementaryProducts))
            {{-- @include('subtemplates.tmpl_11.complementary-box') --}}
        @endif
    </div>
</div>
@push('body-js')
<script src="{{ env('APP_URL') }}/js/modals/add-to-cart-modal.js"></script>
@endpush
