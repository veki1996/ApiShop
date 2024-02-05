@php use App\Helpers\ContentHelper; @endphp
<div class="hero-about2-container">
    <img src="{{ env('APP_URL') }}/static/about2-hero-img.png" class="about2-hero-img"  alt="">
    <div class="about2-hero-text">
        <h2 class="about2-us-hero-title">{{ContentHelper::staticText('about')}}</h2>
        <p>{{ContentHelper::staticText('aboutParagraph')}}</p>
    </div>
</div>