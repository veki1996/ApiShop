@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/shop.css">
@endpush

<div class="filter-menu">
    <div class="filter-title">
        <h1>{{ContentHelper::staticText('filters') }}</h1> <img src="{{ env('APP_URL') }}/static/tune.png" alt="filter icon for toggle filter menu">
    </div>

    @include('components.shop.filter-desktop')

    <div class="sidebar" style="display: none">
        @include('components.shop.sidebar-shop')
    </div>

</div>
