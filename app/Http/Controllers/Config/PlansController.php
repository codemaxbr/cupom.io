<?php

namespace App\Http\Controllers\Config;

use App\Events\CreatePlanModule;
use App\Models\Module;
use App\Models\Plan;
use App\Models\TypePlan;
use App\Services\ConfigService;
use App\Services\ModuleService;
use App\Services\PlanService;
use App\Services\ServerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\AssignOp\Mod;
use Webpatser\Uuid\Uuid;

class PlansController extends Controller
{
    /**
     * @var ConfigService
     */
    private $configService;
    /**
     * @var PlanService
     */
    private $planService;
    /**
     * @var ModuleService
     */
    private $moduleService;
    /**
     * @var ServerService
     */
    private $serverService;

    /**
     * PlansController constructor.
     */
    public function __construct(ConfigService $configService, PlanService $planService, ModuleService $moduleService, ServerService $serverService)
    {
        $this->configService = $configService;
        $this->planService = $planService;
        $this->moduleService = $moduleService;
        $this->serverService = $serverService;
    }

    public function index()
    {
        $planos = $this->planService->allPlans();

        return view('config.plans.index')->with([
            'planos' => $planos
        ]);
    }

    public function loadModule(Module $module)
    {
        if(View::exists("config.plans.plugins.{$module->slug}")){
            return view("config.plans.plugins.{$module->slug}");
        }else{
            return "<center>View do módulo: ".$module->name." não encontrado.</center>";
        }
    }

    public function viewCreate()
    {
        $tipos = $this->configService->getTypesPlan();
        $termos = $this->configService->getTypesTerm();
        $ciclos_pagto = $this->configService->getPaymentsCycles();
        $modules = $this->moduleService->getModules(['panel']);

        return view('config.plans.add')->with([
            'tipos' => $tipos,
            'termos' => $termos,
            'ciclos' => $ciclos_pagto,
            'modules' => $modules
        ]);
    }

    public function create(Request $request)
    {
        //try{
            $data = [
                'name' => $request->name,
                'uuid' => Uuid::generate(4)->string,
                'type_plan_id' => $request->type_plan_id,
                'description' => $request->description,
                'email_template_id' => $request->email_template,
                'payment_cycle_id' => $request->payment_cycle_id,
                'price' => numFormat_US($request->price),
                'type_term_id' => $request->type_term_id,
                'price_installment' => numFormat_US($request->price_installment),
                'trial' => $request->trial,
                'module_id' => $request->module,
                'server_id' => $request->servidor,
                'visibility' => $request->visibility,
                'config' => serialize($request->config),
                'account_id' => Auth::user()->account_id
            ];

            if($plan = $this->planService->createPlan($data))
            {
                $module = $plan->module;
                $server = $plan->server;
                $params = (object) unserialize($plan->config);

                $result = event(new CreatePlanModule($plan, $module, $server, $params));
                if($result[0]->status != 'error')
                {
                    return redirect()->route('config.plans.index')->with('success', 'Plano adicionado com sucesso!');
                }else{
                    return redirect()->back()->with('error', 'cPanel/WHM: '.$result[0]->response->verbose);
                }

            }
            /*
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
            */
    }

    public function viewEdit(Request $request, Plan $plan)
    {
        $tipos = $this->configService->getTypesPlan();
        $termos = $this->configService->getTypesTerm();
        $ciclos_pagto = $this->configService->getPaymentsCycles();
        return view('config.plans.edit')->with([
            'tipos' => $tipos,
            'termos' => $termos,
            'ciclos' => $ciclos_pagto,
            'plano' => $plan
        ]);
    }

    public function edit(Request $request, $id)
    {
        //dd($id);
        $dados = $request->except(['_token', '_method']);
        $this->planService->updatePlan($dados, $id);
        return redirect()->route('config.plans.index')->with('success', 'Plano alterado com sucesso!');
    }

    public function comboPlan($typePlan)
    {
        $plans = $this->planService->getPlans_byType($typePlan);
        return response()->json($plans);
    }

    public function comboServer(Module $module)
    {
        $servers = $this->serverService->serversByModule($module);
        return response()->json($servers);
    }
}
