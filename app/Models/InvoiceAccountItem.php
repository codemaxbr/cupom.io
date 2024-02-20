<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InvoiceAccountItem.
 *
 * @package namespace App\Models;
 */
class InvoiceAccountItem extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_account_id',
        'account_plan_id',
        'domain',
        'description',
        'price',
        'discount',
        'qty',
        'data',
        'data_end',
    ];

    public function invoice_account()
    {
        return $this->belongsTo(\App\Models\InvoiceAccount::class);
    }

    public function account_plan()
    {
        return $this->belongsTo(\App\Models\AccountPlan::class);
    }

}
