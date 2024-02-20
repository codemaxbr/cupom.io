<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AccountDetailRepository;
use App\Models\AccountDetail;
use App\Validators\AccountDetailValidator;

/**
 * Class AccountDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountDetailRepositoryEloquent extends BaseRepository implements AccountDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AccountDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
