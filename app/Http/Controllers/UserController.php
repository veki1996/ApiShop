<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UserAuthHelper;

class UserController
{
    public $session_key;

    public function __construct()
    {
        $this->session_key = 'session_key' . env("BRAND_NAME");
    }

    public function register(Request $request)
    {   
        return response()->json(UserAuthHelper::goZoho($request->all(), '/register'));
    }

    public function login(Request $request)
    {
        return response()->json(UserAuthHelper::goZoho($request->all(), '/login'));
    }

    public function setInfo(Request $request)
    {
        $request->merge(['session_key' => $request->cookie($this->session_key)]);
        UserAuthHelper::goZoho($request->all(), '/info/set');
        return redirect(route('user.profile'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function orders(Request $request)
    {
        $userOrders = UserAuthHelper::goZoho(['session_key' => $request->cookie($this->session_key)], '/orders');
        UserAuthHelper::proccessImagesForOrders($userOrders);
        return view('user.orders', ['userOrders' => $userOrders]);
    }

    public function logout()
    {
        UserAuthHelper::logout($this->session_key);
        return redirect(route('page.index'));
    }

    public function parseJWT(Request $request)
    {   
        $userData = UserAuthHelper::parseJWT($request->credential);
        return response()->json(UserAuthHelper::goZoho($userData, '/login'));
    }
}
