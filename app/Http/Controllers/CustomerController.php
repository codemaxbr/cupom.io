<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\AccountService;
use App\Services\AddressService;
use App\Services\CustomerService;
use App\Services\ImportService;
use App\Services\InvoiceService;
use App\Services\StatementService;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid\Uuid;

class CustomerController extends Controller
{

    private $customerService;
    private $accountService;
    private $importService;
    private $invoiceService;
    private $statementService;
    private $addressService;

    /**
     * CustomerController constructor.
     */
    public function __construct(CustomerService $customerService, AccountService $accountService, ImportService $importService, InvoiceService $invoiceService, StatementService $statementService, AddressService $addressService)
    {
        $this->customerService = $customerService;
        $this->accountService = $accountService;
        $this->importService = $importService;
        $this->invoiceService = $invoiceService;
        $this->statementService = $statementService;
        $this->addressService = $addressService;
    }

    public function index()
    {
        $clientes = $this->customerService->getCustomers(20);
        if(count($clientes) > 0){
            return view('customers.index', compact('clientes'));
        }else{
            return view('customers.no_results');
        }
    }

    public function create(CustomerRequest $request)
    {
        $customerCreate = array(
            'type'          => $request->type,
            'account_id'    => $request->account_id,
            'name'          => $request->name,
            'cpf_cnpj'      => $request->cpf_cnpj,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'mobile'        => $request->mobile,
            'rg'            => $request->rg,
            'birthdate'     => $request->birthdate,
            'genre'         => $request->genre,
            'obs'           => $request->obs,
        );

        $addressCreate = array(
            'zipcode'       => $request->zipcode,
            'address'       => $request->address,
            'number'        => $request->number,
            'uf'            => $request->uf,
            'city'          => $request->city,
            'district'      => $request->district,
            'additional'    => $request->additional
        );

        if(!empty($customerCreate['birthdate']))
        {
            $date = explode('/', $customerCreate['birthdate']);

            $customerCreate['birthdate'] = $date[2].'-'.$date[1].'-'.$date[0];
        }

        if($customer = $this->customerService->newCustomer($customerCreate))
        {
            $address = $customer->address()->create($addressCreate);
            return redirect()->route('customers.index')->with('success', 'Cliente adicionado com sucesso.');
        }
    }

    public function update($id, CustomerRequest $request)
    {
        $input = $request->all();
        if(!empty($input['birthdate']))
        {
            $date = explode('/', $input['birthdate']);

            $input['birthdate'] = $date[2].'-'.$date[1].'-'.$date[0];
        }

        if($this->customerService->updateCustomer($id, $input))
        {
            return redirect()->route('customers.view', $id)->with('success', 'Dados de cliente atualizados.');
        }else{
            return redirect()->route('customers.view', $id)->with('error', 'Ocorreu um erro durante o processo. Se o problema persistir, entre em contato com nossa equipe de suporte.');
        }
    }

    public function delete(Request $request)
    {
        $input = (object) $request->all();
        $customer = $this->customerService->getCustomer($input->uuid);
        if($this->customerService->deleteCustomer($input->uuid))
        {
            return redirect()->route('customers.index')->with('deleted', $customer->name);
        }
    }

    public function deleteJSON(Request $request)
    {
        $input = (object) $request->all();
        $itens = (object) $input->itens;
        foreach ($itens as $item){
            $this->customerService->deleteCustomer($item['id']);
        }

        $request->session()->flash('status', 'Todos os clientes selecionados foram excluídos.');
        return response()->json(true);
    }

    public function view($uuid)
    {
        $customer       = $this->customerService->getCustomer($uuid);
        $subscript      = $customer->subscriptions;

        return view('customers.show')->with([
            'customer'      => $customer,
            'totalVencidas' => $customer->invoicesOverdue()->sum('total'),
            'totalInvoices' => $customer->invoicesPending()->sum('total'),
            'subscript'     => $subscript
        ]);
    }

    public function viewImportar()
    {
        return view('customers.import');
    }

    public function viewUpdate($uuid)
    {
        $customer = $this->customerService->getCustomer($uuid);
        return view('customers.edit', compact('customer'));
    }

    public function viewRemove($uuid)
    {
        $customer = $this->customerService->getCustomer($uuid);
        return view('customers.remove', compact('customer'));
    }

    public function deleteCustomer()
    {
        return view('customers.delete');
    }

    public function addCustomer()
    {
        return view('customers.add');
    }

    public function editCustomer($uuid)
    {
        $customer = $this->customerService->getCustomer($uuid);

        return view('customers.edit-customer')->with([
            'customer'  =>  $customer,
        ]);
    }

