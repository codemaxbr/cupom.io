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
 * Class Cancellation
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $plan_id
 * @property float $total
 * @property string $domain
 * @property \Carbon\Carbon $activated_at
 * @property \Carbon\Carbon $cancelled_at
 * @property string $reason
 * @property int $user_id
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\Plan $plan
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Cancellation extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'plan_id' => 'int',
		'total' => 'float',
		'user_id' => 'int',
		'account_id' => 'int'
	];

	protected $dates = [
		'activated_at',
		'cancelled_at'
	];

	protected $fillable = [
		'customer_id',
		'plan_id',
		'total',
		'domain',
		'activated_at',
		'cancelled_at',
		'reason',
		'user_id',
		'account_id'
	];

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}

	public function plan()
	{
		return $this->belongsTo(\App\Models\Plan::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
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
