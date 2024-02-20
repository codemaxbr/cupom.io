<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AccountDetail.
 *
 * @package namespace App\Models;
 */
class AccountDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'owner',
        'email',
        'cpf_cnpj',
        'phone',
        'type',
        'account_plan_id',
        'type_payment_id',
        'payment_cycle_id',
        'expires'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function payment_cycle()
    {
        return $this->belongsTo(\App\Models\PaymentCycle::class);
    }

    public function type_payment()
    {
        return $this->belongsTo(\App\Models\TypePayment::class);
    }

    public function account_plan()
    {
        return $this->belongsTo(\App\Models\AccountPlan::class);
    }
}
