<?php

namespace App\Entities;

use Illuminate\Support\Arr;
use stdClass;

/**
 * Product object and its attributes and helper methods.
 */
class Product
{
    public $name;
    public $shortSku;
    public $longSku;
    public $image;
    public $prices;
    public $slug;
    public $shortDescription;
    public $longDescription;
    public $quantity;
    public $categories;
    public $fbCategories;
    public $googleCategories;
    public $deliveryDay;
    public $deliveryDate;
    public $subtemplate;
    public $external;
    public $isNew;
    public $msId;
    public $utm_pod;
    public $longName;
    public $deliveryDisplay;
    public $pageLink;
    public $favouriteImages;
    public $hasContent;
    public $complementaryProducts;
    public $realName;
    public $productGeoLinks;

    public function __construct(
        string $name,
        string $shortSku,
        string $longSku,
        string $image,
        stdClass $prices,
        ?string $slug = '',
        ?string $shortDescription = '',
        ?string $longDescription = '',
        ?int $quantity = 0,
        ?array $categories = [],
        ?array $fbCategories = [],
        ?array $googleCategories = [],
        ?string $deliveryDay = '',
        ?string $deliveryDate = '',
        ?string $subtemplate = '',
        ?bool $external = false,
        ?int $isNew = 0,
        ?string $msId = null,
        ?array $complementaryProducts = [],
        ?string $utm_pod = '',
        ?array $favouriteImages  = [],
        ?array $hasContent = [],
        ?string $realName = '',
        ?array $productGeoLinks = []
    ) {

        $this->name = $name;
        $this->shortSku = $shortSku;
        $this->longSku = $longSku;
        $this->image = $image;
        $this->prices = $prices;
        $this->slug = $slug;
        $this->shortDescription = $shortDescription;
        $this->longDescription = $longDescription;
        $this->quantity = $quantity;
        $this->categories = $categories;
        $this->fbCategories = $fbCategories;
        $this->googleCategories = $googleCategories;
        $this->deliveryDay = $deliveryDay;
        $this->deliveryDate = $deliveryDate;
        $this->subtemplate = $subtemplate;
        $this->external = $external;
        $this->isNew = $isNew;
        $this->msId = $msId;
        $this->utm_pod = $utm_pod;
        $this->favouriteImages = $favouriteImages;
        $this->hasContent = $hasContent;
        $this->realName = $realName;
        $this->productGeoLinks = $productGeoLinks;

        $this->longName = $this->name . ($this->shortDescription ? "-$this->shortDescription" : '');
        $this->deliveryDisplay = !empty($this->deliveryDay) && !empty($this->deliveryDate)
            ? strtoupper($this->deliveryDay) . ', ' . $this->deliveryDate
            : '';
        $this->pageLink = $this->external
            ? sprintf("%s/%s_%s", env('PRODUCTS_PATH'), $this->slug, $this->shortSku)
            : $this->slug;

        // adding decimals artificially
        if (!empty($this->prices->undiscounted) && is_numeric($this->prices->undiscounted)) {
            $this->prices->undiscounted -= 0.01;
        }

        $this->complementaryProducts = array_map(
            function($cProductData) {
                return Product::fromApiData($cProductData);
            },
            $complementaryProducts ?: []
        );
    }

    public static function fromApiData(?array $data): ?Product
    {
        if (!$data) {
            return null;
        }
       
        // store image locally, if not from CDN
        $imageLink = $data['mainImage'];

        if (strpos($imageLink, 'ourshopcdn') === false) {
            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$imageLink"));

            if (!is_file($imagePath)) {
                @file_put_contents(
                    $imagePath,
                    file_get_contents("https://zoho-site.com/$imageLink")
                );
            }

            $imageLink = env('APP_URL') . "/$imageLink";
        }

        if(isset($data['favouriteImages']))  Product::processFavouritesImages($data['favouriteImages']);
       
        $discount = $data['prices']['ud_price'] ? intval(
            100 * ($data['prices']['ud_price'] - $data['prices']['1x']) / $data['prices']['ud_price']
        ) : round($data['prices']['1x'] * 0.3, 2);

        return new Product(
            $data['name'],
            implode('-', array_slice(explode('-', $data['fullSku']), 0, 2)),
            $data['fullSku'],
            $imageLink,
            (object)array_replace(
                array_diff_key($data['prices'], ['1x' => null, '2x' => null, '3x' => null]),
                [
                    'forOne'       => $data['prices']['1x'],
                    'forTwo'       => $data['prices']['2x'],
                    'forThree'     => $data['prices']['3x'],
                    'undiscounted' => $data['prices']['ud_price'],
                    'discount'     => $discount
                ]
            ),
            $data['slug'],
            $data['shortDescription'],
            $data['longDescription'],
            $data['quantity'],
            $data['categories'],
            $data['fbCategories'],
            $data['googleCategories'],
            $data['deliveryDay'] ?? '',
            $data['deliveryDate'] ?? '',
            $data['subtemplate'] ?? '',
            $data['external'] ?? false,
            $data['isNew'] ?? 0,
            $data['mailStormId'] ?? null,
            @$data['complementaryProducts'] ?? [],
            $data['utm_pod'] ?? '',
            $data['favouriteImages'] ?? [],
            $data['hasContent'] ?? [],
            $data['realName'] ?? '',
            $data['productGeoLinks'] ?? [],

        );
    }

    private static function processFavouritesImages($images)
    {
       foreach($images as $image)
       {
        if (strpos($image, 'ourshopcdn') === false) {
            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$image"));

            if (!is_file($imagePath)) {
                @file_put_contents(
                    $imagePath,
                    file_get_contents("https://zoho-site.com/$image")
                );
            }

            $image = env('APP_URL') . "/$image";
        }
       }
    }
}

