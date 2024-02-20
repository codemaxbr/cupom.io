<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AccountPlanRepository;
use App\Models\AccountPlan;
use App\Validators\AccountPlanValidator;

/**
 * Class AccountPlanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountPlanRepositoryEloquent extends BaseRepository implements AccountPlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AccountPlan::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
