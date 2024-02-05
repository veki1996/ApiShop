@php use App\Helpers\ContentHelper; @endphp
<div class="addedTitle col centerV centerH">
    <img alt="checkmark" src="{{ env('APP_URL') }}/svg/checkmark-outline.svg">
    <p>{{ ContentHelper::staticText('addedToCart')  }}</p>
</div>