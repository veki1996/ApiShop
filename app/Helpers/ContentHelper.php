<?php

namespace App\Helpers;

use App\Helpers\External\ZohoHelper;
use Illuminate\Support\Facades\Cache;

class ContentHelper
{
    public static $CACHE_TIME = 2 * 60 * 60;

    public static function imgTxt(string $sku): array
    {
        $BLOCK = 36;

        $tmpl = request() -> input('tmpl');
        $version = request() -> input('version');

        $cacheKey = "product.$sku.containers.$BLOCK.processed.$tmpl.$version";
        if (Cache::has($cacheKey) && !request()->input('no-cache') == "true" ) {
            return Cache::get($cacheKey);
        }


        $containers = ProductHelper::getContainers($sku, $BLOCK);

        $imageContainers = array_values(
            array_filter($containers, function ($container) {
                return $container['type'] === 'image';
            })
        );
        $textContainers = array_values(
            array_filter($containers, function ($container) {
                return $container['type'] === 'text';
            })
        );

        $count = min([count($imageContainers), count($textContainers)]);

        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $image = array_shift($imageContainers)['text'];
            $text = array_shift($textContainers)['text'];

            $data[] = [
                'text'  => $text,
                'image' => strpos($image, 'ourshopcdn') !== false
                    ? $image
                    : env('APP_URL') . '/' . $image
            ];
        }

        Cache::put($cacheKey, $data, self::$CACHE_TIME);

