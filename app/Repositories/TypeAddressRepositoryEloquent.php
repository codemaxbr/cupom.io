<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TypeAddressRepository;
use App\Models\TypeAddress;
use App\Validators\TypeAddressValidator;

/**
 * Class TypeAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TypeAddressRepositoryEloquent extends BaseRepository implements TypeAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TypeAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
