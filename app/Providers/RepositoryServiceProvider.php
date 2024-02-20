<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind();
        $this->app->bind(\App\Repositories\AbandonedCartRepository::class, \App\Repositories\AbandonedCartRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AccountDetailRepository::class, \App\Repositories\AccountDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AccountPlanRepository::class, \App\Repositories\AccountPlanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AccountRepository::class, \App\Repositories\AccountRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AttachmentRepository::class, \App\Repositories\AttachmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BankRepository::class, \App\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CancellationRepository::class, \App\Repositories\CancellationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CustomerAddressRepository::class, \App\Repositories\CustomerAddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CustomerRepository::class, \App\Repositories\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ImportRepository::class, \App\Repositories\ImportRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceHistoryRepository::class, \App\Repositories\InvoiceHistoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceItemsRepository::class, \App\Repositories\InvoiceItemsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceRepository::class, \App\Repositories\InvoiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LogRepository::class, \App\Repositories\LogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ModuleRepository::class, \App\Repositories\ModuleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OptionalRepository::class, \App\Repositories\OptionalRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanRepository::class, \App\Repositories\PlanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlansGridRepository::class, \App\Repositories\PlansGridRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServerRepository::class, \App\Repositories\ServerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatementRepository::class, \App\Repositories\StatementRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubscriptionRepository::class, \App\Repositories\SubscriptionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubscriptionsInvoicesRepository::class, \App\Repositories\SubscriptionsInvoicesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TransactionRepository::class, \App\Repositories\TransactionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeActivityRepository::class, \App\Repositories\TypeActivityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeAddressRepository::class, \App\Repositories\TypeAddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeInvoiceItemsRepository::class, \App\Repositories\TypeInvoiceItemsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceAccountRepository::class, \App\Repositories\InvoiceAccountRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ResellerRepository::class, \App\Repositories\ResellerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PriceDomainRepository::class, \App\Repositories\PriceDomainRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProviderRepository::class, \App\Repositories\ProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DebitRepository::class, \App\Repositories\DebitRepositoryEloquent::class);
    }
}
