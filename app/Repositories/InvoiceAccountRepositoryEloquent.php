<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoiceAccountRepository;
use App\Models\InvoiceAccount;
use App\Validators\InvoiceAccountValidator;

/**
 * Class InvoiceAccountRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoiceAccountRepositoryEloquent extends BaseRepository implements InvoiceAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvoiceAccount::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
