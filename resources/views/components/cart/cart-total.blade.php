@php use App\Helpers\ContentHelper; @endphp
<div class="cart-total-sidebar">
    <div class="cart-everything-container">
        <div class='cart-total-info-container'>
            @include('components.cart.cart-total-title')
        @include('components.cart.cart-total-data')
        @include('components.cart.cart-total-price')
        </div>
        @include('components.shared.buttons.go-to-checkout', ['icon' => 'arrow-right-white', 'text' => ContentHelper::staticText('CartGoToCheckout') , 'customClass' => 'sm-s-text'])
    </div>

    <div class="benefits">
      <div class="top-benefits">
        @include('components.shared.benefit', ['icon' => '44day-benefit.png', 'benefitText' => ContentHelper::staticText('returnDeadline')])
        @include('components.shared.benefit', ['icon' => 'upon-delivery.png', 'benefitText' =>  ContentHelper::staticText('payCourier') ])
      </div>
       <div class="bottom-benefit">@include('components.shared.benefit', ['icon' => 'ssl-security.png', 'benefitText' =>  ContentHelper::staticText('ssl') ])</div>
    </div>
   

</div>
