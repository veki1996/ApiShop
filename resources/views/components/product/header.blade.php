<div class="header-wrapp flex row align-center justify-between m0">
    <div class="header-width flex row align-center justify-between m0 stretch">
        @include(
            'components.shared.logo',
            [
                'link' => env('APP_URL'),
                'image' => env('APP_URL') . "/logo/$brandId.png"
            ]
        )
    </div>
</div>
