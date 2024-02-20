<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DebitRepository;
use App\Models\Debit;
use App\Validators\DebitValidator;

/**
 * Class DebitRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DebitRepositoryEloquent extends BaseRepository implements DebitRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Debit::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
