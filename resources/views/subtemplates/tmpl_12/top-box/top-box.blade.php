@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/top-box.css">
@endpush

<div class="top-box">
    <div class="top-box-left">
        @include('subtemplates.tmpl_12.top-box.top-box-title')
        <div class="top-box-vide-holder">
        @include('subtemplates.tmpl_12.top-box.top-box-video')
        </div>
    </div>
    <div class="top-box-right">
        @include('subtemplates.tmpl_12.top-box.top-box-texts')
    </div>

</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/shared/top-box.js"></script>
    <script src="{{ env('APP_URL') }}/js/products/top-box-li-style.js"></script>
@endpush



