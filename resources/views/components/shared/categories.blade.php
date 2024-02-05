@php use App\Helpers\ContentHelper; @endphp

<div class="header-categories-tab">
    <p>{{ContentHelper::staticText('categories')}}</p>
    <img src="{{ env('APP_URL') }}/static/arrow_drop_down.svg" alt="">
    @include('components.shared.categories-dropdown.categories-dropdown',
            [
                'categories' => $mainCategories ?? '',
                'customClass' => 'categories-toggled main-categories'
            ])
</div>
