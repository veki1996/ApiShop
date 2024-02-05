@php use App\Helpers\ContentHelper; @endphp
<div>
    <div class="about-section gray">
        <div class="section-container">
            <img src="{{ env('APP_URL') }}/static/about-section-img1.png"  alt=""/>
            <div class="main-about-text">
                <h4 class="about-text-heading">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about2')}}</h4>
                <p class="about-text-p">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about2.1')}}</p>
            </div>
        </div>	
    </div>
    <div class="about-section reverse">
        <div class="section-container reverse">
            <img src="{{ env('APP_URL') }}/static/about-section-img2.png" alt=""/>
            <div class="main-about-text left">
                <h4 class="about-text-heading left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about3')}}</h4>
                <p class="about-text-p left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about3.1')}}</p>
            </div>
        </div>
    </div>
    <div class="about-section gray">
        <div class="section-container">
            <img src="{{ env('APP_URL') }}/static/about-section-img3.png"  alt=""/>
            <div class="main-about-text">
                <h4 class="about-text-heading">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about4')}}</h4>
                <p class="about-text-p">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about4.1')}}</p>
            </div>
        </div>
    </div>
    <div class="about-section reverse">
        <div class="section-container reverse">
            <img src="{{ env('APP_URL') }}/static/about-section-img4.png"  alt=""/>
            <div class="main-about-text left">
                <h4 class="about-text-heading left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about5')}}</h4>
                <p class="about-text-p left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about5.1')}}</p>
            </div>
        </div>
    </div>
    <div class="about-section gray">
        <div class="section-container">
            <img src="{{ env('APP_URL') }}/static/about-section-img5.png" alt=""/>
            <div class="main-about-text">
                <h4 class="about-text-heading">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about6')}}</h4>
                <p class="about-text-p">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about6.1')}}</p>
            </div>
        </div>
    </div>
    <div class="about-section reverse">
        <div class="section-container reverse">
            <img src="{{ env('APP_URL') }}/static/about-section-img6.png"  alt=""/>
            <div class="main-about-text left">
                <h4 class="about-text-heading left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about7')}}</h4>
                <p class="about-text-p left">{{ContentHelper::staticText(strtolower(env('BRAND_NAME')).'_about7.1')}}</p>
            </div>
        </div>
    </div>
</div>