@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/unique.css">
@endpush

<div class="unique-box">
    @include('subtemplates.tmpl_12.unique-box.unique-box-title')
    <div class="unique-box-products">
        @include('subtemplates.tmpl_12.unique-box.unique-product-1')
        @include('subtemplates.tmpl_12.unique-box.unique-product-2')
    </div>  
</div>    

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/shared/unique-li-elements.js"></script>
@endpush
