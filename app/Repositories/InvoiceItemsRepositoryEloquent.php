<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoiceItemsRepository;
use App\Models\InvoiceItem;
use App\Validators\InvoiceItemsValidator;

/**
 * Class InvoiceItemsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoiceItemsRepositoryEloquent extends BaseRepository implements InvoiceItemsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvoiceItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
