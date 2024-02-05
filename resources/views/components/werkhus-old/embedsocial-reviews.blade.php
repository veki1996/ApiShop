@php
    /**
    * @var string $key
    */
@endphp


<div class="embedsocial-reviews" data-ref="{{$key}}"></div>


@push('body-js')
    <script>
        (function (d, s, id) {
            let js
            if (d.getElementById(id)) {return}
            js = d.createElement(s)
            js.id = id
            js.src = 'https://embedsocial.com/embedscript/ri.js'
            d.getElementsByTagName('head')[0].appendChild(js)
        }(document, 'script', 'EmbedSocialReviewsScript'))
    </script>
@endpush
