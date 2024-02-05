@php use App\Helpers\ContentHelper; @endphp

    <a class="hero-btn" href="{{ env('APP_URL') }}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}">{{ContentHelper::staticText('shop') }} <img src="{{ env('APP_URL') }}/static/double_arrow_white.png" alt="arrow"></a>



