@php
    use App\Helpers\ContentHelper;
@endphp
<div class="nav-tab-items">
    <p class="nav-tab-item" data-tab="description">{{ContentHelper::staticText('description') }}</p>
    <p class="nav-tab-item" data-tab="additional-info">{{ContentHelper::staticText('addInfo') }}</p>
    <p class="nav-tab-item" data-tab="reviews">{{ContentHelper::staticText('reviews') }}</p>
    <p class="nav-tab-item" data-tab="shipping_return" id="shipping-return"> {{ContentHelper::staticText('shipReturn') }}</p>
</div>
