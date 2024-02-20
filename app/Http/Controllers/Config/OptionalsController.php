<?php

namespace App\Http\Controllers\Config;

use App\Services\ConfigService;
use App\Services\OptionalService;
use App\Services\PlanService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class OptionalsController extends Controller
{
    /**
     * @var OptionalService
     */
    private $optionalService;
    /**
     * @var ConfigService
     */
    private $configService;
    /**
     * @var PlanService
     */
    private $planService;

    /**
     * OptionalsController constructor.
     */
    public function __construct(OptionalService $optionalService, ConfigService $configService, PlanService $planService)
    {
        $this->optionalService = $optionalService;
        $this->configService = $configService;
        $this->planService = $planService;
    }

    public function index()
    {
        $optionals = $this->optionalService->getOptionals();
        return view('config.optionals.index')->with([
            'optionals' => $optionals
        ]);
    }

    public function create()
    {
        $termos = $this->configService->getTypesTerm();
        $ciclos_pagto = $this->configService->getPaymentsCycles();
        $planos = $this->planService->allPlans();

        return view('config.optionals.add')->with([
            'termos' => $termos,
            'ciclos' => $ciclos_pagto,
            'planos' => $planos
        ]);
    }

    public function store(Request $request)
    {
        try{
            $add = [
                'name' => $request->name,
                'uuid' => Uuid::generate(4)->string,
                'visibility' => $request->visibility,
                'description' => $request->description,
                'email_template_id' => $request->email_template,
                'price' => $request->price,
                'suspend_principal' => (isset($request->suspend_principal)) ? $request->suspend_principal : 0,
                'type_term_id' => $request->type_term_id,
                'payment_cycle_id' => $request->payment_cycle_id,
                'plans' => serialize($request->plans),
                'account_id' => Auth::user()->account_id,
            ];

            $optional = $this->optionalService->create($add);
            return redirect()->route('config.optionals.index')->with('success', 'Opcional cadastrado com sucesso!');
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
