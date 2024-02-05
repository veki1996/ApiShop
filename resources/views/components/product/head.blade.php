<title>{{$product->longName}} | {{env('BRAND_NAME')}}</title>

<link rel="shortcut icon" type="image/x-icon" href="{{env('APP_URL')}}/static/favicon.png">

<link rel="stylesheet" href="{{env('APP_URL')}}/css/product.css">
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/header.css">
{{-- <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/footer.css"> --}}

@foreach($pixels as $pixel)
    @include("components.tracking.pixels.$pixel")
@endforeach
