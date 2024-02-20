<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlansGridRepository;
use App\Models\PlansGrid;
use App\Validators\PlansGridValidator;

/**
 * Class PlansGridRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlansGridRepositoryEloquent extends BaseRepository implements PlansGridRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlansGrid::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