    public function editSubmitCustomer($uuid, Request $request)
    {
        $addressUpdate = array(
            'zipcode'       => $request->zipcode,
            'address'       => $request->address,
            'number'        => $request->number,
            'uf'            => $request->uf,
            'city'          => $request->city,
            'district'      => $request->district,
            'additional'    => $request->additional
        );

        $customerUpdate = array(
            'type'          => $request->type,
            'account_id'    => $request->account_id,
            'name'          => $request->name,
            'cpf_cnpj'      => $request->cpf_cnpj,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'mobile'        => $request->mobile,
            'rg'            => $request->rg,
            'birthdate'     => $request->birthdate,
            'genre'         => $request->genre,
            'obs'           => $request->obs,
        );

        $customer   = $this->customerService->getCustomer($uuid);
        if($this->customerService->getCustomer($customer->uiid) == null)
        {
            $addressCreate = array(
                'zipcode'       => $request->zipcode,
                'address'       => $request->address,
                'number'        => $request->number,
                'uf'            => $request->uf,
                'city'          => $request->city,
                'district'      => $request->district,
                'additional'    => $request->additional,
                'customer_id'   => $customer->id
            );
            $this->addressService->createAddress($addressCreate);
        }else
        {
            $address = $this->addressService->update($customer->id, $addressUpdate);
        }
        $updateCustomer     = $this->customerService->updateCustomer($uuid, $customerUpdate);
        return redirect()->route('customers.view', $customer->uuid)->with('success','Dados do cliente "'.$customer->name.'" foram atualizados');
    }

    public function searchCustomer($route)
    {
        return view('customers.search', compact('route'));
    }

    public function uniqueCPF(Request $request)
    {

        $input = (object) $request->all();
        $resultado = $this->customerService->getCPF_search(AccountId(), $input->cpf);

        if($resultado == NULL){
            return "livre";
        }else{
            return "já tem";
        }
    }

    public function uniqueEmail(Request $request)
    {
        $input = (object) $request->all();
        $resultado = $this->customerService->getEmail_search(AccountId(), $input->email);

        if($resultado != NULL){
            return response()->json(FALSE);
        }else{
            return response()->json(TRUE);
        }
    }

    public function searchAjax(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Customer::where('name', 'like', '%'.$search.'%')->where('account_id', '=', AccountId())->orderBy('created_at', 'desc')->select('id', 'name', 'email')->take(30)->get();
        }

        return response()->json($data);
    }

    public function searchSimple(Request $request)
    {
        $input = (object) $request->all();
        $clientes = $this->customerService->getAll_search(AccountId(), $input->busca);
        $clientes->appends(request()->query());

        if(count($clientes) > 0){
            return view('customers.index', compact('clientes'));
        }else{
            return view('customers.search_no_results');
        }
    }

    public function searchAdvanced(Request $request)
    {
        $input = (object) $request->all();
        if($input->tipo == "fisica"){
            if(isset($input->cpf)) $cpf_cnpj = $input->cpf;
        }else{
            if(isset($input->cnpj)) $cpf_cnpj = $input->cnpj;
        }

        $busca = array(
            'type' => $input->tipo,
            'email' => (isset($input->email)) ? $input->email : NULL,
            'cpf_cnpj' => (isset($cpf_cnpj)) ? $cpf_cnpj : NULL,
            'phone' => (isset($input->telefone)) ? $input->telefone : NULL
        );

        $clientes = $this->customerService->getAdvanced_search(AccountId(), $busca);
        if(!is_null($clientes)) $clientes->appends(request()->query());

        if(!is_null($clientes)){
            return view('customers.index', compact('clientes'));
        }else{
            return view('customers.search_no_results');
        }

    }

    public function buscaCliente_modal(Request $request)
    {
        $input = (object) $request->all();
        dump($input);

        $resultado = $this->customerService->getAll_search($input->account, $input->search);
        if($resultado != NULL){
            return view('customers.result_search', compact('resultado'));
        }else{
            echo 'Não foi encontrado registros.';
        }
    }

    public function lerArquivo(Request $request)
    {
        $input = (object) $request->all();
        $file = $input->arquivo;

        $import = $this->importService->newImport('customers', $file);
        $path = $request->file('arquivo')->getRealPath();

        if ($request->has('header')){
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        }else{
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0){
            $csv_data   = array_slice($data, 1, 1);
            $csv_header = explode(';', $data[0][0]);
            $csv_rows   = explode(';', $csv_data[0][0]);
            $csv_file   = $import->url;
            $fields_db  = $this->customerService->getFields();

            return view('customers.import_parse', compact(['csv_header', 'csv_rows', 'csv_file', 'fields_db']));
        }else{
            return "Sei la...";
        }
    }

    public function submitImport(Request $request)
    {

        $input = (object) $request->all();
        $data = array_map('str_getcsv', file(storage_path('app/'.$request->url_arquivo)));
        $csv_data   = array_slice($data, 1, count($data));
        $m_import = array();

        foreach ($csv_data as $rows){
            $values = explode(';', $rows[0]);

            for ($i = 0; $i < count($values); $i++){
                if($input->map[$i] != NULL){
                    $import[$input->map[$i]] = $values[$i];
                }
            }
            $import['created_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
            $import['updated_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
            $import['uuid'] = Uuid::generate()->string;
            $import['account_id'] = AccountId();
            $m_import[] = $import;
        }

        if($this->customerService->newCustomer_multiple($m_import)){
            return redirect()->route('customers')->with('success', 'Clientes importados com sucesso.');
        }else{
            return 'Ocorreu um erro.';
        }

    }


}

