<div class="product-top-box-text">
    @include('components.shared.products.product-box-stars')
    <p id="text-second">
        {!!$product->longDescription!!}
    </p>
    @include('subtemplates.maa_tmpl_2b.top-box.top-box-name')
    @include('subtemplates.maa_tmpl_11.top-box.top-box-list')
    {{-- @include('subtemplates.maa_tmpl_2b.top-box.top-box-description') --}}
    @include('subtemplates.maa_tmpl_2b.top-box.top-box-prices')
    @include('subtemplates.maa_tmpl_11.top-box.top-box-paycards')
    @include('subtemplates.maa_tmpl_2b.top-box.top-box-delivery')
    @if(isset($propertiesData['properties']) && count($propertiesData['properties']))
        @include('subtemplates.maa_tmpl_2b.top-box.product-variations')
    @endif
    <p id="quantity">{{ App\Helpers\ContentHelper::staticText('quantity')}}:</p>
    @include('subtemplates.maa_tmpl_2b.top-box.top-box-quantity')
    @include('subtemplates.maa_tmpl_2b.top-box.top-box-buttons')
</div>