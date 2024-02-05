@php use App\Helpers\ContentHelper; @endphp


@include('components.checkout.table.delivery.delivery')
@include('components.checkout.table.payment.payment-options')
@include('components.checkout.table.bonuses.bonuses', ['bonusTitle' => ContentHelper::staticText('packageInsurance'), 'bonusText' => ContentHelper::staticText('productReplacement'), 'sku' => $feeHelper->packageInsuranceSku(), 'cost' => $feeHelper->packageInsuranceCost(), 'icon' => 'insurance.png'])
@if ($feeHelper->lifeInsuranceSku())
@include('components.checkout.table.bonuses.bonuses', ['bonusTitle' => ContentHelper::staticText('lifeInsurance'), 'bonusText' => ContentHelper::staticText('insuranceText2'), 'sku' => $feeHelper->lifeInsuranceSku(), 'cost' => $feeHelper->lifeInsuranceCost(), 'icon' => 'lifetimeInsurance.png', 'brand' => env('BRAND_NAME')])
@endif