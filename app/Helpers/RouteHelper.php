<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View as ViewFacade;

class RouteHelper
{
    public static function appendParameters(): string
    {
        $excludeParameters = ['utm_pod', 'type', 'q', 'category'];
        $queryParameters = array_diff_key(request()->query(), array_flip($excludeParameters));
        $queryString = http_build_query($queryParameters);

        return $queryString ? '?' . $queryString : '?';
    }

   public static function setTemplateForProductAndAddParametersToReq($subtemplate, $hasContentForTemplate, $request)
    {
         if($result = self::firstCheckRequestQParameters($request, $hasContentForTemplate))
         {
             return $result;
         }

         if(env('BRAND_NAME') != 'Alozzi')
         {
            
            $subtemplateParts = explode(' ', $subtemplate);

            if (is_array($subtemplateParts) && count($subtemplateParts) === 2) {

                [$subtemplateName, $subtemplateVersion] = $subtemplateParts;

                if (array_key_exists($subtemplateName, $hasContentForTemplate)) {
                    $request->merge(["tmpl" => $subtemplateName, "version" => $subtemplateVersion]);
                    return "$subtemplateName.$subtemplateName";
                } else {
                    return 'tmpl_new_alozzi.tmpl_new_alozzi';
                }
            }
         }

         return 'tmpl_new_alozzi.tmpl_new_alozzi';
    }

   public static function firstCheckRequestQParameters($request, $hasContentForTemplate)
    {
        if ($request->has('tmpl')) {
            $subtemplateName = $request->input('tmpl');
            $subtemplateVersion = $request->input('version') ?? $request->input('version');

            $request->merge(["tmpl" => $subtemplateName, "version" => $subtemplateVersion]);
            return array_key_exists($subtemplateName, $hasContentForTemplate) ? "$subtemplateName.$subtemplateName" : 'tmpl_new_alozzi.tmpl_new_alozzi';
        }

        return false;
    }

   public static function setTemplateIfDontHaveReqParOrBPsubtemplateAndHasContent($subtemplate, $request)
    {

        $subtemplate = @ViewFacade::exists("subtemplates.$subtemplate")
        ? $subtemplate
        : 'tmpl_new_alozzi.tmpl_new_alozzi';

        if($subtemplate == 'tmpl_new_alozzi.tmpl_new_alozzi' && ($request->has('flow') && $request->input('flow') == 'direct'))
        {
            $subtemplate = 'maa_tmpl_2b.maa_tmpl_2b';
        }

        return $subtemplate;
    }
}
