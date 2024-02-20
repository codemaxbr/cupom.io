<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AccountPlan.
 *
 * @package namespace App\Models;
 */
class AccountPlan extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'status',
        'payment_cycle_id',
        'reseller_id',
    ];

    public function accounts()
    {
        return $this->hasMany(\App\Models\AccountDetail::class);
    }

    public function payment_cycle()
    {
        return $this->belongsTo(\App\Models\PaymentCycle::class);
    }

    public function reseller()
    {
        return $this->belongsTo(\App\Models\Reseller::class);
    }
}
