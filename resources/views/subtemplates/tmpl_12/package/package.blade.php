@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/package.css">
@endpush
<div class="package-section-holder">
    <div class="package-section">
        <div class="package-img">
            @include('subtemplates.tmpl_12.package.package-img')
        </div>
        <div class="package-text">
            @include('subtemplates.tmpl_12.package.package-title')
            @include('subtemplates.tmpl_12.package.package-items')
            @include('subtemplates.tmpl_12.package.package-prices')
            @include('subtemplates.tmpl_12.top-box.top-box-books')
            @include('subtemplates.tmpl_12.package.package-benefits')
        </div>
    </div>
</div>
@push('body-js')
    <script src="{{ env('APP_URL') }}/js/products/package.js"></script>
@endpush




