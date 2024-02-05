@php
    use App\Helpers\ContentHelper;
@endphp

<ul id="webshop-countries-list">
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/ba/"><img src="{{env('APP_URL')}}/static/ba.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/bg/"><img src="{{env('APP_URL')}}/static/bg.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/cz/"><img src="{{env('APP_URL')}}/static/cz.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/ee/"><img src="{{env('APP_URL')}}/static/ee.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/gr/"><img src="{{env('APP_URL')}}/static/gr.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/hr/"><img src="{{env('APP_URL')}}/static/hr.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/hu/"><img src="{{env('APP_URL')}}/static/hu.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/it/"><img src="{{env('APP_URL')}}/static/it.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/lt/"><img src="{{env('APP_URL')}}/static/lt.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/lv/"><img src="{{env('APP_URL')}}/static/lv.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/pl/"><img src="{{env('APP_URL')}}/static/pl.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/pt/"><img src="{{env('APP_URL')}}/static/pt.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/ro/"><img src="{{env('APP_URL')}}/static/ro.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/rs/"><img src="{{env('APP_URL')}}/static/rs.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/si/"><img src="{{env('APP_URL')}}/static/si.png" alt=""></a></li>
    <li><a href="{{ substr(env('APP_URL'), 0, -3) }}/sk/"><img src="{{env('APP_URL')}}/static/sk.png" alt=""></a></li>
</ul>

<style>
    #webshop-countries-list {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0;
        padding: 0 !important;
        height: auto !important;
    }
    #webshop-countries-list li {
        margin: 0;
        width: 32px;
        height: 24px;
    }
    #webshop-countries-list li a {
        display: inline-block;
        width: 32px;
        height: 24px;
        /*text-indent: 100%;*/
        white-space: nowrap;
        /*overflow: hidden;*/
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center center;
    }
    #webshop-countries-list li a img {
        border-radius: 2px;
    }
    @media screen and (max-width: 768px) {
        #webshop-countries-list {
            order: 1;
        }
    }
</style>
