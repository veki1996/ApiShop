<?php

namespace App\Helpers;

use App\Helpers\External\ZohoHelper;
use Illuminate\Support\Facades\Cache;
use stdClass;

class MetaHelper
{
    public static function contactInfo(): stdClass
    {
        if (!Cache::has('contact-info') || request()->input('no-cache') == "true") {
            (new ZohoHelper())->fetchContactInfo();
        }

        return (object)Cache::get('contact-info');
    }

    public static function trackingCodes(): stdClass
    {
        if (!Cache::has('tracking-codes') || request()->input('no-cache') == "true") {
            (new ZohoHelper())->fetchTrackingCodes();
        }

        return (object)Cache::get('tracking-codes');
    }
}
