<?php

namespace App\Http\Controllers\Config;

use App\Models\Module;
use App\Services\ConfigService;
use App\Services\ModuleService;
use App\Services\ServerService;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Webpatser\Uuid\Uuid;

class ServersController extends Controller
{
    /**
     * @var ConfigService
     */
    private $configService;
    /**
     * @var ServerService
     */
    private $serverService;
    /**
     * @var ModuleService
     */
    private $moduleService;

    /**
     * ServersController constructor.
     */
    public function __construct(ConfigService $configService, ServerService $serverService, ModuleService $moduleService)
    {
        $this->configService = $configService;
        $this->serverService = $serverService;
        $this->moduleService = $moduleService;
    }

    public function index()
    {
        $servers = $this->serverService->allServers();
        return view('config.servers.index')->with([
            'servers' => $servers,
        ]);
    }

    public function validHostname(Request $request)
    {
        if(pingAddress($request->hostname)){
            return "true";
        }else{
            return "false";
        }
    }

    public function create()
    {
        $modules = $this->moduleService->getModules(['panel']);

        return view('config.servers.add')->with([
            'modules' => $modules,
        ]);
    }

    public function serversForModule(Module $module)
    {

    }

    public function loadModule(Module $module)
    {
        if(View::exists("config.servers.plugins.{$module->slug}")){
            return view("config.servers.plugins.{$module->slug}");
        }else{
            return "<center>View do módulo: ".$module->name." não encontrado.</center>";
        }
    }

    public function store(Request $request)
    {
        try {
            $new_server = [
                'name'           => $request->name,
                'uuid'           => Uuid::generate(4)->string,
                'ip'             => $request->ip,
                'datacenter'     => $request->datacenter,
                'cost'           => $request->cost,
                'limit_accounts' => $request->limit_accounts,
                'ns1'            => $request->ns1,
                'ns1_ip'         => $request->ns1_ip,
                'ns2'            => $request->ns2,
                'ns2_ip'         => $request->ns2_ip,
                'ns3'            => $request->ns3,
                'ns3_ip'         => $request->ns3_ip,
                'ns4'            => $request->ns4,
                'ns4_ip'         => $request->ns4_ip,
                'module_id'      => $request->module,
                'account_id'     => AccountId(),
                'config'         => serialize($request->config)
            ];

            $server = $this->serverService->createServer($new_server);
            if($server){
                return redirect()->route('config.servers.index')->with('success', 'Servidor vinculado com sucesso!');
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function viewEdit()
    {
        $tipos = $this->configService->getTypesPlan();
        $termos = $this->configService->getTypesTerm();
        $modulos = Module::getAvailables();
        $ciclos_pagto = $this->configService->getPaymentsCycles();

        return view('config.servers.add')->with([
            'tipos' => $tipos,
            'termos' => $termos,
            'modulos' => $modulos,
            'ciclos' => $ciclos_pagto
        ]);
    }
}
