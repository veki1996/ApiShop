

@push('body-js')
    <script>

    const displayBonuses = () => {
        const servicesDiv = $('#services')
        const bonusDiv = `<div class="item-row flex row" data-sku="{sku}">
                                <div class="cell mw245px">{name}</div>
                                <div class="cell mw75px"></div>
                                <div class="cell mw160px">{price} {{env('currency')}}</div>
                            </div>`

        let bonusDisplay = ''
        cart.bonuses.forEach(b => {
            bonusDisplay += bonusDiv.replace('{sku}', b.sku).
                replace('{name}', b.name).
                replace('{price}', b.price)
        })

        $('#bonus-display').html(bonusDisplay)

        cart.bonuses.length < 1 ? servicesDiv.hide() : servicesDiv.show()
        $('.checkout_total_price').text(`${cart.totalPrice} {{env('CURRENCY')}}/`)
    }

    // ADD/REMOVE SURPRISE-PACKAGE
    $("#surprise-gift").on("change", function (){
        if($(this).prop("checked") ) {
            //add bonus
            cart.addBonus({
                name: $(this).attr('data-product'),
                price: Number($(this).attr('data-price')),
                sku: $(this).attr('data-sku')
            })

            displayBonuses()
            return;
        }
        // remove bonus
        cart.removeBonus($("#surprise-gift").attr('data-product'))
        cart.removeBonus($("#surprise-gift").attr('data-price'))
        cart.removeBonus($("#surprise-gift").attr('data-sku'))

        displayBonuses()
    });

    </script>
@endpush

