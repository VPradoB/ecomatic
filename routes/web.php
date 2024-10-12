<?php

use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which+
| contains the "web" middleware group. Now create something great!
|
*/
//Authentication routes...
Route::get('login',                                                 'Auth\LoginController@showLoginForm')->name(            'login');
Route::post('login',                                                'Auth\LoginController@login');
Route::post('logout',                                               'Auth\LoginController@logout')->name(                   'logout');
Route::get('logout',                                                'Auth\LoginController@logout');



Route::match(['get','post'],'machine',       'Api\MachineController@view')          ->name('machine.view');

Route::get('/',             'HomeController@index')                 ->name('home');
Route::get('configuration', 'Api\ConfigurationController@view')     ->name('configuration.view');
Route::get('product',       'Api\ProductController@view')           ->name('product.view');
Route::get('sale',          'Api\SaleController@view')              ->name('sale.view');
Route::get('publicity',     'Api\PublicityController@view')         ->name('publicity.view');
Route::get('company',       'Api\CompanyController@view')           ->name('company.view');
Route::get('user',       'Api\UserCreateController@view')           ->name('user.view');
Route::get('stat',          'Api\StatController@view')              ->name('stat.view');
Route::get('stat/report',   'Api\StatController@Report')            ->name('stat.report.view');
Route::post('machines/sales','Api\MachineController@salesByDateRange')->name('machine.sales.report');
Route::post('machines/stats/alert','Api\MachineController@alertByDateRange')->name('machine.alert.report');
Route::post('product/sales','Api\ProductController@salesByDateRange')->name('product.sales.report');
Route::post('sale',         'Api\SaleController@indexByDateRange')  ->name('sales.report');
Route::post('stat/alert',   'Api\StatController@indexAlertByDateRange')  ->name('stat.alert.report');


Route::get('files/{filename}', function ($filename)
{
    if(!Storage::exists('files/'.$filename))  return response('File not found.',404);
    $contents = Storage::get('files/'.$filename);
    $response = Response::make($contents, 200);
    return $response->header("Content-Type", Storage::mimeType('files/'.$filename));
});