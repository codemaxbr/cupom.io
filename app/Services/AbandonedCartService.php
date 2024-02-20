<?php

namespace App\Services;

use App\Models\AbandonedCart;
use App\Repositories\AbandonedCartRepository;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class AbandonedCartService
{
    /**
     * @var AbandonedCartRepository
     */
    private $abandoned_cartRepository;
    private $abandoned_cart_id;
    private $account_id;

    /**
     * AbandonedCartService constructor.
     */
    public function __construct(AbandonedCartRepository $abandoned_cartRepository)
    {
        $this->abandoned_cartRepository = $abandoned_cartRepository;
    }

    /**
     * Define o ID do AbandonedCart para manipulação
     */
    public function setId($id)
    {
        $this->abandoned_cart_id = $id;
    }

    /**
     * Retorna o número total de registros.
     * @return integer
     */
    public function total()
    {
        return (int) DB::table('abandoned_carts')->count();
    }

    /**
     * Lista todos os registros
     * @return array
     */
    public function getAbandonedCarts($paginate = null)
    {
        $result = $this->abandoned_cartRepository->orderBy('id', 'desc')
            ->with(['customer', 'plan'])
            ->whereHas('account', function ($q){
                $q->where('id', AccountId());
            });

        if(!is_null($paginate)){
            return $result->paginate($paginate);
        }else{
            return $result->all();
        }
    }

    /**
     * Lista todos os registros a partir de uma Busca
     * @return array
     */
    public function searchAbandonedCarts($coluna, $busca, $paginate = null)
    {
        $result = $this->abandoned_cartRepository->findWhere([$coluna, 'LIKE', "%{$busca}%"])->orderBy('id', 'desc');
        if(!is_null($paginate)){
            return $result->paginate($paginate);
        }else{
            return $result->all();
        }
    }

    /**
     * Cria um(a) novo(a) AbandonedCart
     * @param Array
     */
    public function newAbandonedCart($dados)
    {
        if(!empty($dados)){
            return $this->abandoned_cartRepository->create($dados);
        }
    }

    /**
     * Define o status de um(a) AbandonedCart
     * @require $this->setId($id);
     */
    public function setStatus($status)
    {
        if(!empty($status)){
            return $this->abandoned_cartRepository->update(['status' => $status], $this->abandoned_cart_id);
        }
    }

    /**
     * Atualiza dados de um(a) AbandonedCart
     * @param Array
     * @require $this->setId($id);
     */
    public function updateAbandonedCart($dados)
    {
        if(!empty($dados)){
            return $this->abandoned_cartRepository->update($dados, $this->abandoned_cart_id);
        }
    }

    /**
     * Remover um AbandonedCart
     * @require $this->setId($id);
     */
    public function deleteAbandonedCart()
    {
        if($this->abandoned_cartRepository->delete($this->abandoned_cart_id)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Retorna os dados do(a) AbandonedCart
     * @require $this->setId($id);
     * @return Object
     */
    public function getAbandonedCart()
    {
        return $this->abandoned_cartRepository->find($this->abandoned_cart_id)->first();
    }

    /**
     * Retorna os campos de Importação da tabela "abandoned_carts"
     */
    public function getFields()
    {
        $temp = DB::select(DB::raw("SHOW FULL FIELDS FROM abandoned_carts"));
        $fields = array();
        foreach ($temp as $val){
            $fields[$val->Field] = $val->Comment;
        }

        return array_filter($fields);
    }
}