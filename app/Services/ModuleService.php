<?php
/**
 * Created by PhpStorm.
 * User: Lucas e Nathalia
 * Date: 30/08/2018
 * Time: 22:14
 */

namespace App\Services;


use App\Models\Account;
use App\Models\Module;
use App\Models\ModulesAccount;
use App\Models\Option;
use App\Models\Server;
use App\Models\TypeModule;
use App\Repositories\ModuleRepository;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ModuleService
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * ModuleService constructor.
     */
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function getModules($type = '*')
    {
        if($type != '*')
        {
            return TypeModule::with('modules')->whereIn('slug', $type)->get()->all();
        }
    }

    public function createConfig($json, Module $module, Server $server, Account $account)
    {
        try {
            return ModulesAccount::create([
                'uuid' => Uuid::generate()->string,
                'module_id' => $module->id,
                'server_id' => $server->id,
                'config' => $json,
                'account_id' => $account->id
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function removeConfig(Module $module, Server $server, Account $account)
    {
        return ModulesAccount::query()->where(['account_id' => $account->id, 'module_id' => $module->id])->delete();
    }

    public function updateConfig($json, Module $module, Server $server, Account $account)
    {
        return ModulesAccount::query()->where(['account_id' => $account->id, 'module_id' => $module->id])->update(['config' => $json]);
    }

    public function getConfigs()
    {
        return ModulesAccount::query()->where(['account_id' => AccountId()])->get();
    }

    public function hasGateway()
    {
        $configs = ModulesAccount::query()->whereHas('module', function ($q){
            $q->where('type_module_id', 3);
        });

        if($configs->count() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function hasConfig()
    {
        $options = Option::query()->whereIn('name', ['boleto_gateway', 'cartao_gateway'])->where(['account_id' => AccountId()])->get();

        if($options->count() > 0){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    /**
     * @param Module $module
     * @param Account $account
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function getConfig(Module $module, Account $account)
    {
        return ModulesAccount::query()->with('module')->where(['account_id' => $account->id, 'module_id' => $module->id])->first();
    }

    public function getGateways(Account $account)
    {
        return ModulesAccount::query()->with('module')->whereHas('module', function ($q){
            $q->where(['type_module_id'=> 3]);
        })->where(['account_id' => $account->id])->get()->all();
    }
}