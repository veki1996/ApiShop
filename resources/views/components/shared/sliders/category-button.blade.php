<a href="{{env('APP_URL')}}/shop{{ \App\Helpers\RouteHelper::appendParameters() }}" data-id="{{ $category -> id }}"
   class="shop_category">

    <div class="btn-category-slider">
        <p>{{ $category -> name }}</p>
    </div>
</a> 
