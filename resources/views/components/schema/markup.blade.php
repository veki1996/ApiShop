
<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Product",
      "name": "{{$product->realName}} - {{ $product->name }}",
      "image": "{{$product->image}}",
      "description": "{{$product->longDescription}}",
      "brand": {
        "@type": "Brand",
        "name": "{{env('BRAND_NAME')}}",
        "logo": "{{env('APP_URL') . '/logo/logo.png'}}"
      },
      "offers": {
        "@type": "Offer",
        "price": "{{$product->prices->forOne}}",
        "priceCurrency": "{{env('CURRENCY_CODE')}}"
      }
    }
    </script>
    

