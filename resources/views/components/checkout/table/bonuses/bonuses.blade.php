@php use App\Helpers\ContentHelper; @endphp
@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/checkout/checkout-bonuses.css">
 @endpush
<div class="bonuses flex package-safety">
    <div class="bonus option-btn active">
        <div class="bonusDes ">
            <div class="left-side-bonuses-container">
                <div class="btnHolder">
                    {{-- <div class="bonus-toggle-btn the-btn the-btn-1  bonusBtnStyle clicked"
                         data-sku="{{$sku}}"
                         data-price="{{$cost}}"
                         data-name="{{ContentHelper::staticText('packageInsurance')}}"
                         id="package-insurance">{{ContentHelper::staticText('added') }}
                    </div> --}}
                    <div class="bonus-toggle-btn custom-checkbox  bonusBtnStyle"
                         data-sku="{{$sku}}"
                         data-price="{{$cost}}"
                         data-name="{{ $bonusTitle }}"
                         id="package-insurance">
                        <img src="{{ env('APP_URL') }}/static/done.png" style="display: none;" alt="">
                    </div>
                </div>
               <div class="title-price-bonus-holder">
                    <div class="bonusTitle"><span id="brand">{{$brand ?? ''}}</span> {{ $bonusTitle }}</div>
                    <span class="bonusPrice">{{$cost ?? '' }}&nbsp;{{env('CURRENCY')}}</span>

               </div>
            </div>
           <img class="rotate-toggler" id="toggleCategories" src="{{ env('APP_URL') }}/static/down-arrow.png">
        </div>
        <div class="bonusText ">{{ $bonusText }}
            <div class="bonusImg"><img class="bonus-img" src="{{env('APP_URL')}}/static/{{$icon}}"></div>
        </div>
    </div>

  @include('components.checkout.table.bonuses.buttons')
</div>

@push('body-js')
    <script src="{{ env('APP_URL') }}/js/checkout/form-bonuses.js"></script>
    <script>

        $(() => {

            const processCodCost = () => {
                const codButton = $('#cod-cost')
                cart.removeBonus(codButton.attr('data-sku'))

                if ($('a[data-payment="cod"]').hasClass('active')) {
                let  postagePrice = Number(codButton.attr('data-price'));
                $(".payment-label-price:first").text("+" + postagePrice + " " + currencySymbol);

                $(".payment-label-price:first").css("background", "#C21225");
                    cart.addBonus({
                        sku: codButton.attr('data-sku'),
                        name: codButton.attr('data-name'),
                        price: Number(codButton.attr('data-price')),

                    });
                }

                updateCheckoutOrder();
            }

            // processPostageCost()
            processCodCost()

            $('div.bonus-item').on('click', function (e) {
                if ($(e.target).is('.bonus-toggle-btn')) {
                    return
                }

                $(this).find('span.arrow').toggleClass('rotate')
                $(`div.description[data-desc="${$(this).attr('data-bonus')}"]`).slideToggle(300)
            });

            $('.payment-btn').on('click', function () {
                processCodCost()
            })

            $('.the-btn-1').on('click', function () {
                $(this).toggleClass('clicked')
                $(this).parents('.bonus').toggleClass('active');

                const sku = $(this).attr('data-sku')
                const price = Number($(this).attr('data-price'))
                const name = $(this).attr('data-name')

                if ($(this).hasClass('clicked') && !cart.hasBonus(sku)) {

                    cart.addBonus({ sku, price, name });

                    $(this).addClass('clicked')
                    $(this).text('{{ContentHelper::staticText('added')}}')
                }
                else {
                    cart.removeBonus(sku)

                    $(this).removeClass('clicked')
                    $(this).text('{{ContentHelper::staticText('add')}}')
                }

                displayBonuses()
            })


            $(window).on("load", function (){

                $('.mw75px').each(function() {
                    if ($(this).text().trim() === 'x') {
                        $(this).text('{{ContentHelper::staticText('gift') }}');
                    }
                 });
                $('.option-btn.active').find('input').attr('checked','checked');
            })
        })
    </script>
@endpush
