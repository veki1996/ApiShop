@php use App\Helpers\ContentHelper; @endphp

<div class="footer-services-holder">
    <p class="tos-parag">{{ContentHelper::staticText('company')}} </p>
    <a href='{{env('APP_URL')}}/about{{ \App\Helpers\RouteHelper::appendParameters() }}' >{{ContentHelper::staticText('about')}}</a>
    
    <div class="logo-col-mobile">
        @include('components.shared.footer.social-icons')
    </div>
    <div class="footer-services-holder-text tos-parag ">
        <h2>{{ ContentHelper::staticText('paymentOptions')  }}</h2>
    </div> 
    <div class="footer-services-holder-images">
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/paypal.png" alt="paypal icon"></div>
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/mastercard.png" alt="mastercard icon"></div>
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/maestro.png" alt="maestro card icon"></div>
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/visa.png" alt="visa card icon"></div>
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/stripe.png" alt="stripe icon"></div>
        <div class="single-image-footer"> <img src="{{ env('APP_URL') }}/static/money.png" alt="money icon"></div>
    </div>
</div>
