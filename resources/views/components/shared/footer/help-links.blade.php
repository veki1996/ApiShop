@php
    use App\Helpers\ContentHelper;
@endphp

@foreach ($helpLinks as $helpLink)
    <div class="footer-section-link">
        <a href="{{ $helpLink['link'] }}">{{ $helpLink['text'] }}</a>
    </div>
@endforeach
