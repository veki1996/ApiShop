@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/buttons/top-box-buttons.css">
@endpush


<div class="top-box-buttons">
    <div class="" @if(request()->has('flow') && request()->has('flow') == 'direct') style="display: none;" @endif>
        @include('components.shared.buttons.add-to-cart',
                [
                    'icon' => 'add-to-cart',
                    'customClass' => 'add-top-box'
                ])
    </div>
    <div class="">
        @include('components.shared.buttons.go-to-checkout', [
            'icon' => 'buy-now-white',
            'text' => ContentHelper::staticText('buyNow'),
            'customClass' => 'buy-now sm-s-text ' . ((request()->has('flow') && request()->input('flow') == 'direct') ? 'scroll' : ''),
        ])
    </div>
</div>

