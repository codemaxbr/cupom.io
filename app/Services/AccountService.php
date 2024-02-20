<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\AccountRepository;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class AccountService
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;
    private $find = array();

    /**
     * AccountService constructor.
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Verifica se já existe uma conta por um domínio específico
     *
     * @param $domain
     * @return bool
     */
    public function existsDomain($domain)
    {
        $count = DB::table('accounts as acc')
            ->where('domain', $domain)
            ->count();

        return ($count > 0) ? TRUE : FALSE;
    }

    /**
     * Retorna os dados de uma conta pelo ID ou Dominio
     *
     * @param $where
     * @return mixed
     */
    public function getAccount($where)
    {
        if(!empty($where) and is_numeric($where))
        {
            $this->find = array('id' => $where);
        }else{
            $this->find = array('domain' => $where);
        }

        return $this->accountRepository->findWhere($this->find)->first();
    }

    /**
     * Retorna todos os registros
     * @return array
     */
    public function getAccounts()
    {
        $accounts = DB::table('accounts')->get();
        return ($accounts->isNotEmpty()) ? $accounts : NULL;
    }

    /**
     * Cria uma nova conta
     * @param $dados = [
    'name_business' => 'Codemax Sistemas',
    'domain' => 'codemax',
    'email_contact' => 'lucas.codemax@gmail.com',
    ];
     * @return mixed
     */
    public function newAccount($dados)
    {
        $dados['created_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
        $dados['updated_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        return DB::table('accounts')->insertGetId($dados);
    }

    /**
     * Atualiza os dados de uma conta e confirma se foi alterado ou não.
     * @param $dados
     * @param $id
     * @return bool
     */
    public function editAccount($dados, $id)
    {
        $dados['updated_at'] = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        $account = DB::table('accounts')
            ->where('id', $id)
            ->update($dados);

        return ($account == 1) ? true : false;
    }

    /**
     * @param $id
     */
    public function activate($id)
    {
        if($account = $this->getAccount($id))
        {
            $set = [
                'status' => 1
            ];

            if($this->editAccount($set, $id)){
                echo 'envia email de confirmação de ativação. => '.$account->email_contact;
            }

            return true;
        }else{
            return false;
        }
    }
}