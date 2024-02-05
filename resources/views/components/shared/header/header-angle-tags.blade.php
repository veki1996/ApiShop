@php use App\Helpers\ContentHelper; @endphp
<div class="header-angle-tag">
    <p>{{ContentHelper::staticText('giftFor') }}</p>
    <img src="{{ env('APP_URL') }}/static/arrow_drop_down.svg" alt="">
    @include('components.shared.categories-dropdown.categories-dropdown',
            [
                'categories' => $nicheCategories ?? '',
                'customClass' => 'niche-categories'
            ])
</div>


