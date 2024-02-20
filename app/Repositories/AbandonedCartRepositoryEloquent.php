<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AbandonedCartRepository;
use App\Models\AbandonedCart;
use App\Validators\AbandonedCartValidator;

/**
 * Class AbandonedCartRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AbandonedCartRepositoryEloquent extends BaseRepository implements AbandonedCartRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AbandonedCart::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
