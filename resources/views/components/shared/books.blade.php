@php
use App\Helpers\ContentHelper;
use App\Helpers\FeeHelper;
@endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/books.css">
@endpush

<div class="booksHolder">
    <div class="booksBox">
        <div class="booksText">
            {{ContentHelper::staticText('priceFor')}}
        </div>
        <div class="booksPlus">+</div>
        <div class="booksImg">
            <img src="{{env('APP_URL')}}/static/books.png">
        </div>

    </div>
</div>
