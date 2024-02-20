<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Server;
use App\Services\ConfigService;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PluginController extends Controller
{
    /**
     * @var ConfigService
     */
    private $configService;
    /**
     * @var ModuleService
     */
    private $moduleService;

    /**
     * PluginController constructor.
     */
    public function __construct(ConfigService $configService, ModuleService $moduleService)
    {
        $this->configService = $configService;
        $this->moduleService = $moduleService;
    }

    public function index()
    {
        $user = Auth::user();
        $types = $this->configService->getTypesModules();
        //$configs = $this->moduleService->getConfigs($user->account);


        return view('plugins.index')->with([
            'tipos' => $types,
        ]);
    }

    public function saveConfig(Request $request, Module $module, Server $server)
    {
        try{
            $config = serialize($request->except('_token'));
            $user = Auth::user();

            $this->moduleService->createConfig($config, $module, $server, $user->account);

            return redirect()->route('plugins.index')->with('success', 'Plugin "'.$module->name.'" configurado com sucesso.');
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function removeConfig(Request $request, Module $module, Server $server)
    {
        try{
            $user = Auth::user();
            $this->moduleService->removeConfig($module, $server, $user->account);

            return redirect()->route('plugins.index')->with('success', 'O plugin "'.$module->name.'" foi removido.');

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateConfig(Request $request, Module $module, Server $server)
    {
        try{
            $config = serialize($request->except('_token'));
            $user = Auth::user();

            $this->moduleService->updateConfig($config, $module, $server, $user->account);

            return redirect()->route('plugins.index')->with('success', 'Configurações do plugin "'.$module->name.'" atualizados com sucesso.');
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function viewPlugin(Module $module)
    {
        $user = Auth::user();
        $config = $this->moduleService->getConfig($module, $user->account);

        return view('plugins.apps.'.$module->slug)->with([
            'module' => $module,
            'config' => (!is_null($config)) ? (object) unserialize($config->config) : null
        ]);
    }
}
