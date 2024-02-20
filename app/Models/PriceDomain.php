<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PriceDomain.
 *
 * @package namespace App\Models;
 */
class PriceDomain extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extension',
        'cost',
        'price_register',
        'price_renew',
        'price_transfer',
        'module_id',
        'account_id'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function module()
    {
        return $this->belongsTo(\App\Models\Module::class);
    }

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

}
