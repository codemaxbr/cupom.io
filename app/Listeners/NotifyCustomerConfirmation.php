<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 12/09/2018
 * Time: 12:31
 */

namespace App\Listeners;
use App\Events\CustomerRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCustomerConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerRegistered $event)
    {
        dump('Enviar email para o cliente de confirmação de cadastro');
        //dump($event->customer);
    }
}