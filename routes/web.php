<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

// page routes
$router->group(['prefix' => env('ROUTE_PREFIX')], function () use ($router) {
    $router->get('/', ['as' => 'page.index', 'uses' => 'PageController@index']);
    $router->get('/shop', ['as' => 'page.shop', 'uses' => 'PageController@index']);
    $router->get('/cart', ['as' => 'page.cart', 'uses' => 'PageController@cart']);
    $router->get('/checkout', ['as' => 'page.checkout', 'uses' => 'PageController@checkout']);
    $router->get('/thanks', ['as' => 'page.thanks', 'uses' => 'PageController@thanks']);
    $router->get('/crossell', ['as' => 'page.crossell', 'uses' => 'PageController@crossell']);
    $router->get('/about', ['as' => 'page.about', 'uses' => 'PageController@about']);
    $router->get('/getProducts', ['as' => 'page.products', 'uses' => 'PageController@getProducts']);
    $router->get('/tos/{link}', ['as' => 'page.tos', 'uses' => 'PageController@tos']);
    $router->get(
        '/' . env('PRODUCTS_PATH') . '/{slug}',
        ['as' => 'page.products', 'uses' => 'PageController@product']
    );
    $router->get(
        '/blog/'. env('PRODUCTS_PATH') . '/{slug}',
        ['as' => 'page.blog', 'uses' => 'PageController@blog']
    );
    $router->get('/404', ['as' => 'page.404', 'uses' => 'PageController@error404']);
    $router->get('/sitemap', 'SitemapController@index');
    
    // routes related to data fetching (hit by ajax)
    $router->group(['prefix' => 'data'], function () use ($router){
        $router->get('products', ['as' => 'data.products', 'uses' => 'DataController@products']);
        $router->get('search', ['as' => 'data.search', 'uses' => 'DataController@search']);
    });

    // routes related to data rendering (hit by ajax)
    $router->group(['prefix' => 'render'], function () use ($router){
        $router->post('cart/table', ['as' => 'render.cart.table', 'uses' => 'RenderController@cartTable']);
    });

    // routes related to abandoned orders (hit by ajax)
    $router->group(['prefix' => 'abandoned-order'], function () use ($router){
        $router->post('store', ['as' => 'abandoned-order.store', 'uses' => 'AbandonedOrderController@store']);
        $router->post('cancel', ['as' => 'abandoned-order.cancel', 'uses' => 'AbandonedOrderController@cancel']);
    });

    // routes related to order fill break (hit by ajax)
    $router->group(['prefix' => 'order-fill-break'], function () use ($router){
        $router->post('store', ['as' => 'order-fill-break.store', 'uses' => 'OrderFillBreakController@store']);
    });

    // routes related to payment processing
    // ---- Stripe
    $router->group(['prefix' => 'payment/stripe'], function () use ($router){
        $router->post('create-intent', ['as' => 'payment.stripe.create-intent', 'uses' => 'PaymentControllers\StripeController@createIntent']);
        $router->post('update-amount', ['as' => 'payment.stripe.update-amount', 'uses' => 'PaymentControllers\StripeController@updateAmount']);
    });

    // ---- PayPal
    $router->group(['prefix' => 'payment/paypal'], function () use ($router) {
        $router->post(
            'order',
            ['as' => 'payment.paypal.order', 'uses' => 'PaymentControllers\PayPalController@order']
        );
    });

    $router->group(['prefix' => 'coupons'], function () use ($router) {
        $router->post('validate', ['as' => 'coupons.validate', 'uses' => 'CouponController@validate']);
        $router->post('apply', ['as' => 'coupons.apply', 'uses' => 'CouponController@apply']);
    });

    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->post('create', ['as' => 'order.create', 'uses' => 'OrderController@create']);
        $router->post(
            'update-paypal-order',
            ['as' => 'order.paypal.update', 'uses' => 'OrderController@updatePaypalOrder']
        );
        $router->post(
            'update-klarna-order',
            ['as' => 'order.klarna.update', 'uses' => 'OrderController@updateKlarnaOrder']
        );
        $router->post(
            'update-cc-order',
            ['as' => 'order.cc.update', 'uses' => 'OrderController@updateCreditCardOrder']
        );
        $router->post(
            'crossell-order',
            ['as' => 'crossell.order', 'uses' => 'OrderController@crossellOrder']
        );
    });

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->post('register', ['as' => 'user.register', 'uses' => 'UserController@register']);
        $router->post('login', ['as' => 'user.login', 'uses' => 'UserController@login']);
        $router->post('parse', ['as' => 'user.parseJWT', 'uses' => 'UserController@parseJWT']);
    
        $router->group(['middleware' => 'user'], function () use ($router) {
            $router->get('profile', ['as' => 'user.profile', 'uses' => 'UserController@profile']);
            $router->get('orders', ['as' => 'user.orders', 'uses' => 'UserController@orders']);
            $router->post('setInfo', ['as' => 'user.setInfo', 'uses' => 'UserController@setInfo']);
        });
    
        $router->get('logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);
    });
    
    
    

});
