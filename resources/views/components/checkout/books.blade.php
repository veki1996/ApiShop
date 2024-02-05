@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/books.css">
@endpush
<div class="books-section">
    <div class="book-item-checkbox">
        <div class="book-checkbox">
            <img src="{{ env('APP_URL') }}/static/done.png" alt="">
        </div>
        <div class="books-text">
            <h1> {{App\Helpers\ContentHelper::staticText('books')}} </h1>
            
        </div>
        
    </div>
    <div class="book-item-img">
    <img src="{{env('APP_URL')}}/static/books.png"  alt="">
    <p>{{App\Helpers\ContentHelper::staticText('priceFor')}} </p>
    </div>
</div>
@push('body-js')
<script src="{{ env('APP_URL') }}/js/checkout/books.js"></script>
@endpush
