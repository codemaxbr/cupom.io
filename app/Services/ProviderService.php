<?php
/**
 * Created by PhpStorm.
 * User: codemaxbr
 * Date: 29/01/19
 * Time: 18:32
 */

namespace App\Services;

use App\Models\Account;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Carbon\Carbon;

class ProviderService
{
    /**
     * @var ProviderRepository
     */
    private $providerRepository;

    /**
     * ProviderService constructor.
     */
    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function getAll()
    {
        $providers = Provider::withCount(['servers', 'debits' => function($query){
                $query->whereMonth('due', '=', Carbon::now()->format('m')); // Contar apenas os que tiver Conta para pagar no mês atual
                $query->where('paid', '=', null);
            }])

            ->whereHas('account', function ($q){
                $q->where('id', AccountId());
            })
            ->paginate(20);

        return $providers;
    }
}