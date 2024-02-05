@php use App\Helpers\ContentHelper; @endphp
<div class="categories-grid">
    <div class="categories-row">
        <div class="categories-row-items">
            <img src="{{ env('APP_URL') }}/static/Necklaces.png" class="categories-row-images"/>
            <div class="categories-grid-overlay"></div>
            <p>{{ContentHelper::staticText('necklaces')  }}</p> 
        </div>
        <div class="categories-row-items smaller">
            <img src="{{ env('APP_URL') }}/static/Bracelets.png" class="categories-row-images"/>
            <div class="categories-grid-overlay-linear"></div>
            
            <p>{{ContentHelper::staticText('bracelets')  }}</p>
        </div>
    </div>
    <div class="categories-column">
        <div class="categories-column-items">

            <p>{{ContentHelper::staticText('watches')}}</p>
            <img src="{{ env('APP_URL') }}/static/Watches.png" class="categories-row-images"/>
            <div class="categories-grid-overlay"></div>
        </div>
        <div class="categories-column-items">
            <p>{{ContentHelper::staticText('sets')}}</p>
            <img src="{{ env('APP_URL') }}/static/Sets.png" class="categories-row-images"/>

            <div class="categories-grid-overlay-linear-column"></div>
        </div>
    </div>
</div>
