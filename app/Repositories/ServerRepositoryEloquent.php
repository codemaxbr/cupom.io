<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ServerRepository;
use App\Models\Server;
use App\Validators\ServerValidator;

/**
 * Class ServerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ServerRepositoryEloquent extends BaseRepository implements ServerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Server::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
