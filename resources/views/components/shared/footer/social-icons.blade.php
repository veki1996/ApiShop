@php use App\Helpers\ContentHelper; @endphp
<div class="social-icons-footer">
    <div class="follow">
        <h3>{{ContentHelper::staticText('follow') }}</h3>
    </div>
    <div class="social-icons-footer-images">
        <a rel='noopener' aria-label="Check our facebook page" href='https://www.facebook.com/profile.php?id=61550869392104' target="blank"><img src="{{ env('APP_URL') }}/static/facebook.png" alt="facebook icon "></a>
        {{-- <a><img src="{{ env('APP_URL') }}/static/youtube.png"></a> --}}
        <a rel='noopener' aria-label="Check our instagram page" href='https://www.instagram.com/alozzi_com/' target="blank"><img src="{{ env('APP_URL') }}/static/instagram.png" alt="instagram icon"></a>
        {{-- <a> <img src="{{ env('APP_URL') }}/static/tik_tok.png"></a> --}}
    </div>
</div>
