@php use App\Helpers\ContentHelper; @endphp
<div class="hero-about-container">
    <img src="{{ env('APP_URL') }}/static/about-hero-img.png" class="about-hero-img"  alt="">
    <div class="about-hero-text">
        <h2 class="about-us-hero-title">{{ContentHelper::staticText('about')}}</h2>
        <p>{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about1')}}</p>
    </div>
</div>