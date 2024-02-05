@php use App\Helpers\ContentHelper; @endphp

<div class="books-holder">
    <div class="books-text">{{ContentHelper::staticText('priceFor')}}</div>
    <div class="books-img">+<img src="{{env('APP_URL')}}/static/books.png"  alt=""></div>
</div>