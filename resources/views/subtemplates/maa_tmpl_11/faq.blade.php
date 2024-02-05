@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/faq.css">
@endpush
<div class="faq-section">
    <h1>{{ App\Helpers\ContentHelper::staticText('faq')}}</h1>
    @include('components.links.frequently_asked_questions')
</div>
<p class="faq-paragraph">{{ App\Helpers\ContentHelper::staticText('answersOnEmail')}}  {{ $email}}</p>
