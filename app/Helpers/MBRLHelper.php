<?php

namespace App\Helpers;

/**
 * Class with methods for dealing with MBRL codes
 */
class MBRLHelper
{
    /**
     * @var string[] Mapping between MBRL codes and price points
     */
    public static $MAP = [
        'b3B0' => 'optimal',
        'cHAy' => 'p2',
        'cHAz' => 'p3',
        'cHVz' => 'upsell',
        'cG5h' => 'noAd',
        'cG5z' => 'noShip',
        'bmFz' => 'noAdNoShip',
        'cHJl' => 'premium',
        'cE14' => 'pMax'
    ];


    /**
     * Returns price point for given MBRL code
     *
     * @param string $code
     * @return string|null
     */
    public static function decode(string $code): ?string
    {
        return self::$MAP[$code] ?? null;
    }

    /**
     * Returns MBRL code for given price point
     *
     * @param string $pricePoint
     * @return string|null
     */
    public static function encode(string $pricePoint): ?string
    {
        return array_flip(self::$MAP)[$pricePoint] ?? null;
    }
}
