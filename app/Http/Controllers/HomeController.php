<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Plan;
use App\Services\AccountService;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class HomeController extends Controller
{
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var ModuleService
     */
    private $moduleService;

    /**
     * Create a new controller instance.
     *
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService, ModuleService $moduleService)
    {
        $this->middleware('auth');
        $this->accountService = $accountService;
        $this->moduleService = $moduleService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with([
            'countPlans' => Plan::query()->where(['account_id' => AccountId()])->count(),
            'hasGateway' => $this->moduleService->hasGateway(),
            'hasConfig'  => $this->moduleService->hasConfig(),
        ]);
    }
}
