<div class="search-box">
    <div class="search-field flex centerV">
        <input id="search-field-0" class="search-field" name="q" value=""
               placeholder="{{\App\Helpers\ContentHelper::staticText('search')}}...">
        <div class="buttonContainer">
            <div class="searchIcon centerV" id="search-button" data-route="{{ env('APP_URL') }}/shop/{{ \App\Helpers\RouteHelper::appendParameters() }}">
                <img id="search-button" src="{{env('APP_URL')}}/svg/search.svg" alt="button for search products">
            </div>
        </div>
    </div>
</div>
