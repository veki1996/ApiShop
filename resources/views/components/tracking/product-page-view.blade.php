@php
    /**
    * @var stdClass $product
    */
@endphp

<script>
    $(() => {
        const productSku = '{{$product->longSku}}'
        const productName = '{{$product->name}}'
        const fbCategories = '{{implode(' > ', $product->fbCategories)}}'
        const googleCategories = '{{@$product->googleCategories['texts'][0] ?? ''}}'
        const productPrice = parseFloat('{{$product->prices->forOne}}')

        if (typeof fbq === 'function') {
            fbq(
                'track',
                'ViewContent',
                {
                    content_ids: [productSku],
                    content_name: productName,
                    content_category: fbCategories,
                    content_type: 'product',
                },
            )
        }

        if (typeof gtag === 'function') {
            gtag(
                'event',
                'view_item',
                {
                    items: [
                        {
                            item_id: productSku,
                            item_name: productName,
                            price: productPrice,
                            item_category: googleCategories,
                            currency: 'EUR',
                        },
                    ],
                },
            )
        }

        if (typeof pintrk === 'function') {
            pintrk(
                'track',
                'PageVisit',
                {
                    product_price: productPrice,
                    currency: 'EUR',
                    product_category: googleCategories,
                    product_id: productSku,
                    product_name: productName,
                },
            )
        }

        if (typeof ttq === 'object') {
            ttq.track(
                'ViewContent',
                {
                    content_id: productSku,
                    content_type: 'product',
                    content_name: productName,
                    price: productPrice,
                    value: productPrice,
                    currency: 'EUR',
                },
            )
        }
    })
</script>
