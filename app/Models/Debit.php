<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Debit.
 *
 * @package namespace App\Models;
 */
class Debit extends Model implements Transformable
{
    use TransformableTrait;

    protected $casts = [
        'provider_id' => 'int',
        'total' => 'float',
        'account_id' => 'int'
    ];

    protected $dates = [
        'due'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total',
        'provider_id',
        'account_id',
        'due',
        'paid',
        'n_document',
        'payment_cycle_id',
        'description',
    ];

    public function payment_cycle()
    {
        return $this->belongsTo(\App\Models\PaymentCycle::class);
    }

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachmentable');
    }

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class);
    }
}
