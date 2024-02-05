@php
    use App\Helpers\ContentHelper;

    /**
     * @var string $email
     * @var string $phone
     * @var string $tosLink
     */

@endphp

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/footer.css">
@endpush

<div class="footer-section">
    <div class="footer-links-container">
        <div class="logo-col">
            <img alt="logo icon for footer of page" src='{{ env('APP_URL') }}/static/footer-logo.png'/>
            @include('components.shared.footer.social-icons')
        </div>
        @include('components.shared.footer.contact-footer')
        <div class="footer-section-links">
            <p class="tos-parag border-bottom">{{ ContentHelper::staticText('suppornAndServices')}} <img class="arrow" src="{{ env('APP_URL') }}/static/footer-arrow.png" alt="arrow image for open and close footer menu"></p>
           <div class="footer-item">
            @include('components.shared.footer.help-links', [
                'helpLinks' => [
                    [
                        'link' =>
                            route('page.tos', ['link' => 'terms-and-conditions']) .
                            '?' .
                            $tosLinks['terms-and-conditions']['params'],
                        'text' => ContentHelper::staticText('tos') ,
                    ],
                    [
                        'link' =>
                            route('page.tos', ['link' => 'privacy-policy']) .
                            '?' .
                            $tosLinks['privacy-policy']['params'],
                        'text' => ContentHelper::staticText('privacyPolicy') ,
                    ],
                    [
                        'link' =>
                            route('page.tos', ['link' => 'cookie-policy']) .
                            '?' .
                            $tosLinks['cookie-policy']['params'],
                        'text' => ContentHelper::staticText('cookiePolicy') ,
                    ],
                    [
                        'link' =>
                            route('page.tos', ['link' => 'frequently-asked-questions']) .
                            '?' .
                            $tosLinks['frequently-asked-questions']['params'],
                        'text' => ContentHelper::staticText('faq') ,
                    ],
                    [
                        'link' =>
                            route('page.tos', ['link' => 'customer-support']) .
                            '?' .
                            $tosLinks['customer-support']['params'],
                        'text' => ContentHelper::staticText('customerSupport') ,
                    ],
                ],
            ])
           </div>
        </div>
        <div class="footer-section-services">
            @include('components.shared.footer.services')
        </div>
    </div>
    <div class="footer-copyright">
        @include('components.shared.footer.copyright')
    </div>
</div>

@push('body-js')
<script src="{{ env('APP_URL') }}/js/footer.js"></script>
@endpush
