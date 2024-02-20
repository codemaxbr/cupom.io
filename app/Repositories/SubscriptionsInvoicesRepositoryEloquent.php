<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubscriptionsInvoicesRepository;
use App\Models\SubscriptionsInvoice;
use App\Validators\SubscriptionsInvoicesValidator;

/**
 * Class SubscriptionsInvoicesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubscriptionsInvoicesRepositoryEloquent extends BaseRepository implements SubscriptionsInvoicesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubscriptionsInvoice::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
