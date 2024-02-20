<?php

namespace App\Http\Controllers\Front;

use App\Services\PlanService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    /**
     * @var PlanService
     */
    private $planService;

    /**
     * HomeController constructor.
     * @param PlanService $planService
     */
    public function __construct(PlanService $planService)
    {
        //$this->middleware('auth:front');
        $this->planService = $planService;
    }

    public function index(Request $request)
    {
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            $totalCart = $cart->count();
        }else{
            $totalCart = 0;
        }
        $plans = $this->planService->allPlans();

        return view('welcome')->with([
            'planos' => $plans,
            'items' => $totalCart,
        ]);
    }

    public function contaInvalida()
    {
        return view('erro404');
    }
}
