<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoiceAccountItemRepository;
use App\Models\InvoiceAccountItem;
use App\Validators\InvoiceAccountItemValidator;

/**
 * Class InvoiceAccountItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoiceAccountItemRepositoryEloquent extends BaseRepository implements InvoiceAccountItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvoiceAccountItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
