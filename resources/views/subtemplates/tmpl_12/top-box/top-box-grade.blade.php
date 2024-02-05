@php use App\Helpers\ContentHelper; @endphp

<div class="top-box-grade">
    <div>{{ContentHelper::staticText('averageGrade')}} 4,9/5</div>
    <img class="grades-stars" src="{{env('APP_URL')}}/static/grades-stars.png">
</div>