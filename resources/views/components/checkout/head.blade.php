<title>{{ App\Helpers\ContentHelper::staticText('jewelry')}} - {{env('BRAND_NAME')}} | Checkout</title>

<link rel="shortcut icon" type="image/x-icon" href="{{env('APP_URL')}}/static/favicon.png">

<link rel="stylesheet" href="{{env('APP_URL')}}/css/checkout.css">
<link rel="stylesheet" href="{{env('APP_URL')}}/css/components/cart-form.css">


@foreach($pixels as $pixel)
    @include("components.tracking.pixels.$pixel")
@endforeach
