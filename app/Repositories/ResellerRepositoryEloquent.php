<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ResellerRepository;
use App\Models\Reseller;
use App\Validators\ResellerValidator;

/**
 * Class ResellerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ResellerRepositoryEloquent extends BaseRepository implements ResellerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reseller::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
