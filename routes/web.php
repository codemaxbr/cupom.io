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

Route::get('/', 'Front\HomeController@index')->name('front.home');

// Registration Routes...
//Route::get( '/cadastro', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('/cadastro', 'Auth\RegisterController@register');
//Route::get( '/cadastro/ativacao/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

// Authentication Routes...
Route::get( '/painel/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/painel/login', 'Auth\LoginController@login');
Route::post('/painel/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get( 'password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get( 'password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/conta-invalida', 'HomeController@contaInvalida')->name('account.invalid');

Route::group(['prefix' => '/painel', 'middleware' => 'auth'], function ()
{

    // Dashboard Routes...
    Route::get( '/', 'HomeController@index')->name('home');
    Route::get( '/dashboard/inicio', 'DashboardController@index')->name('dashboard.index');

    // Invoices Routes...
    Route::get( '/cobrancas/cliente/{uuid}/novo', 'InvoiceController@addInvoice')->name('invoices.view.add');
    Route::get( '/cobrancas/adicionarItem', 'InvoiceController@addItem')->name('invoices.item.add');
    //Route::post( '/cobrancas/novo', 'InvoiceController@create')->name('invoices.submit.add');
    Route::delete('/cobrancas/remover', 'InvoiceController@delete')->name('invoices.submit.del');
    Route::post( '/cobrancas/{id}', 'InvoiceController@update')->name('invoices.submit.edit');

    // Fornecedores
    Route::group(['prefix' => '/fornecedores'], function(){
        Route::get('/', 'ProviderController@index')->name('providers.index');
        Route::get('/novo', 'ProviderController@create')->name('providers.create');
        Route::post('/novo', 'ProviderController@store')->name('providers.store');
    });

    // Clientes
    Route::group(['prefix' => '/clientes'], function(){
        Route::post('/unique_cpf', 'CustomerController@uniqueCPF')->name('customers.verifica.cpf');
        Route::post('/unique_email', 'CustomerController@uniqueEmail')->name('customers.verifica.email');

        Route::get( '/', 'CustomerController@index')->name('customers.index'); //-- blade
        Route::get( '/buscaNome', 'CustomerController@searchSimple')->name('customers.search.simple'); //-- blade
        Route::get( '/buscaAvancada', 'CustomerController@searchAdvanced')->name('customers.search.advanced'); //-- blade
        Route::get( '/novo', 'CustomerController@addCustomer')->name('customers.view.add'); //-- blade
        Route::get('/{id}/edit', 'CustomerController@editCustomer')->name('customers.edit'); //--Redireciona pra view com os dados do cliente
        Route::put('/{id}/edit', 'CustomerController@editSubmitCustomer')->name('customers.edit.submit'); //--da um submit no form com os dados do cliente
        Route::put('/{id}/delete', 'CustomerController@deleteCustomer')->name('customers.delete'); //--da um submit no form com os dados do cliente

        Route::get( '/importar', 'CustomerController@viewImportar')->name('customers.view.import');
        Route::post( '/importarArquivo', 'CustomerController@lerArquivo')->name('customers.import.readfile');
        Route::post( '/importarStart', 'CustomerController@submitImport')->name('customers.import.submit');
        Route::post('/novo', 'CustomerController@create')->name('customers.submit.add');

        Route::post('/remover', 'CustomerController@delete')->name('customers.submit.del');
        Route::delete('/remover', 'CustomerController@deleteJSON')->name('customers.json.del');
        Route::post( '/{id}', 'CustomerController@update')->name('customers.submit.edit');
        Route::get( '/{id}/remover', 'CustomerController@deleteCustomer')->name('customers.view.del');
        Route::get( '/{id}/perfil', 'CustomerController@view')->name('customers.view');
        Route::get( '/{id}/excluir', 'CustomerController@viewRemove')->name('customers.view.remove');
        Route::get( '/{id}/editar', 'CustomerController@viewUpdate')->name('customers.view.edit');

        Route::get( '/buscar/{route}', 'CustomerController@searchCustomer')->name('customers.search'); //-- modal busca cliente para modulo
        Route::post( '/buscar/ajax', 'CustomerController@searchAjax')->name('customers.search.ajax'); //-- modal busca cliente para modulo
        Route::post('/buscar/cliente', 'CustomerController@buscaCliente_modal')->name('customers.submit.search'); //-- modal busca cliente para modulo

        /*
        |--------------------------------------------------------------------------
        | Clientes => Assinaturas
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => '/assinaturas'], function(){
            Route::get('/', 'SubscriptionController@index')->name('subscriptions.index');
            Route::get( '/{id}/detalhes', 'SubscriptionController@view')->name('subscriptions.view');
            Route::get('/cancelamentos', 'SubscriptionController@cancelView')->name('subscriptions.cancelView');
            Route::get('/cortesia', 'SubscriptionController@cortesia')->name('subscriptions.cortesia');
            Route::put('/{subscription}/updatePlan','SubscriptionController@updatePlan')->name('subscriptions.updatePlan');
            Route::put('/{subscription}/updateDue','SubscriptionController@updateDue')->name('subscriptions.updateDue');
            Route::put('/{subscription}/cancelamento', 'SubscriptionController@cancelSubscription')->name('subscriptions.cancelSubscription');
            Route::put('/{subscription}/cancelamentoImmediate', 'SubscriptionController@cancelSubscriptionImmediate')->name('subscriptions.cancelSubscriptionImmediate');
            Route::get('/buscaSimples','SubscriptionController@searchSimples' )->name('subscriptions.search.simples');
            Route::get('/buscaAvancada','SubscriptionController@searchAdvanced' )->name('subscriptions.search.advanced');


        });

        /*
        |--------------------------------------------------------------------------
        | Clientes => Cancelamentos
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => '/cancelamentos'], function(){
            Route::get('/', 'CancellationController@index')->name('cancellations.index');
            Route::get( '/{id}/detalhes', 'CancellationController@view')->name('cancellation.view');
        });

        /*
        |--------------------------------------------------------------------------
        | Rotas => AbandonedCarts
        |--------------------------------------------------------------------------
        */

        Route::group(['prefix' => '/carrinhosAbandonados'], function (){

            // Somente as rotas de página
            Route::get('/', 'AbandonedCartsController@index')->name('abandoned_carts.index');
            Route::get('/{id}/detalhes', 'AbandonedCartsController@show')->name('abandoned_carts.show');

            // Submits
            Route::get('/buscar', 'AbandonedCartsController@search')->name('abandoned_carts.search');
            Route::get('/buscaAvancada', 'AbandonedCartsController@searchAdvanced')->name('abandoned_carts.search.advanced');
            Route::put('/{id}/atualizar', 'AbandonedCartsController@update')->name('abandoned_carts.update');
            Route::delete('/{id}/excluir', 'AbandonedCartsController@destroy')->name('abandoned_carts.destroy');
            Route::post('/excluir', 'AbandonedCartsController@destroyJSON')->name('abandoned_carts.destroy_json');
        });
    });

    Route::group(['prefix'  =>  '/relatorios'], function(){
        Route::get('/', 'ReportController@index')->name('reports.index');

        // Vendas
        Route::get('vendas-por-plano', 'Reports\SalesController@salesByPlan')->name('reports.sales.plan');
        Route::get('vendas-por-periodo', 'Reports\SalesController@salesByPeriod')->name('reports.sales.period');
        Route::get('vendas-por-parceiro', 'Reports\SalesController@salesByPartner')->name('reports.sales.partner');
    });

    Route::group(['prefix' => '/integracoes'], function (){
        Route::get('/', 'PluginController@index')->name('plugins.index');
        Route::get('/app/{module}', 'PluginController@viewPlugin')->name('plugins.app');
        Route::post('/app/{module}/salvar', 'PluginController@saveConfig')->name('plugin.save');
        Route::post('/app/{module}/editar', 'PluginController@updateConfig')->name('plugin.update');
        Route::delete('/app/{module}/remover', 'PluginController@removeConfig')->name('plugin.remove');
    });

    // Financeiro...
    Route::group(['prefix' => '/financeiro'], function (){
        Route::get( '/', 'InvoiceController@resumo')->name('invoices.resume');//LEANDRO
        // Faturas
        Route::group(['prefix' => '/faturas'], function(){
            Route::get( '/', 'InvoiceController@index')->name('invoices.index');
            Route::get( '/{invoice}/detalhes', 'InvoiceController@view')->name('invoice.view');
            Route::get( '/novo', 'InvoiceController@addInvoice')->name('invoices.view.add');

            Route::put( '/{invoice}/change/due', 'InvoiceController@changeDue')->name('invoice.change.due');
            Route::put( '/{invoice}/change/confirm', 'InvoiceController@changePaid')->name('invoice.change.paid');
            Route::put( '/{invoice}/change/cancel', 'InvoiceController@changeCancelled')->name('invoice.change.cancelled');
            Route::delete( '/{invoice}/remove', 'InvoiceController@deleteInvoice')->name('invoice.remove');
            Route::post('/novo/emitirCobranca', 'InvoiceController@create')->name('invoices.create');

            //Buscas
            Route::get('searchSimples', 'InvoiceController@searchSimples')->name('invoice.search.simples');
            Route::get('searchAdvanced', 'InvoiceController@searchAdvanced')->name('invoice.search.advanced');
        });

        Route::group(['prefix' => '/contas-a-pagar'], function(){
            Route::get('/', 'DebitController@index')->name('debits.index');
        });

        // Planos
        Route::group(['prefix' => '/planos'], function(){
            Route::get('/', 'Config\PlansController@index')->name('config.plans.index');
            Route::get('/tipo/{tipo}', 'Config\PlansController@comboPlan')->name('config.plans.combo');
            Route::get('/server/{module}', 'Config\PlansController@comboServer')->name('config.plans.comboserver');
            Route::get('/module/{module}', 'Config\PlansController@loadModule')->name('config.plans.module');
            Route::get('/novo', 'Config\PlansController@viewCreate')->name('config.plans.add');
            Route::post('/novo', 'Config\PlansController@create')->name('config.plans.add.submit');
            Route::get('/edit/{plan}', 'Config\PlansController@viewEdit')->name('config.plans.edit');
            Route::put('/edit/{plan}', 'Config\PlansController@edit')->name('config.plans.edit.submit');
        });

        // Preços de Domínio
        Route::group(['prefix' => '/precos-de-dominio'], function(){
            Route::get('/', 'PriceDomainController@index')->name('price-domains.index');
            Route::get('/novo', 'PriceDomainController@viewCreate')->name('price-domains.add');
            Route::post('/novo', 'PriceDomainController@store')->name('price-domains.store');
            Route::get('/editar/{priceDomain}', 'PriceDomainController@viewEdit')->name('price-domains.edit');
            Route::put('/editar/{priceDomain}', 'PriceDomainController@update')->name('price-domains.update');
            Route::delete('/remover/{priceDomain}', 'PriceDomainController@delete')->name('price-domains.delete');
        });

        // Itens Opcionais
        Route::group(['prefix' => '/opcionais'], function(){
            Route::get('/', 'Config\OptionalsController@index')->name('config.optionals.index');
            Route::get('/tipo/{tipo}', 'Config\OptionalsController@comboPlan')->name('config.optionals.combo');
            Route::get('/server/{module}', 'Config\OptionalsController@comboServer')->name('config.optionals.comboserver');
            Route::get('/module/{module}', 'Config\OptionalsController@loadModule')->name('config.optionals.module');
            Route::get('/novo', 'Config\OptionalsController@create')->name('config.optionals.add');
            Route::post('/novo', 'Config\OptionalsController@store')->name('config.optionals.store');
            Route::get('/editar/{plan}', 'Config\OptionalsController@viewEdit')->name('config.optionals.edit');
            Route::put('/editar/{plan}', 'Config\OptionalsController@edit')->name('config.optionals.edit.submit');
        });
    });

    // Config Routes...
    Route::group(['prefix' => '/config'], function (){

        Route::get('/', 'ConfigController@index')->name('config.index');

        Route::group(['prefix' => '/meu-gerentepro'], function(){
            Route::get('/', 'Config\AccountController@myPlan')->name('config.my-account');
            Route::get('/portal', 'Config\AccountController@portalCustomer')->name('config.account.portal');
        });

        Route::group(['prefix' => '/financeiro'], function(){
            Route::get('/metodo-de-pagamento', 'Config\InvoicesController@methodPayment')->name('config.method-payment');
            Route::get('/faturas', 'Config\InvoicesController@invoices')->name('config.invoices');
            Route::post('/metodo-de-pagamento/salvar', 'Config\InvoicesController@storeMethodPayment')->name('config.store.method-payment');
            Route::post('/addConta', 'Config\InvoicesController@createContaBancaria')->name('config.store.conta-bancaria');
        });

        Route::group(['prefix' => '/usuarios'], function(){
            Route::get('/contas', 'Config\UsersController@users')->name('config.users');
            Route::get('/contas/{user}', 'Config\UsersController@userView')->name('config.user');
            Route::post('/contas/{user}/salvar', 'Config\UsersController@saveUser')->name('config.user.update');
            Route::get('/grupos-de-usuarios', 'Config\UsersController@groups')->name('config.users.group');
        });

        Route::group(['prefix' => '/servidores'], function (){
            Route::get('/', 'Config\ServersController@index')->name('config.servers.index');
            Route::get('/novo', 'Config\ServersController@create')->name('config.servers.add');
            Route::get('/module/{module}', 'Config\ServersController@loadModule')->name('config.servers.module');
            Route::post('/novo', 'Config\ServersController@store')->name('config.servers.store');
            Route::post('/validaHostname', 'Config\ServersController@validHostname')->name('config.servers.test');
        });
    });


    /**
     * DESCOMENTAR CODIGO ABAIXO PARA VER OS SQLS QUE ESTÃO SENDO EXECUTADOS
     */
});

\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    //dump($query->sql);
    //dump($query->bindings);
    //dump($query->time);

    //$str = $query->sql."\r\n";
    //$str.= '--------------------------------------------------'."\r\n";

    //$log = fopen(base_path('/storage/database.log'), 'a');
    //fwrite($log, $str);
    //fclose($log);
});

require 'front.php';
