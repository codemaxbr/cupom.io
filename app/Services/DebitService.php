<?php
namespace App\Services;

use App\Models\Debit;
use App\Repositories\DebitRepository;

class DebitService
{
    /**
     * @var DebitRepository
     */
    private $debitRepository;

    /**
     * DebitService constructor.
     */
    public function __construct(DebitRepository $debitRepository)
    {
        $this->debitRepository = $debitRepository;
    }

    public function getAll()
    {
        return Debit::query()->where(['account_id' => AccountId()])->paginate(20);
    }
}