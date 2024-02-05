<!doctype html>
<html lang="{{env('APP_LANGUAGE')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title"
        content="{{isset($name) && isset($shortDesc) && isset($product->utm_pod) ? $name . ' - ' . $shortDesc . '-' . $product->utm_pod: App\Helpers\ContentHelper::staticText(lcfirst(env('BRAND_NAME')). 'MetaTitle') . '- Alozzi'}}">
    <meta name="description"
        content="{{ isset($name) && isset($shortDesc) && isset($longDesc) && isset($product->utm_pod) ? $name . ' - ' . $shortDesc . ' - ' . $longDesc . '-' . $product->utm_pod : App\Helpers\ContentHelper::staticText(lcfirst(env('BRAND_NAME')) . 'MetaDesc') }}">
    <meta name="dc.description" content="{{$longDesc ?? ''}}">
    <meta name="dc.title" content="{{isset($name) && isset($shortDesc) ? $name . ' - ' . $shortDesc : 'Alozzi'}}">
    <meta name="dc.description" content="{{$longDesc ?? ''}}">
    <meta name="dc.relation" content="{{env('APP_URL')}}">
    <meta name="dc.source" content="{{env('APP_URL')}}">
    <meta name="dc.language" content="{{env('APP_LANGUAGE')}}">
    <meta property="og:site_name" content="Alozzi">
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:title" content="{{isset($name) && isset($shortDesc) ? $name . ' - ' . $shortDesc : 'Alozzi'}}">
    <meta property="og:type" content="website">
    <meta property="og:image" itemprop="image" content="{{$thumbnail ?? env('APP_URL') . '/logo/logo.png'}}">
    <meta property="og:description" content="{{$longDesc ?? ''}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{isset($name) && isset($shortDesc) ? $name . ' - ' . $shortDesc : 'Alozzi'}}">
    <meta name="twitter:description" content="{{$longDesc ?? ''}}">
    <meta name="twitter:image" content="{{$thumbnail ?? env('APP_URL') . '/logo/logo.png'}}">
    
    @isset($product->productGeoLinks)
    @foreach ($product->productGeoLinks as $key => $link)
   
    @if ($key != "RS" && $key != "BA")

    <link href="{{$link}}" rel="alternate" hreflang="{!! strtolower($key)!!}-{{$key }}">

    @endif
    @endforeach
    @else
    <link href="https://{{$_SERVER['HTTP_HOST']}}/hr/shop" rel="alternate" hreflang="hr-HR">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/bg/shop" rel="alternate" hreflang="bg-BG">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/cz/shop" rel="alternate" hreflang="cs-CZ">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/ee/shop" rel="alternate" hreflang="et-EE">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/gr/shop" rel="alternate" hreflang="el-GR">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/hu/shop" rel="alternate" hreflang="hu-HU">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/it/shop" rel="alternate" hreflang="it-IT">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/lt/shop" rel="alternate" hreflang="lt-LT">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/lv/shop" rel="alternate" hreflang="lv-LV">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/pl/shop" rel="alternate" hreflang="pl-PL">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/pt/shop" rel="alternate" hreflang="pt-PT">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/ro/shop" rel="alternate" hreflang="ro-RO">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/si/shop" rel="alternate" hreflang="sl-SI">
    <link href="https://{{$_SERVER['HTTP_HOST']}}/sk/shop" rel="alternate" hreflang="sk-SK">
    @endisset
    <link rel="canonical" href="{{ app('request')->url() }}/">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/normalize.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/buttons/add-to-cart.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/buttons/go-to-checkout.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/global.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/brand/brand.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/template.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/benefit.css">

    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ env('APP_URL') }}/js/global.js"></script>

    @yield('head')

    @stack('head-css')
    @stack('head-js')
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
</style>

<body>
    @yield('body')
    @include('components.shared.modals.user.user-popup')
    <script src="{{env('APP_URL')}}/js/lib/currencies.js"></script>
    <script src="{{env('APP_URL')}}/js/Shop.js"></script>
    <script src="{{env('APP_URL')}}/js/Cart.js"></script>
    <script src="{{env('APP_URL')}}/js/User.js"></script>
    {{-- <script src="{{env('APP_URL')}}/js/WS.js"></script> --}}
    <script>
        window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            // Page is being restored from the BFCache
            window.location.reload();
        }
    });

    const shop = new Shop(
        '{{ env('COUNTRY_CODE') }}',
        {{ env('BRAND_ID') }},
        '{{ strtolower(env('CURRENCY_CODE')) }}',
        '{{ env('DOMAIN') }}',
        '{{ env('SHOP_ID', 0) }}',
        '{{ env('PROFILE_ID') }}',
        '{{ env('MAILSTORM_ID') }}',
        {{ \App\Helpers\ContentHelper::eurRates(env('CURRENCY_CODE')) }}

    )

    const cart = new Cart(
        '{{env('COUNTRY_CODE')}}',
        '{{strtolower(env('CURRENCY_CODE'))}}',
        shop.eurExchangeRate,
        '{{ env('BRAND_ID', 0) }}',
    )
    
    const user = new User(parseFloat('{{(new \App\Helpers\FeeHelper())->postageCost()}}'))
    const country = '{{env('COUNTRY_CODE')}}'
    const IDbrand = '{{env('BRAND_ID')}}'
    const app_url = '{{env('APP_URL')}}';
    const usedCoupon = '{{App\Helpers\ContentHelper::staticText("usedCoupon")}}';
    const wrongCoupon = '{{App\Helpers\ContentHelper::staticText("wrongCoupon")}}';
    const couponActivated = '{{App\Helpers\ContentHelper::staticText("couponActivated")}}';
    const save = '{{App\Helpers\ContentHelper::staticText("save")}}';
    const postageData = @php if(isset($feeHelper))  echo $feeHelper -> getPostageData(); else echo '""'; @endphp;
    const awCode = '{{$trackingCodes->awCode}}/{{$trackingCodes->awConvLabel}}';
    const currencyCode = '{{ env('CURRENCY_CODE') }}';
   
    for (let [property, value] of Object.entries(JSON.parse(localStorage.getItem(`cart-${IDbrand}-${country}`)) || {})) {
        cart[property] = value;
    }

    const currencySymbol = '{{env('CURRENCY')}}';
    const productPath = '{{ env('PRODUCTS_PATH') }}';
    const brandName = '{{ env('BRAND_NAME') }}';
    </script>

    @stack('body-css')
    @stack('body-js')
</body>

</html>