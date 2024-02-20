<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CancellationRepository;
use App\Models\Cancellation;
use App\Validators\CancellationValidator;

/**
 * Class CancellationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CancellationRepositoryEloquent extends BaseRepository implements CancellationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cancellation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
