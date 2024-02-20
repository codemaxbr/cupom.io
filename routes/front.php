<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'Front\HomeController@index')->name('index');

Route::get( '/cliente/login', 'Front\LoginController@showLoginForm')->name('cliente.login');
Route::post('/cliente/login', 'Front\LoginController@login')->name('cliente.login.submit');

Route::get('auth/{provider}', 'Front\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Front\LoginController@handleProviderCallback');

Route::prefix('/checkout')->group(function(){
    Route::get('/', 'Front\CheckoutController@index')->name('checkout');
    Route::post('/assinatura/{uuid}', 'Front\CheckoutController@addToCart')->name('checkout.assinatura');
    Route::post('/login', 'Front\CheckoutController@login')->name('checkout.login');
    Route::post('/cadastro', 'Front\CheckoutController@register')->name('checkout.register');

    Route::get('/assinatura/pagamento', 'Front\CheckoutController@stepPayment')->name('checkout.pagamento');
    Route::post('/finalizado', 'Front\CheckoutController@finishSubscription')->name('checkout.finished');

});

Route::middleware('auth:front')->group(function () {

    // Dashboard Routes...
    Route::get('/teste', 'Front\HomeController@index')->name('cliente.home');

});