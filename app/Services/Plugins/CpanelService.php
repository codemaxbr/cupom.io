<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 18/10/2018
 * Time: 02:28
 */
namespace App\Services\Plugins;

use Illuminate\Support\Facades\Auth;

class CpanelService
{
    private $plan;
    private $server;
    private $params;

    /**
     * CpanelService constructor.
     */
    public function __construct($plan, $server, $params)
    {
        $this->plan = $plan;
        $this->server = $server;
        $this->params = $params;
    }

    public function createAccount()
    {
        $config_server = (object)unserialize($this->server->config);
        $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

        $response = $cpanel->createAccount([
            'plan' => $config_server->user_cpanel . '_' . limpaChars($this->plan->name),
            'domain' => $this->params->domain,
            'user' => trim(substr(limpaNumeros($this->params->domain), 0, 16))
        ]);

        if ($response->status == 1) {
            return true;
        }else{
            return $response;
        }
    }

    public function suspendAccount($reason = null)
    {
        $config_server = (object)unserialize($this->server->config);
        $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

        $response = $cpanel->suspendAccount([
            'user' => trim(substr(limpaNumeros($this->params->domain), 0, 16)),
            'reason' => (!is_null($reason)) ? $reason : 'Bloqueio manual via GerentePRO.'
        ]);

        if ($response->status == 1) {
            return true;
        }else{
            return $response;
        }
    }

    public function unsuspendAccount()
    {
        try{
            $config_server = (object)unserialize($this->server->config);
            $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

            $response = $cpanel->unsuspendAccount(trim(substr(limpaNumeros($this->params->domain), 0, 16)));

            if ($response->status == 1) {
                return (object)[
                    'status' => true,
                    'domain' => $this->params->domain,
                    'user' => trim(substr(limpaNumeros($this->params->domain), 0, 16)),
                ];
            }else{
                return $response;
            }

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function terminateAccount()
    {
        try{
            $config_server = (object) unserialize($this->server->config);
            $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

            $username = trim(substr(limpaNumeros($this->params->domain), 0, 16));
            $plan = limpaChars($this->plan->name);

            $response = $cpanel->terminateAccount($username);
            if ($response->status == 1) {
                return (object)[
                    'status' => true,
                    'domain' => $this->params->domain,
                    'user' => trim(substr(limpaNumeros($this->params->domain), 0, 16)),
                ];
            }else{
                return $response;
            }

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function changePackage(){
        try{
            $config_server = (object) unserialize($this->server->config);
            $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

            $username = trim(substr(limpaNumeros($this->params->domain), 0, 16));
            $plan = limpaChars($this->plan->name);

            $response = $cpanel->changePackage($username, $plan);
            if ($response->status == 1) {
                return (object)[
                    'status' => true,
                    'domain' => $this->params->domain,
                    'user' => trim(substr(limpaNumeros($this->params->domain), 0, 16)),
                    'new_plan' => $this->plan,
                    'old_plan' => $this->params->plan
                ];
            }else{
                return $response;
            }

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function makePlan()
    {
        $config_server = (object) unserialize($this->server->config);
        $cpanel = new \cPanel\API($this->server->ip, $config_server->user_cpanel, $config_server->hash_cpanel);

        if($cpanel->checkConnection())
        {
            return $cpanel->addPackage([
                'name' => limpaChars($this->plan->name),
                'disk' => $this->params->disk_limit,
                'bwlimit' => $this->params->bw_limit,
                'maxpop' => $this->params->emails,
                'maxsql' => $this->params->databases,
                'maxaddon' => $this->params->domains,
                'maxpark' => $this->params->parks
            ]);
        }
    }
}