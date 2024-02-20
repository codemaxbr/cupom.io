<?php

namespace App\Providers;

use App\Events\ActiveSubscription;
use App\Events\AlterPlanSubscription;
use App\Events\boletoPayment;
use App\Events\cartaoPayment;
use App\Events\ConfirmPayment;
use App\Events\CreatePlanModule;
use App\Events\CustomerRegistered;
use App\Events\InvoiceCreated;
use App\Events\LogActivity;
use App\Events\SuspendSubscription;
use App\Listeners\ActivateSubscription;
use App\Listeners\AlterPlan;
use App\Listeners\AttachmentInvoice;
use App\Listeners\CreateInvoice;
use App\Listeners\CreateStatement;
use App\Listeners\NotifyCustomerConfirmation;
use App\Listeners\NotifyCustomerInvoice;
use App\Listeners\NotifyInvoicePaid;
use App\Listeners\registerBoleto;
use App\Listeners\registerCartao;
use App\Listeners\MakeTransaction;
use App\Listeners\registerPlan;
use App\Listeners\SaveLog;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CustomerRegistered::class => [
            NotifyCustomerConfirmation::class,
        ],
        InvoiceCreated::class => [
            NotifyCustomerInvoice::class,
        ],

        ConfirmPayment::class => [
            CreateStatement::class,
            //AttachmentInvoice::class,
            NotifyInvoicePaid::class,
            ActivateSubscription::class,
        ],

        SuspendSubscription::class => [
            \App\Listeners\SuspendSubscription::class,
        ],

        AlterPlanSubscription::class => [
            AlterPlan::class
        ],

        ActiveSubscription::class => [
            ActivateSubscription::class,
        ],

        boletoPayment::class => [
            CreateInvoice::class,
            registerBoleto::class,
            MakeTransaction::class,
        ],

        LogActivity::class => [
            SaveLog::class
        ],

        cartaoPayment::class => [
            CreateInvoice::class,
            registerCartao::class,
            MakeTransaction::class,
        ],

        CreatePlanModule::class => [
            registerPlan::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
