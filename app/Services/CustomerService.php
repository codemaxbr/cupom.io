<?php
namespace App\Services;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    private $account_id;

    /**
     * CustomerService constructor.
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        //$this->account_id = AccountId();
    }

    public function total($account)
    {
        return DB::table('customers as c')
            ->where('account_id', $account)
            ->count();
    }

    public function getCustomers($paginate)
    {
        $result = $this->customerRepository->orderBy('id', 'desc')
            ->whereHas('account', function ($q){
                $q->where('id', AccountId());
            });

        if(!is_null($paginate)){
            return $result->paginate($paginate);
        }else{
            return $result->all();
        }
    }

    public function getAll_search($account, $search)
    {
        $this->account_id = $account;

        return Customer::with('account')
            ->whereHas('account', function ($q){
                $q->where('id', $this->account_id);
            })
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(20);
    }

    public function getAjax_search($account, $search)
    {
        $this->account_id = $account;

        return Customer::with('account')
            ->select('id', 'uuid', 'name', 'email')
            ->whereHas('account', function ($q){
                $q->where('id', $this->account_id);
            })
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(20);
    }

    public function getAdvanced_search($account, $search)
    {
        $this->account_id = $account;

        $customers = Customer::with('account')
            ->whereHas('account', function ($q){
                $q->where('id', $this->account_id);
            });
        if($search['type'] != NULL){
            $customers->where('type', $search['type']);
        }

        if($search['cpf_cnpj'] != NULL){
            $customers->where('cpf_cnpj', $search['cpf_cnpj']);
        }

        if($search['email'] != NULL){
            $customers->where('email', $search['email']);
        }

        if($search['phone'] != NULL){
            $customers->where('phone', $search['phone']);
        }

        $customers->orderBy('name', 'asc');

        return ($customers->paginate(20)->total() != 0) ? $customers->paginate(20) : NULL;
        /*

        $customers = DB::table('customers as c');
        $customers->where('c.account_id', $account);
        if($search['type'] != NULL){
            $customers->where('c.type', $search['type']);
        }

        if($search['cpf_cnpj'] != NULL){
            $customers->where('c.cpf_cnpj', $search['cpf_cnpj']);
        }

        if($search['email'] != NULL){
            $customers->where('c.email', $search['email']);
        }

        if($search['phone'] != NULL){
            $customers->where('c.phone', $search['phone']);
        }

        $customers->orderBy('name', 'asc');

        return ($customers->paginate(15)->total() != 0) ? $customers->paginate(15) : NULL;
        */
    }

    public function getCPF_search($account, $search)
    {
        $customers = DB::table('customers as c')
            ->where('c.account_id', $account)
            ->where('c.cpf_cnpj', $search)
            ->get();

        return ($customers->isNotEmpty()) ? $customers : NULL;
    }

    public function getEmail_search($account, $email)
    {
        $customers = DB::table('customers as c')
            ->where('c.account_id', $account)
            ->where('c.email', $email)
            ->get();

        return ($customers->isNotEmpty()) ? $customers : NULL;
    }

    public function newCustomer($dados)
    {
        if(!empty($dados)){

            unset($dados['_token']);

            $dados['created_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
            $dados['updated_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
            $dados['uuid'] = Uuid::generate()->string;

            $customer = Customer::create($dados);
            return $customer;
        }
    }

    public function newCustomer_multiple($dados)
    {
        if(!empty($dados)){
            $customer = DB::table('customers')->insert($dados);
            return $customer;
        }
    }

    public function updateCustomer($id, $dados)
    {
        return DB::table('customers')
            ->where('uuid', $id)
            ->update($dados);
    }

    public function deleteCustomer($id)
    {
        if(DB::table('customers')->where('uuid', $id)->delete()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getCustomer($uuid, $coluna = 'uuid')
    {
        return Customer::with('address', 'statements', 'subscriptions')->where($coluna, $uuid)->first();
    }

    public function getFields()
    {
        //$temp = $this->newQuery()->fromQuery("SHOW FIELDS FROM ".$this->getTable());
        $temp = DB::select(DB::raw("SHOW FULL FIELDS FROM customers"));
        $fields = array();
        foreach ($temp as $val){
            $fields[$val->Field] = $val->Comment;
        }

        return array_filter($fields);
    }

    public function getTotal()
    {
        return Customer::query()->count(['id']);
    }
}