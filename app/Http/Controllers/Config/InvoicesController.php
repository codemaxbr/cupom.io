<?php

namespace App\Http\Controllers\Config;

use App\Models\Option;
use App\Services\ConfigService;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
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
     * InvoicesController constructor.
     */
    public function __construct(ConfigService $configService, ModuleService $moduleService)
    {
        $this->configService = $configService;
        $this->moduleService = $moduleService;
    }

    public function methodPayment()
    {
        $user = Auth::user();
        $modules = $this->moduleService->getGateways($user->account);
        $banks = $this->configService->getBanks();

        return view('config.invoices.method-payments')->with([
            'modules' => $modules,
            'banks' => $banks
        ]);
    }

    public function storeMethodPayment(Request $request)
    {
        foreach ($request->except('_token') as $name => $value){
            $option['name'] = $name;
            $option['value'] = $value;

            $update = Option::query()->firstOrCreate(['account_id' => AccountId(), 'name' => $name], $option);
            Option::query()->where(['account_id' => AccountId(), 'name' => $name])->update($option);
        }

        return redirect()->route('config.method-payment')->with('sucess', 'Configurações de Pagamento salvas.');
    }

    public function createContaBancaria(Request $request)
    {
        $user = Auth::user();
        $bank = [
            'bank' => $request->banco,
            'owner' => $request->cedente,
            'wallet' => $request->carteira,
            'type_bank' => $request->tipo_conta,
            'agency' => $request->agencia,
            'account' => $request->conta,
            'digit' => $request->digito,
            'account_id' => $user->account->id
        ];

        $this->configService->newBank($bank);
        return redirect()->route('config.method-payment')->with('success', 'Conta cadastrada com sucesso.');
    }

    public function invoices()
    {


        return view('config.invoices.invoices-config');

    }
}
