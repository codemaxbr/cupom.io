<?php

namespace App\Http\Controllers\API;

use App\Services\AccountService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    private $customerService;
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * CustomerController constructor.
     */
    public function __construct(
        CustomerService $customerService,
        AccountService $accountService
    )
    {
        $this->customerService = $customerService;
        $this->accountService = $accountService;
    }

    public function getAll(Request $request)
    {
        if($request->s == null){
            $lista = $this->customerService->getCustomers(20);
        }else{
            $lista = $this->customerService->getAll_search(AccountId(), $request->s);
        }

        return response()->json($lista);
    }

    public function getTotal()
    {
        $clientes = $this->customerService->getTotal();
        return response()->json($clientes);
    }
}
