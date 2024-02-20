<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
        \App\Models\AbandonedCart::         observe(\App\Observers\AbandonedCartObserver::class);
        \App\Models\Address::               observe(\App\Observers\AddressObserver::class);
        \App\Models\Attachment::            observe(\App\Observers\AttachmentObserver::class);
        \App\Models\Bank::                  observe(\App\Observers\BankObserver::class);
        \App\Models\Cancellation::          observe(\App\Observers\CancellationObserver::class);
        \App\Models\Optional::              observe(\App\Observers\OptionalObserver::class);
        \App\Models\CreditCard::            observe(\App\Observers\CreditCardObserver::class);
        \App\Models\Customer::              observe(\App\Observers\CustomerObserver::class);
        \App\Models\Import::                observe(\App\Observers\ImportObserver::class);
        \App\Models\Invoice::               observe(\App\Observers\InvoiceObserver::class);
        \App\Models\InvoiceHistory::        observe(\App\Observers\InvoiceHistoryObserver::class);
        \App\Models\InvoiceItem::           observe(\App\Observers\InvoiceItemObserver::class);
        \App\Models\Module::                observe(\App\Observers\ModuleObserver::class);
        \App\Models\ModulesConfig::         observe(\App\Observers\ModulesConfigObserver::class);
        \App\Models\Notification::          observe(\App\Observers\NotificationObserver::class);
        \App\Models\Option::                observe(\App\Observers\OptionObserver::class);
        \App\Models\PasswordReset::         observe(\App\Observers\PasswordResetObserver::class);
        \App\Models\PaymentCycle::          observe(\App\Observers\PaymentCycleObserver::class);
        \App\Models\Permission::            observe(\App\Observers\PermissionObserver::class);
        \App\Models\PermissionRole::        observe(\App\Observers\PermissionRoleObserver::class);
        \App\Models\PermissionUser::        observe(\App\Observers\PermissionUserObserver::class);
        \App\Models\Plan::                  observe(\App\Observers\PlanObserver::class);
        \App\Models\Role::                  observe(\App\Observers\RoleObserver::class);
        \App\Models\RoleUser::              observe(\App\Observers\RoleUserObserver::class);
        \App\Models\Shoppingcart::          observe(\App\Observers\ShoppingcartObserver::class);
        \App\Models\Statement::             observe(\App\Observers\StatementObserver::class);
        \App\Models\Subscription::          observe(\App\Observers\SubscriptionObserver::class);
        \App\Models\SubscriptionsInvoice::  observe(\App\Observers\SubscriptionsInvoiceObserver::class);
        \App\Models\Transaction::           observe(\App\Observers\TransactionObserver::class);
        \App\Models\TypeActivity::          observe(\App\Observers\TypeActivityObserver::class);
        \App\Models\TypeAddress::           observe(\App\Observers\TypeAddressObserver::class);
        \App\Models\TypeInvoice::           observe(\App\Observers\TypeInvoiceObserver::class);
        \App\Models\TypeModule::            observe(\App\Observers\TypeModuleObserver::class);
        \App\Models\TypePayment::           observe(\App\Observers\TypePaymentObserver::class);
        \App\Models\TypePlan::              observe(\App\Observers\TypePlanObserver::class);
        \App\Models\TypeTerm::              observe(\App\Observers\TypeTermObserver::class);
        \App\Models\User::                  observe(\App\Observers\UserObserver::class);
        \App\Models\VindiCustomer::         observe(\App\Observers\VindiCustomerObserver::class);
        \App\Models\Server::                observe(\App\Observers\ServerObserver::class);
        \App\Models\PriceDomain::           observe(\App\Observers\PriceDomainObserver::class);
        \App\Models\Provider::              observe(\App\Observers\ProviderObserver::class);
        \App\Models\Debit::                 observe(\App\Observers\DebitObserver::class);

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
