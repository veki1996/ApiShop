<div class="product-image fotorama-image">

    @if ($sp)
        @if (isset($tmpl) &&  $tmpl === true)
        <div class="product-video">
            {!!$allContainers['s_vid_var_0']->text!!}
        </div>
        @else
        <div class="product-image">
            <img src="{{$product->image}}" alt="product image">
        </div>
        @endif
        
    @else
        <div class="fotorama" data-nav="thumbs" data-thumbwidth="100">
            @if (empty($product->favouriteImages))
                <img src="{{$product->image}}" alt="product image: {{$product->shortDescription}}">
            @else
            @if ($product->utm_pod != '')
            <img src="{{$product->image}}" alt="product image" width="144" height="96">>
            @endif
            @foreach($product->favouriteImages as $image)
                <img src="{{ env('APP_URL') }}/{{$image}}" alt="product image: {{$product->shortDescription}}" width="144" height="96">>
                @endforeach
            @endif
        </div>
    @endif
</div>

