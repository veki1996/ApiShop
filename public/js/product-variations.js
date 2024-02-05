"use strict"

function findValidCombination(selector) {
    let selectedVariation = selector.find('.active');

    if(selectedVariation.length != selector.find('.property-select-div').length) return false;

    let variationIDs = [];
    let sku = null;

    selectedVariation.each(function() {
        variationIDs.push($(this).data('variation-id'));
    });

    combinations.forEach(function(comb) {
        let pairedCombLength = 0;
        variationIDs.forEach(function(el) {
            if(comb.variations.includes(el)) pairedCombLength++;
        });

        if(pairedCombLength == variationIDs.length) sku = comb.sku;
    });


    return sku;
}

function updateSelectedCombinations() {
    let skus = [];


    $('.mainSelector').each(function() {
        if($(this).css('display') == 'none') return;

        let sku = findValidCombination($(this));

        if(sku) skus.push(sku);
    });

    selectedCombinations = skus;
}

$('button').on('click', function() {

    let propertyId = $(this).data('property-id');
    let variationId = $(this).data('variation-id');
    let mainSelectorParent = $(this).parents('.mainSelector').first();

    let availableVariations = combinations.filter(function(combination) {
        return combination.variations.includes(variationId) && combination.instock;
    });

    if (Object.keys(availableVariations).length === 0) {
        let self = this;
        $(self).closest('.is-large').find('.outOfStock').show();
        setTimeout(function() {
            $(self).closest('.is-large').find('.outOfStock').hide();
        }, 1100);
        return;
    }


    mainSelectorParent.find('button').each(function() {
        removeClasses($(this));
        let buttonDataVariationId = $(this).data('variation-id');
        let buttonPropertyId = $(this).data('property-id');
        if (availableVariations.some(combination => combination.variations.includes(buttonDataVariationId))) {

            handleWithClassess($(this));

        } else {
            if (buttonPropertyId !== propertyId) {
                $(this).addClass('notInStock');
                $(this).removeClass('active');
            }

        }
    });

    $(this).parent().find('.color-item').removeClass('invalid_prop active');
    $(this).parent().parent().parent().find('.select_property').hide();
    $(this).addClass('active');

    updateSelectedCombinations();
    
    if (location.href.includes(productPath) && getUrlParam('flow') === 'direct') {
        cart.reset();
        $(".add-to-cart").trigger("click");
        updateCheckoutOrder();
    }

});

function removeClasses(button) {
    button.removeClass('inStock');
    button.removeClass('notInStock');
}

function handleWithClassess(button) {
    button.removeClass('notInStock');
    button.addClass('inStock');
}
