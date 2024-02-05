
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_2b/img-text.css">
@endpush
<div class="t2b-benefit-item parent column pdn-small">
    <div class="imgtxtholder">
        @foreach ($containers as $container)
            @include('subtemplates.maa_tmpl_2b.img-txt.block', [
                'text' => $container['text'],
                'image' => $container['image'],
            ])
        @endforeach
    </div>
</div>
