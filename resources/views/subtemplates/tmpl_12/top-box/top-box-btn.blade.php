<div class="top-box-btn">
@include(
            'components.shared.buttons.add-to-cart',
            [
                'product' => $product,
                'id'      => uniqid('add-to-cart-'),
                'icon' => 'add-to-cart'
            ]
    )
</div>