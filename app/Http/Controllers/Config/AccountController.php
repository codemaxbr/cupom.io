<?php

namespace App\Http\Controllers\Config;

use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * AccountController constructor.
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function myPlan()
    {
        return view('config.account.my-plan');
    }

    public function portalCustomer()
    {
        $account = Account::find(AccountId());

        return view('config.account.portal')->with([
            'account' => $account
        ]);
    }
}
