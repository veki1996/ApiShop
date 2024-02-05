@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/nav-tabs.css">
@endpush

<div class="navigation-tabs">
    @include('components.product.nav-tabs.nav-tab-items')
    @include('components.product.nav-tabs.nav-tab-content')
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/products/nav-tabs.js"></script>
@endpush
