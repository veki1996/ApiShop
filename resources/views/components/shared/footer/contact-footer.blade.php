@php use App\Helpers\ContentHelper; @endphp
<div class="footer-contact">
    <p class="tos-parag border-bottom">{{ContentHelper::staticText('kontakt')}} <img class="arrow rotate" alt="arrow for open footer menu" src="{{ env('APP_URL') }}/static/footer-arrow.png"> </p>
    <div class="footer-item show">
        <p  style="text-transform: none">{{ContentHelper::staticText('helpForShopping')}}</p>
    <ul class="contact-list-footer">
        <li>{{ContentHelper::staticText('forYou8-16')}}</li>
        <li><a href="https://wa.me/{{$whatsappNumber ?? ''}}?text={{ContentHelper::staticText('whatsappText', ['orderCode' => $phoneOrderCode ?? ''])}}" target="_blank"><img alt="whatssapp icon" src="{{ env('APP_URL') }}/static/WhatsAppFooter.png"/>WhatsApp</a></li>
        <li><a href="tel:{{$phone ?? ''}}" target="_blank"><img alt="phone icon" src="{{ env('APP_URL') }}/static/phoneFooter.png"/>{{ContentHelper::staticText('telNumberForOrder')}} <span>{{$phone ?? ''}}</span></a></li>
        <li>{{ContentHelper::staticText('phoneOrder')}} <span>{{$phoneOrderCode ?? ''}}</span></li>
        <li><img alt="email icon" src="{{ env('APP_URL') }}/static/mailFooter.png"/>{{ContentHelper::staticText('sendMail')}} <span>{{$email}}</span></li>
    </ul>
    </div>
</div>