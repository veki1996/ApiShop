<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController
{
    public function index()
    {   
        $appUrl = env('APP_URL');
        Sitemap::create()
            ->add(Url::create($appUrl.'/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/shop')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/cart')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/checkout')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/thanks')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/crossell')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/about')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/blog/'. env('PRODUCTS_PATH') . '/1')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/tos/{link}')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create($appUrl.'/' . env('PRODUCTS_PATH') . '/1')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->writeToFile(app()->basePath('public') . '/sitemap.xml');

            $path = env('APP_URL'). '/sitemap.xml';
            return redirect($path);

    }
}