        return $data;
    }

    public static function imgTxtUsage(string $sku): array
    {
        $BLOCK = 51;

        $tmpl = request() -> input('tmpl');
        $version = request() -> input('version');

        $cacheKey = "product.$sku.containers.$BLOCK.processed.$tmpl.$version";
        if (Cache::has($cacheKey) && !request()->input('no-cache') == "true") {
            return Cache::get($cacheKey);
        }

        $containers = ProductHelper::getContainers($sku, $BLOCK);

        $imageContainers = array_values(
            array_filter($containers, function ($container) {
                return $container['type'] === 'image';
            })
        );
        $textContainers = array_values(
            array_filter($containers, function ($container) {
                return $container['type'] === 'text';
            })
        );

        $count = min([count($imageContainers), floor(count($textContainers) / 2)]);

        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $image = array_shift($imageContainers)['text'];
            $heading = array_shift($textContainers)['text'];
            $paragraph = array_shift($textContainers)['text'];

            if (strlen($heading) > strlen($paragraph)) {
                [$heading, $paragraph] = [$paragraph, $heading];
            }

            $data[] = [
                'heading'       => $heading,
                'paragraph'     => $paragraph,
                'containerType' => 'imgtxtusage-img',
                'image'         => strpos($image, 'ourshopcdn') !== false
                    ? $image
                    : env('APP_URL') . '/' . $image
            ];
        }

        Cache::put($cacheKey, $data, self::$CACHE_TIME);

        return $data;
    }

    public static function gallery(string $sku): array
    {
        $BLOCK = 24;

        $containers = ProductHelper::getContainers($sku, $BLOCK);

        $imageContainers = array_values(
            array_filter($containers, function ($container) {
                return $container['type'] === 'image';
            })
        );

        $data = [];

        foreach ($imageContainers as $imageContainer) {
            $data[] = [
                'image' => strpos($imageContainer['text'], 'ourshopcdn') !== false
                    ? $imageContainer['text']
                    : env('APP_URL') . '/' . $imageContainer['text']
            ];
        }

        return $data;
    }

    public static function staticContent(): array
    {
        $cacheKey = "staticContent";

        if (!Cache::has("$cacheKey.processed") || !Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchStaticContent($cacheKey);
        }

        $data = [];

        foreach (Cache::get($cacheKey) as $name => $container) {
            $data[$name] = (object)$container;

            if (strpos($name, '_img_') !== false) {
                if ($container['type'] === 'image') {
                    if (strpos($container['text'], 'ourshopcdn') !== false || !$data[$name] -> text ) {
                        continue;
                    }

                    $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$container[text]"));

                    if (!is_file($imagePath)) {
                        $stored = @file_put_contents(
                            $imagePath,
                            file_get_contents("https://zoho-site.com/$container[text]")
                        );

//                        if (!$stored) {
//                            unset($data[$name]);
//                        }
                    }
                    $data[$name]->text = env('APP_URL') . "/{$data[$name] -> text}";
                }
            }
        }

        Cache::put("$cacheKey.processed", $data, self::$CACHE_TIME);

        return $data;
    }

    public static function staticTexts()
    {
        $cacheKey = "staticTexts";

        if (!Cache::has($cacheKey))  {
            (new ZohoHelper)->fetchStaticTexts($cacheKey);
        }

        return Cache::get($cacheKey);
    }

    public static function deliveryDate()
    {
        $cacheKey = "deliveryDate";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchDeliveryDate($cacheKey);
        }

        return Cache::get($cacheKey);
    }

    public static function eurRates($currency)
    {
        $cacheKey = "eurRates";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchEurRates($cacheKey);
        }

        $rates = json_decode(Cache::get($cacheKey), true);


        return $rates[strtolower($currency)]['rate'] ?? null;
    }

    public static function tosLinks()
    {
        $cacheKey = 'tosLinks';

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchTosLinks($cacheKey);
        }
        $tosLinks = Cache::get($cacheKey);

        if(!$tosLinks)
            return false;
        $data = [];

        foreach ($tosLinks as $name => $tosLink)
        {   //split link and get parameters
            $splitData = explode('?', $tosLink);
            $data[$name]['link'] = $splitData[0];
            $data[$name]['params'] = $splitData[1] ?? null;
        }
        return $data;
    }

    public static function staticText($key, $replacements = [])
    {
        $defaultValue = env('APP_ENV') === 'production'
            ? ''
            : "[MISSING STATIC TEXT FOR KEY '$key']";

        return strtr(self::staticTexts()[$key] ?? $defaultValue, $replacements);
    }

    public static function banners()
    {
        $cacheKey = "banners";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchBanners($cacheKey);
        }

        if (!Cache::has($cacheKey))  {
            return null;
        }

        return Cache::get($cacheKey);
    }

    public static function allContainers(string $sku): array
    {
        $tmpl = request() -> input('tmpl');
        $version = request() -> input('version');

        $cacheKey = "allContainers.$sku.$tmpl.$version";

        if (!Cache::has("$cacheKey.processed") || !Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchAllProductContainers($cacheKey, $sku, $tmpl, $version);
        }

        $data = self::manageContainers(Cache::get($cacheKey));

        Cache::put("$cacheKey.processed", $data, self::$CACHE_TIME);

        return $data;
    }

    public static function dynamicContainers(string $sku, string $wildcard): string
    {
        $tmpl = request() -> input('tmpl');
        $version = request() -> input('version');

        $cacheKey = "dynamic-containers.$sku.$wildcard.$tmpl.$version";

        if (!Cache::has($cacheKey) || request()->input('no-cache') == "true" ) {
            (new ZohoHelper)->fetchDynamicContainers($cacheKey, $sku, $wildcard, $tmpl, $version);
        }

        if(isset(Cache::get($cacheKey)['html']) && strpos(Cache::get($cacheKey)['html'], 'images/') !== false)
        {
            $data['html'] = str_replace(env('APP_URL') . "/", "", Cache::get($cacheKey)['html']);
            $data['html'] = str_replace('images/', env('APP_URL') . "/images/", $data['html']);
            Cache::put($cacheKey, $data, self::$CACHE_TIME);
        }

        if(isset(Cache::get($cacheKey)['html'])) return Cache::get($cacheKey)['html'];
        return false;

    }

    private static function manageContainers($containers): array
    {
        $data = [];
        foreach ($containers as $container) {

            $name = $container['name'];

            $data[$name] = (object)$container;

            if(strpos($name, '_img_') !== false)
            {
                if ($container['type'] === 'image') {
                    if (strpos($container['text'], 'ourshopcdn') !== false || !$data[$name] -> text) {
                        continue;
                    }

                    $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$container[text]"));

                    if (!is_file($imagePath)) {
                        $stored = @file_put_contents(
                            $imagePath,
                            file_get_contents("https://zoho-site.com/$container[text]")
                        );
                    }
                    $data[$name] -> text = env('APP_URL') . "/{$data[$name] -> text}";
                }
            }
            if(strpos($name, '_vid_') !== false)
            {
                $data[$name] -> text = str_replace('autoplay muted', 'autoplay muted playsinline', $data[$name] -> text);
            }
        }
        return $data;
    }
}
