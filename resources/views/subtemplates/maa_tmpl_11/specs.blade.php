@php
    use App\Helpers\ContentHelper;
@endphp

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/maa_tmpl_11/specs.css">
@endpush

<div class="specs-section">
    <div class="specs-dropdown">
        <div class="dropdown-title">
            <p>{{ContentHelper::staticText('specifications')}}</p> <img src="{{ env('APP_URL') }}/static/footer-arrow.png" alt="">
        </div>
        <div class="specs-content">
            {!! ContentHelper::dynamicContainers($product->shortSku, 'process|specifications_copy_1') !!}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
  $(".dropdown-title").click(function() {
    $(this).find('img').toggleClass("rotate");
    $(this).siblings(".specs-content").slideToggle();
  });
});
</script>