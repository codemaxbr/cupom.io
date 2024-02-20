<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InvoiceAccount.
 *
 * @package namespace App\Models;
 */
class InvoiceAccount extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'total',
        'fee',
        'discount',
        'type_invoice_id',
        'uuid',
        'due',
        'obs',
        'status',
        'reseller_id',
    ];

    public function invoice_items()
    {
        return $this->hasMany(\App\Models\InvoiceAccountItem::class);
    }

    public function reseller()
    {
        return $this->belongsTo(\App\Models\Reseller::class);
    }

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function type_invoice()
    {
        return $this->belongsTo(\App\Models\TypeInvoice::class);
    }

}
