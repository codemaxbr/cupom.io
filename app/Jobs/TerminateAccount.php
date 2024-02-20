<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Models\Server;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TerminateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Plan
     */
    public $plan;
    /**
     * @var Server
     */
    public $server;
    /**
     * @var Subscription
     */
    public $subscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, Server $server, Subscription $subscription)
    {
        $this->plan = $plan;
        $this->server = $server;
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $module = $this->plan->module;

        switch($module->slug)
        {
            case 'cpanel':          $serviceName = '\App\Services\Plugins\CpanelService'; break;
            case 'plesk':           $serviceName = '\App\Services\Plugins\PleskService'; break;
            case 'centovacast':     $serviceName = '\App\Services\Plugins\CentovaCastService'; break;
            case 'whmsonic':        $serviceName = '\App\Services\Plugins\WhmsonicService'; break;
            case 'vestacp':         $serviceName = '\App\Services\Plugins\VestacpService'; break;
        }

        $this->service = new $serviceName($this->plan, $this->server, $this->subscription);
        $response = $this->service->terminateAccount();
        if ($response->status){
            $this->subscription->delete();
            return true;
        }else{
            $this->fail($response->verbose);
            return false;
        }
    }
}
