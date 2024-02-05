@php use App\Helpers\ContentHelper; @endphp

<div class="grades-text">
    <h2>{{ContentHelper::staticText('pleased_customers_tmpl12')}}</h2>
    <div class="grades-subtitle">
       <div class="grades-s-padd"> {{ContentHelper::staticText('satisfaction_rate_tmpl12')}}</div>
       <img class="grades-stars" src="{{env('APP_URL')}}/static/grades-stars.png">
    </div>
</div>