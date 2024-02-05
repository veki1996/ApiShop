@php use App\Helpers\ContentHelper; @endphp
<div class="to-checkout buy-now {{ $customClass ?? '' }}"
     @if(isset($product))
         data-sku="{{$product->longSku}}"
     @endif
>
    <p>{{ $text ?? '' }}</p>
    <img src="{{env('APP_URL')}}/static/{{$icon}}.png" alt="">
</div>

@push('body-js')
{{--   <script src="{{ env('APP_URL') }}/js/buttons/go-to-checkout.js"></script>--}}
@endpush
