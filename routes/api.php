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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@login')->name('login');
Route::post('register', 'API\AuthController@register')->name('register');

Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    Route::get('user', 'API\AuthController@user');
    Route::post('logout', 'API\AuthController@logout');
});
Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');

Route::group(['prefix' => '/customers', 'middleware' => 'jwt.auth'], function(){
    Route::get('/', 'API\CustomerController@getAll')->name('customers.index');
    Route::get('/search', 'API\CustomerController@getAll')->name('customers.index');
    Route::get('/count', 'API\CustomerController@getTotal')->name('customers.total');
});

Route::group(['prefix' => '/webhooks'], function(){
    Route::post('/confirmaPagamento/{module}', 'API\InvoiceController@confirmPayment')->name('invoice.confirm-payment.webhook');
});