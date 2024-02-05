
<div class="product-box-image">
    <a aria-label="Read more about {{ $product->name}} - {{ $product->realName }}" href="{{ env('APP_URL') }}/{{ $link }}{{ \App\Helpers\RouteHelper::appendParameters() }}{{ request()->getQueryString() ? '&' : '' }}{{ $product->utm_pod ? 'utm_pod=' . $product->utm_pod : '' }}"><img alt="{!! $product->shortDescription !!}" src="{{$image}}"></a>
</div>
