
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/swiper.css">
@endpush

<div id="tmpl_11_slider" class="splide {{$customClass ?? ''}}">
   <center> <h2> {{ $allContainers['s_text_var_12']->text ?? ''}}</h2></center>
    <div class="splide__track">
        <div class="splide__list">
            
            @php
                $counter = 1;
            @endphp
                @for($i = 5; $i <= 7; $i++)

                    <div class="splide__slide">
                       
                        <img src="{{ $allContainers['s_img_var_' . $i]->text }}" alt="" srcset="">
                       
                        @if ($counter == 1)
                        <h3>{!! $allContainers['s_text_var_' . ($i + 9)]->text !!}</h3>
                        <p>{!! $allContainers['s_text_var_' . ($i + 10)]->text !!}</p>
                        @elseif($counter == 2)
                        <h3>{!! $allContainers['s_text_var_' . ($i + 9 + 1)]->text !!}</h3>
                        <p>{!! $allContainers['s_text_var_' . ($i + 10 + 1)]->text !!}</p>
                        @else
                        <h3>{!! $allContainers['s_text_var_' . ($i + 9 + 2)]->text !!}</h3>
                        <p>{!! $allContainers['s_text_var_' . ($i + 10 + 2)]->text !!}</p>

                        @endif
                        @php
                            $counter++;
                        @endphp
                    </div>
                 @endfor
        </div>
    </div>
</div>
