<div class="slider">
    @foreach($images as $image)
        <img src="{{$image}}" alt="" class="slider-image-desk" @if($loop->first) id="slider-main" @endif>
    @endforeach
</div>


@push('head-css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

<style>
    .slick-dots li button:before {
        font-size: 8px;
    }
    @media screen and (min-width: 768px) {
        .slick-dots {
            display: none !important;
        }
    }
</style>


@push('head-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush


@push('body-js')
    <script>
        $(document).ready(function () {
            $('.slider').not('.slick-initialized').slick({
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 700,
                dots: true,
            })
        })
    </script>
@endpush
