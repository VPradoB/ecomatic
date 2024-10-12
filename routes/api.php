<?php

use Illuminate\Http\Request;

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

//Route::get('/user', function (Request $request) {
    //    return $request->user();
    //})->middleware('auth:api');



Route::group(['prefix' => 'stat'], function () {

    Route::post('/', 'Api\StatController@all');
    Route::post('hour', 'Api\StatController@addStat');
    Route::get('day/{machine_id}', 'Api\StatController@getByMachineId');
});

Route::group(['prefix' => 'machine'], function () {
    Route::get('/','Api\MachineController@index');
    Route::post('tank', 'Api\TankController@addTankValues');
    Route::get('tank/{machine}', 'Api\TankController@getByMachineId');
    Route::post('tank/alert', 'Api\TankController@alertByThreshold');
    Route::post('tank/exhausted', 'Api\TankController@alertByExhausted');
    route::put('/{machine}','Api\MachineController@update');
    route::get('/{machine}','Api\MachineController@show');
    route::post('/','Api\MachineController@store');
    Route::get('{machine}/tanks', 'Api\MachineController@getTanks');
    Route::get('/{machine}/tanksWhitProduct','Api\MachineController@getTanksWhitProduct');
    Route::get('/{mac}/tanksWhitProductByMac','Api\MachineController@getTanksWhitProductByMac');
});
route::delete('/machine/{machine}','Api\MachineController@destroy');
Route::get('machine/scopeByMac/{mac}','Api\MachineController@showByMac');

Route::get('/machines/sales/totalAmount','Api\MachineController@getMachinesSales');
Route::get('/products/sales/totalAmount','Api\ProductController@getProductsSales');
Route::get('/machine/{machine}/sales/totalAmount', 'Api\MachineController@getSalesByYear');
Route::get('/machine/{machine}/products','Api\MachineController@getProductsByMonth');
Route::get('machine/{mac}/publicity','Api\MachineController@getPublicity');
Route::get('storage/{archivo}','Api\PublicityController@getResources');

Route::get('/tank','Api\TankController@all');
Route::post('/tank', 'Api\TankController@store');
Route::post('/tank/forTable', 'Api\TankController@storeforTable');
Route::put('/tank/{tank}', 'Api\TankController@update');
Route::get('/tank/{tank}', 'Api\TankController@show');
Route::put('/tank/{tank}/forTable', 'Api\TankController@updateForTable');
Route::get('/tank/{tank}/destroy','Api\TankController@destroy');
Route::put('/tank/{tank}/toggleAlert','Api\TankController@toggleAlert');

//Products Route's...
Route::resource('product','Api\ProductController',['except'=>['create','edit']]);
Route::post('product/{product}','Api\ProductController@update');
//Configuration Route's...
Route::resource('configuration','Api\ConfigurationController',['except'=>['create','edit']]);

//Sale Route's...
Route::resource('sale','Api\SaleController',['only'=>['index','show','store']]);
Route::post('tank/{tank}/reporte','Api\TankController@reporte');
//Publicity Route's...
Route::resource('publicity','Api\PublicityController',['except'=>['create','edit']]);
Route::post('publicity/{publicity}','Api\PublicityController@update');
Route::post('publicity/{publicity}/attachMachine','Api\PublicityController@attachMachine');
Route::post('publicity/{publicity}/detachMachine','Api\PublicityController@detachMachine');
Route::get('publicity/{publicity}/showMachines','Api\PublicityController@getMachines');

//Company Route's...
Route::resource('company','Api\CompanyController',['except'=>['create','edit']]);




