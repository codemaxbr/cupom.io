<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TypeInvoiceItemsRepository;
use App\Models\TypeInvoiceItems;
use App\Validators\TypeInvoiceItemsValidator;

/**
 * Class TypeInvoiceItemsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TypeInvoiceItemsRepositoryEloquent extends BaseRepository implements TypeInvoiceItemsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TypeInvoiceItems::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
