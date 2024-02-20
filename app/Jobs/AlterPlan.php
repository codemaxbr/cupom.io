<?php

namespace App\Jobs;

use App\Models\Module;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AlterPlan implements ShouldQueue
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
    /**
     * @var Plan
     */
    private $plan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription, Module $module, Plan $plan)
    {
        $this->subscription = $subscription;
        $this->module = $module;
        $this->plan = $plan;
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
        $new_plan = $this->plan;

        switch($this->module->slug)
        {
            case 'cpanel':          $serviceName = '\App\Services\Plugins\CpanelService'; break;
            case 'plesk':           $serviceName = '\App\Services\Plugins\PleskService'; break;
            case 'centovacast':     $serviceName = '\App\Services\Plugins\CentovaCastService'; break;
            case 'whmsonic':        $serviceName = '\App\Services\Plugins\WhmsonicService'; break;
            case 'vestacp':         $serviceName = '\App\Services\Plugins\VestacpService'; break;
        }

        $this->service = new $serviceName($new_plan, $server, $item);
        $response = $this->service->changePackage();

        if($response->status){
            return $response;
        }else{
            dd('Reportar erro');
        }
    }
}
