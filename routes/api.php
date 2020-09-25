<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//  上传资源
Route::post('resources', 'ResourcesController@store')->name('resources.store');

//  - 全局运费设置
Route::get('global-freight-setting', 'GlobalFreightSettingController@index')->name('global-freight-setting.index');
Route::post('global-freight-setting', 'GlobalFreightSettingController@store')->name('global-freight-setting.store');