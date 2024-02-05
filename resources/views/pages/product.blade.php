@php
    use App\Entities\Product;
    use App\Helpers\ContentHelper;
    use App\Helpers\ProductHelper;
   

    /**
    * @var Product $product
    */
@endphp

@extends('layouts.base',
    [
        'thumbnail' => $product->image,
        'name'      => $product->name,
        'shortDesc' => $product->shortDescription,
        'longDesc'  => $product->longDescription,
    ]
)

@section('head')
    @include('components.product.head', compact('product'))
@stop

@section('body')
    @include(
        'components.shared.header.header',
        [
            'phone'             => $phone,
            'viberNumber'       => $viberNumber,
            'whatsappNumber'    => $whatsappNumber,
            'orderCode'         => $orderCode,
            'deliveryText'      => $product->deliveryDisplay
                ? $product -> deliveryDisplay
                : ContentHelper::staticText('quickDelivery'),
        ]
    )

    <div class="ws-frilla-main-wrapper">
        <div class="main-container">
            @include("subtemplates.$subtemplate")
            @include('components.shared.buttons.add-to-cart-sticky')
        </div>
    </div>

    @include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

    @if(request('flow') != 'direct')
        @include('components.shared.modals.add-to-cart-modal.popUp')
    @endif

@stop


@push('body-js')
    @include('components.tracking.product-page-view', compact('product'))
    @include('components.schema.markup', compact('product'))
@endpush


    
