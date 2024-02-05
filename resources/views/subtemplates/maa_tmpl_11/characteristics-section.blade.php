@php
    use App\Helpers\ProductHelper;
    $texts = ProductHelper::getContainers($product->shortSku, 'S_benefits');

    $productTexts = array_values(
        array_filter($texts, function ($el) {
            return $el['type'] === 'text';
        }),
    );
    $productImages = array_map(
        function ($image) {
            return strpos($image['text'], 'ourshopcdn') !== false ? $image['text'] : env('APP_URL') . '/' . $image['text'];
        },
        array_values(
            array_filter($texts, function ($el) {
                return $el['type'] === 'image';
            }),
        ),
    );

@endphp


@push('head-css')
   
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/characteristics.css">
@endpush

<div class="print">
   
    <div class="subtemplate">
        <h2>{!! $productTexts[0]['text'] !!}</h2>
    </div>
    <div class="image-text">
        <div class="image">
           
            <img src="{{ $productImages[4] ?? '' }}" alt="">
        </div>
        <div class="text">
            @for ($i = 0; $i < (count($productImages) < 3 ? count($productImages) : 3); $i++)
                <div class="text-item">
                    <div class="text-item-img">
                        <img src="{{ $productImages[$i] }}" alt="">
                    </div>
                    <div class="text-item-text">
                        <h3>{!! trim($productTexts[$i * 2 + 2]['text']) !!}</h3>
                        <p>{!! trim($productTexts[$i * 2 + 3]['text']) !!}</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
