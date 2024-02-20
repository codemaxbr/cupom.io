<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Services\ProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Webpatser\Uuid\Uuid;

class ProviderController extends Controller
{
    /**
     * @var ProviderService
     */
    private $providerService;

    /**
     * ProviderController constructor.
     */
    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    public function index()
    {
        $providers = $this->providerService->getAll();

        return view('providers.index')->with([
            'providers' => $providers
        ]);
    }

    public function create()
    {
        return view('providers.create');
    }

    public function store(Request $request)
    {
        $provider = Provider::create([
            'uuid' => Uuid::generate(4)->string,
            'name' => $request->name,
            'fantasia' => $request->fantasia,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            'type' => $request->type,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'insc_municipal' => $request->insc_municipal,
            'insc_estadual' => $request->insc_estadual,
            'birthdate' => dateEUA($request->birthdate),
            'account_id' => AccountId(),
        ]);

        $addressCreate = array(
            'zipcode'       => $request->zipcode,
            'address'       => $request->address,
            'number'        => $request->number,
            'uf'            => $request->uf,
            'city'          => $request->city,
            'district'      => $request->district,
            'additional'    => $request->additional
        );

        if($provider)
        {
            $provider->address()->create($addressCreate);
            return redirect()->route('providers.index')->with('success', 'Fornecedor adicionado com sucesso.');
        }
    }
}
