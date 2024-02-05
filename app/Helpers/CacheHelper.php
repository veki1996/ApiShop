<?php

namespace App\Helpers;

class CacheHelper 
{

    public static function checkCache($request, $functionName)
    {   

        $parameters = explode(',', $request);
       
        if (in_array($functionName, $parameters)) {
            return true;
        }

        return false;
    }


}