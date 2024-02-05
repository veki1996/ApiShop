@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/hero-section.css">
@endpush

<div class="hero-section" style="background: url('{{ env('APP_URL') }}/static/hero-back.png'); background-size: cover;
background-repeat: no-repeat;">
    <div class="hero-section-content">
        <div class="hero-text">
            @include('components.index.hero.hero-text')
            @include('components.index.hero.hero-button')
        </div>
        <div class="hero-images">
            @include('components.index.hero.hero-images', ['sliderImages' => $sliderImages])
        </div>
    </div>
</div>
