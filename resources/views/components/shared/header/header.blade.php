@php use App\Helpers\ContentHelper; @endphp

@push('head-css')
    <link rel="stylesheet" href="{{env('APP_URL')}}/css/components/header.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/categories-dropdown/categories-dropdown.css">
@endpush


<div class="header-block">
    
    <div class="header-navbar">
        <div class="burger-container">
            <img src='{{env('APP_URL')}}/svg/menu.svg' class="burger-container-image" alt="burger image for open side menu">
        </div>
        <div class="align-center header-links">
            @if(env('IS_NICHE'))
                @include('components.shared.header.header-angle-tags')
            @endif
            @include('components.shared.categories', compact('categories'))
            <a id='onama' href='{{env('APP_URL')}}/about{{ \App\Helpers\RouteHelper::appendParameters() }}' class="header-categories-tab">{{ App\Helpers\ContentHelper::staticText('about') }}</a>
        </div>
        <div class="header-logo-container">
            @include('components.shared.header.header-logo')
        </div>


        <div class="flex align-center header-icons-container">
            @include('components.shared.header.header-search')
            @if(!str_contains(request() -> url(), 'checkout'))
                @include('components.shared.header.header-cart')
            @endif
            @include('components.shared.header.user')
        </div>


    </div>
</div>
<div class="dropdown-overlay-hide"></div>
@include('components.shared.categories-burger.categories-burger')

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/shared/header.js"></script>

@endpush
