<?php

namespace App\Providers;

use App\Helpers\MetaHelper;
use App\Helpers\ContentHelper;
use App\Helpers\ProductHelper;
use App\Helpers\TrackingHelper;
use App\Helpers\UserAuthHelper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class CommonVariablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(Request $request)
    {   
        $session_key = 'session_key'.env('BRAND_NAME');

        if ($request->cookie($session_key)) {
            $cookieData = ['session_key' => $request->cookie($session_key)];
            $user = UserAuthHelper::getUser($cookieData, '/info');
        } 

        $contactInfo = MetaHelper::contactInfo();
        $email       = $contactInfo->email ?? '';
        $phone       = $contactInfo->phone ?? '';
        $viberNumber = $contactInfo->viber ?? '';
        $whatsappNumber = $contactInfo->whatsapp ?? '';
        $trackingCodes  = MetaHelper::trackingCodes();
        $pixels  = TrackingHelper::pixels($trackingCodes, $request);
        $company = base64_encode(strtolower(env('COMPANY_NAME')));
        $encodedCountry = base64_encode(env('COUNTRY_CODE'));

        $tosLink = (env('APP_ENV') === 'local' ? 'https://dokishop.hr' : env('APP_URL'))
            . "/tos.php?cCode=$encodedCountry=&cmpn=$company&cml='$email'&pageOpening=1";

        $tosLinks  = ContentHelper::tosLinks();
        $orderCode = 'b3B0'; // pull from somewhere?
        $category  = null;
        if (str_contains(URL::current(), '/shop') && $request->input('category')) {
            $category = 'wsa' . $request->input('category');
        }

        $categories   = ProductHelper::getCategories(env('COUNTRY_CODE')); // return empty array
        $categoryName = @$categories[$category] ? @$categories[$category]->name : '';
        $mainCategories  = [];
        $nicheCategories = [];

        foreach ($categories as $category) {
            if (isset($category->is_niche) && $category->is_niche ) {
                $nicheCategories[] = $category;
            } else {
                $mainCategories[] = $category;
            }
        }
        
        // Share the variables with all views
        $this->app['view']->share('email', $email);
        $this->app['view']->share('phone', $phone);
        $this->app['view']->share('viberNumber', $viberNumber);
        $this->app['view']->share('whatsappNumber', $whatsappNumber);
        $this->app['view']->share('trackingCodes', $trackingCodes);
        $this->app['view']->share('pixels', $pixels);
        $this->app['view']->share('tosLink', $tosLink);
        $this->app['view']->share('tosLinks', $tosLinks);
        $this->app['view']->share('company', $company);
        $this->app['view']->share('orderCode', $orderCode);
        $this->app['view']->share('categories', $categories);
        $this->app['view']->share('categoryName', $categoryName);
        $this->app['view']->share('mainCategories', $mainCategories);
        $this->app['view']->share('nicheCategories', $nicheCategories);
    
        if(isset($user)) {
            $this->app['view']->share('user', $user);
        }
    }
}
