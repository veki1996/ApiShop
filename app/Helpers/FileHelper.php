<?php

namespace App\Helpers;

class FileHelper
{
    /**
     * Stores images from CMS links to local public directory
     *
     * @param array $images
     * @return void
     */
    public static function storeImagesLocally(array $images)
    {
        foreach ($images as $image) {
            if (strpos($image, '.') === false) {
                continue;
            }

            $imagePath = str_replace('/', DIRECTORY_SEPARATOR, base_path("public/$image"));
            if (!is_file($imagePath)) {
                @file_put_contents($imagePath, file_get_contents(env('CMS_URL') . "/$image"));
            }
        }
    }
}
