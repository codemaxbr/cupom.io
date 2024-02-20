<?php

/**
 * Created by Codemax Reliese.
 * Date: Tue, 02 Oct 2018 12:44:47 -0300.
 */

namespace App\Models;

use Codemax\Database\Eloquent\Model as Eloquent;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Webpatser\Uuid\Uuid;

/**
 * Class AbandonedCart
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $plan_id
 * @property string $ip
 * @property string $email
 * @property float $total
 * @property bool $status
 * @property bool $status_email
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\Plan $plan
 *
 * @package App\Models
 */
class AbandonedCart extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'plan_id' => 'int',
		'total' => 'float',
		'status' => 'bool',
		'status_email' => 'bool',
		'account_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'plan_id',
		'ip',
		'email',
		'total',
		'status',
		'status_email',
		'account_id'
	];

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}

	public function plan()
	{
		return $this->belongsTo(\App\Models\Plan::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if(isset($model->uuid))
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
