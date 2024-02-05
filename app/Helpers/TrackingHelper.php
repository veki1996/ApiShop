<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use stdClass;

class TrackingHelper
{
    public static function pixels(stdClass $trackingCodes, Request $request): array
    {
        if ($request->input('tikpix')) {
            $trackingCodes->tikTok = $request->input('tikpix');
        }
        if ($request->input('utm_pix')) {
            $trackingCodes->fbCode = $request->input('utm_pix');
        }
        if ($request->input('utm_aw')) {
            $trackingCodes->awCode = explode('|', $request->input('utm_aw'))[0];
        }
        if ($request->input('utm_aw')) {
            $trackingCodes->awConvLabel = explode('|', $request->input('utm_aw'))[1];
        }

        $pixels = [];
        if (!$request->input('fbclid') && !$request->input('ttclid')) {
            $pixels[] = 'ga';
        }
        if (!$request->input('fbclid') && !$request->input('gclid')) {
            $pixels[] = 'tiktok';
        }
        if (!$request->input('gclid') && !$request->input('ttclid')) {
            $pixels[] = 'fb';
        }
        if ($trackingCodes->pinterest) {
            $pixels[] = 'pinterest';
        }
        if($trackingCodes->clarityCode)
        {
            $pixels[] = 'clarity';
        }
        if(isset($trackingCodes->smartlook))
        {
            $pixels[] = 'smartlook';
        }

        return $pixels;
    }
}
