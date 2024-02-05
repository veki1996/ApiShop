@php use App\Helpers\ContentHelper; @endphp
<div>
    <div class="about2-section">
        <div class="section-container2">
            <img src="{{ env('APP_URL') }}/static/about2-section-img1.png"  alt=""/>
            <div class="main-about2-text">
                <p class="about2-text-p">{{ContentHelper::staticText('aboutSectionOneSub')}}</p>
            </div>
        </div>	
    </div>
    <div class="about2-section reverse">
        <div class="section-container2 reverse">
            <img src="{{ env('APP_URL') }}/static/about2-section-img2.png"  alt=""/>
            <div class="main-about2-text left">
                <p class="about2-text-p left">{{ContentHelper::staticText('aboutSectionTwoSub')}}</p>
            </div>
        </div>
    </div>
    <div class="about2-section">
        <div class="section-container2">
            <img src="{{ env('APP_URL') }}/static/about2-section-img3.png"  alt=""/>
            <div class="main-about2-text">
                <p class="about2-text-p">{{ContentHelper::staticText('aboutSectionThreeSub')}}</p>
            </div>
        </div>
    </div>
    <div class="about2-section reverse">
        <div class="section-container2 reverse">
            <img src="{{ env('APP_URL') }}/static/about2-section-img4.png"  alt=""/>
            <div class="main-about2-text left">
                <p class="about2-text-p left">{{ContentHelper::staticText('aboutSectionFourSub')}}</p>
            </div>
        </div>
    </div>
</div>