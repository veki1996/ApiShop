@php use App\Helpers\ContentHelper; @endphp
<a class="to-checkout buy-now buy-now sm-s-text {{ $customClass ?? '' }}"
     @if(isset($product))
         data-sku="{{$product->longSku}}"
     @endif
>
    <p>{{ $text ?? '' }}</p>
    <img src="{{env('APP_URL')}}/static/{{$icon}}.png" alt="">
</a>

@push('body-js')
{{--   <script src="{{ env('APP_URL') }}/js/buttons/go-to-checkout.js"></script>--}}
<script>
        window.addEventListener("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 200);
});</script>
@endpush