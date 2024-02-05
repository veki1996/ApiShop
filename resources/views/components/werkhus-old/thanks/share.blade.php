<div id="social-style">
    <a target="_blank" id="facebook-style" href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&amp;u={{ urlencode(env('APP_URL') . '?referer=coupon&utm_source=tc') }}&amp;display=popup&amp;ref=plugin&amp;src=share_button" onclick="gtag('event', 'facebook_share', {'event_category':'engagement','event_label': 'facebook-share'});">
        <img src="{{env('APP_URL')}}/static/icon-fac.png">Share
    </a>
    <a target="_blank" id="twe-style" href="https://twitter.com/intent/tweet?text={{ urlencode($message) }}&amp;url={{ urlencode(env('APP_URL') . '?referer=coupon&utm_source=tc') }}" onclick="gtag('event', 'twitter_share', {'event_category':'engagement','event_label': 'twitter-share'});">
        <img src="{{env('APP_URL')}}/static/icon-twe.png">Tweet
    </a>
    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(env('APP_URL') . '?referer=coupon&utm_source=tc') }}&amp;media={{ urlencode(env('APP_URL') . '/static/pinterest-coupon.jpg') }}&amp;description={{ urlencode($message) }}" class="pin-it-button" count-layout="horizontal" target="_blank" onclick="gtag('event', 'pinterest_share', {'event_category':'engagement','event_label': 'pinterest-share'});">
        <img border="0" src="{{env('APP_URL')}}/static/icon-pin.png" title="Pin It">
    </a>
    <a class="viber-1" href="viber://forward?text={{ urlencode($message) }} {{ urlencode(env('APP_URL') . '?referer=coupon&utm_source=tc') }}" onclick="gtag('event', 'viber_share', {'event_category':'engagement','event_label': 'viber-share'});">
        <img src="{{env('APP_URL')}}/static/icon-vib.png">Share
    </a>
    <a class="whatsapp-1" href="whatsapp://send?text={{ urlencode($message) }} {{ urlencode(env('APP_URL') . '?referer=coupon&utm_source=tc') }}" onclick="gtag('event', 'whatsapp_share', {'event_category':'engagement','event_label': 'whatsapp-share'});">
        <img src="{{env('APP_URL')}}/static/icon-wha.png">Share
    </a>
</div>
