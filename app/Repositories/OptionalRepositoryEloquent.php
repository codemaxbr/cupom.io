<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OptionalRepository;
use App\Models\Optional;
use App\Validators\OptionalValidator;

/**
 * Class OptionalRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OptionalRepositoryEloquent extends BaseRepository implements OptionalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Optional::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
