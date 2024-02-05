@php use App\Helpers\ContentHelper; @endphp
 <div class="repp-cover">
     <div class="flex col sending">
         <p>{!! ContentHelper::staticText('sendingOrder')  !!}</p>
     </div>

     <div class="flex col sent">
         <p>{!! ContentHelper::staticText('orderSent')  !!}</p>
     </div>

     <div class="flex col order-info">
         <p>{{ ContentHelper::staticText('thanksForOrdering')  }}</p>
         <p>{{ ContentHelper::staticText('orderStatus')  }}</p>
     </div>
 </div>
