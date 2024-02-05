<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\UserAuthHelper;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {   
        $session_key = 'session_key'.env('BRAND_NAME');
        $cookieData = ['session_key' => $request->cookie($session_key)];
        $user = UserAuthHelper::getUser($cookieData, '/info');
     
        if($user->message != "Done")
        {
            UserAuthHelper::logout($session_key);
            return redirect(route('page.index'));
        }
        
        return $next($request);
    }
}
