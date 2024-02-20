<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Subscription
     */
    public $item;
    /**
     * @var Plan
     */
    public $plan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, $item)
    {
        $this->item = $item;
        $this->plan = $plan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $plan = $this->plan;
        $plugin = $this->plan->module;
        $server = $this->plan->server;
        $months = $this->plan->payment_cycle->months;

        switch($plugin->slug)
        {
            case 'cpanel':          $serviceName = '\App\Services\Plugins\CpanelService'; break;
            case 'plesk':           $serviceName = '\App\Services\Plugins\PleskService'; break;
            case 'centovacast':     $serviceName = '\App\Services\Plugins\CentovaCastService'; break;
            case 'whmsonic':        $serviceName = '\App\Services\Plugins\WhmsonicService'; break;
            case 'vestacp':         $serviceName = '\App\Services\Plugins\VestacpService'; break;
        }

        $this->service = new $serviceName($plan, $server, $this->item);
        $response = $this->service->createAccount();

        if($response){
            return true;
        }else{
            $this->fail($response->response);
            return false;
        }
    }
}
