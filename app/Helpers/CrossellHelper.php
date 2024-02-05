<?php

namespace App\Helpers;

use App\Helpers\External\ZohoHelper;
use App\Exceptions\CrossellException;
use Illuminate\Support\Facades\Cache;

class CrossellHelper
{
    public $type;
    public $template;
    public $pricePoint;
    public $query;
    public $thanksType;
    public $products;

    public function __construct($cacheKey)
    {
        if(!Cache::has($cacheKey) || request()->input('no-cache') == "true")
        {
            $data = (new ZohoHelper())->fetchCrossellData($cacheKey);
            
            if (!$data) {
                throw new CrossellException('Crossell data could not be fetched from Zoho');
            }
        }  

        $data = Cache::get($cacheKey);
        
        $this->type       = $data['type'];
        $this->template   = $data['template'];
        $this->pricePoint = $data['price_point'];
        $this->query      = $data['query'];
        $this->thanksType = $data['thanks_type'];
        $this->products   = $data['products'];
    }
   
}
