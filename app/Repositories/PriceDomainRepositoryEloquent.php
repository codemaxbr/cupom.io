<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PriceDomainRepository;
use App\Models\PriceDomain;
use App\Validators\PriceDomainValidator;

/**
 * Class PriceDomainRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PriceDomainRepositoryEloquent extends BaseRepository implements PriceDomainRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PriceDomain::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
