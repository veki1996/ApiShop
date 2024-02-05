@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/waranty.css">
@endpush

<div class="waranty-section">
    @include('subtemplates.tmpl_12.waranty-box.waranty-title')
    <div class="waranty-box">
        @include('subtemplates.tmpl_12.waranty-box.waranty-img')
        @include('subtemplates.tmpl_12.waranty-box.waranty-text')
    </div>
</div>