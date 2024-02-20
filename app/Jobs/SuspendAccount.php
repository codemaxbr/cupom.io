<?php

namespace App\Jobs;

use Exception;
use App\Models\Module;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SuspendAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Subscription
     */
    private $subscription;
    /**
     * @var Module
     */
    private $module;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @param Subscription $subscription
     * @param Module $module
     */
    public function __construct(Subscription $subscription, Module $module)
    {
        $this->subscription = $subscription;
        $this->module = $module;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server = $this->subscription->plan->server;
        $plan   = $this->subscription->plan;
        $item   = $this->subscription;

        switch($this->module->slug)
        {
            case 'cpanel':          $serviceName = '\App\Services\Plugins\CpanelService'; break;
            case 'plesk':           $serviceName = '\App\Services\Plugins\PleskService'; break;
            case 'centovacast':     $serviceName = '\App\Services\Plugins\CentovaCastService'; break;
            case 'whmsonic':        $serviceName = '\App\Services\Plugins\WhmsonicService'; break;
            case 'vestacp':         $serviceName = '\App\Services\Plugins\VestacpService'; break;
        }

        $this->service = new $serviceName($plan, $server, $item);
        $response = $this->service->suspendAccount();

        if (!$response){
            echo $response;
        }
    }

}
