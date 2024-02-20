<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerPlan
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
    public function handle($event)
    {
        $plan = $event->plan;
        $plugin = $event->module;
        $server = $event->server;
        $params = $event->params;

        if($plugin != null){
            switch ($plugin->slug){
                case 'cpanel':      $serviceName = '\App\Services\Plugins\CpanelService'; break;
                case 'plesk':       $serviceName = '\App\Services\Plugins\PleskService'; break;
                case 'centovacast': $serviceName = '\App\Services\Plugins\CentovaCastService'; break;
                case 'whmsonic':    $serviceName = '\App\Services\Plugins\WhmsonicService'; break;
                case 'vestacp':     $serviceName = '\App\Services\Plugins\VestacpService'; break;

                default: $serviceName = '\App\Services\Plugins\\'.$plugin->name.'Service'; break;
            }

            $this->service = new $serviceName($plan, $server, $params);
            $response = $this->service->makePlan();

            if($response->status == 0){
                $plan->delete();
                return (object) [
                    'status' => 'error',
                    'response' => $response
                ];
            }else{
                return (object) [
                    'status' => 'success',
                    'response' => $response
                ];
            }
        }else{
            return (object) [
                'status' => 'success',
                'response' => null
            ];
        }
    }
}
