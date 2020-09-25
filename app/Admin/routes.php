<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', 'CategoriesController');
    $router->resource('products', 'ProductsController');
    $router->get('products/{product}/skus', 'ProductsController@skusIndex');
    $router->put('products/{productId}/skus/{productSkuId}', 'ProductsController@skuUpdate');
    $router->resource('product-param-types', 'ProductParamTypeController');
    $router->resource('wechat-users', 'WechatUsersController');
    $router->resource('freights', 'FreightsController');
});
