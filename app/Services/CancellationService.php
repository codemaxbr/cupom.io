<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Cancellation;
use App\Repositories\CancellationRepository;

class CancellationService
{
    /**
     * @var CancellationRepository
     */
    private $cancellationRepository;
    private $account;

    /**
     * CancellationService constructor.
     */
    public function __construct(CancellationRepository $cancellationRepository)
    {
        $this->cancellationRepository = $cancellationRepository;
        $this->account = Account::find(AccountId());
    }

    public function getCancellations()
    {
        return $this->account->cancellations()->paginate(20);
    }
}