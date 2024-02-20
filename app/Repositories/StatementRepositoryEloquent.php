<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StatementRepository;
use App\Models\Statement;
use App\Validators\StatementValidator;

/**
 * Class StatementRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StatementRepositoryEloquent extends BaseRepository implements StatementRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Statement::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
