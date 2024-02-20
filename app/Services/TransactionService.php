<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 25/09/2018
 * Time: 22:11
 */

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * TransactionService constructor.
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransactions()
    {
        return $this->transactionRepository->findWhere(['account_id' => AccountId()]);
    }

    public function createTransaction($dados)
    {
        return $this->transactionRepository->create($dados);
    }

    public function getExternalId($id)
    {
        return $this->transactionRepository->findWhere(['external_id' => $id])->first();
    }

    public function getTransaction($id)
    {
        return $this->transactionRepository->find($id);
    }

    public function updateTransaction($id, $dados)
    {
        return $this->transactionRepository->update($dados, $id);
    }
}