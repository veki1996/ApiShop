<?php

namespace App\Helpers;

use App\Helpers\External\ZohoHelper;
use Illuminate\Support\Facades\Cache;

class FeeHelper
{
    private $feesData;
    private $freeShippingData;

    public function __construct()
    {
        if (!Cache::has('feesData') || request()->input('no-cache') == "true") {
            ZohoHelper::fetchFeesData();
        }

        $this->feesData = Cache::get('feesData');


        if (!Cache::has('freeShippingData') || request()->input('no-cache') == "true") {
            (new ZohoHelper())->fetchFreeShippingData();
        }

        $this->freeShippingData = Cache::get('freeShippingData');
    }

    public function codSku()
    {
        return $this->feesData['codSku'];
    }

    public function packageInsuranceSku()
    {
        return $this->feesData['packageInsuranceSku'];
    }

    public function priorityDeliverySku()
    {
        return $this->feesData['priorityDeliverySku'];
    }

    public function yearInsuranceSku()
    {
        return $this->feesData['yearInsuranceSku'];
    }

    public function postageSku()
    {
        return $this->feesData['postageSku'];
    }

    public function codCost()
    {
        return $this->feesData['codCost'];
    }

    public function packageInsuranceCost()
    {
        return $this->feesData['packageInsuranceCost'];
    }

    public function priorityDeliveryCost()
    {
        return $this->feesData['priorityDeliveryCost'];
    }

    public function yearInsuranceCost()
    {
        return $this->feesData['yearInsuranceCost'];
    }

    public function postageCost()
    {
        return $this->feesData['postageCost'];
    }

    public function isFreeShippingActive()
    {
        return $this->freeShippingData['active'];
    }

    public function freeShippingThreshold()
    {
        return $this->isFreeShippingActive()
            ? $this->freeShippingData['threshold']
            : null;
    }

    public function getPostageData()
    {
        return json_encode([
           'sku' => $this->postageSku(),
           'name' => ContentHelper::staticText('postage'),
           'price' => $this->postageCost()
        ]);
    }

    public function lifeInsuranceSku()
    {
        return $this->feesData['ltwrSku'] ?? false;
    }

    public function lifeInsuranceCost()
    {
        return $this->feesData['ltwrCost'] ?? false;
    }
}
