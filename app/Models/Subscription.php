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
 * Class Subscription
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $plan_id
 * @property \Carbon\Carbon $due
 * @property float $total
 * @property \Carbon\Carbon $activated_at
 * @property bool $trial
 * @property bool $recurrence
 * @property int $status
 * @property string $domain
 * @property int $server_id
 * @property string $login_user
 * @property string $login_password
 * @property string $comment
 * @property int $type_payment_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\Plan $plan
 * @property \App\Models\TypePayment $type_payment
 * @property \Illuminate\Database\Eloquent\Collection $invoices
 *
 * @package App\Models
 */
class Subscription extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'plan_id' => 'int',
		'total' => 'float',
		'trial' => 'bool',
		'recurrence' => 'bool',
		'status' => 'int',
		'server_id' => 'int',
		'type_payment_id' => 'int',
		'account_id' => 'int',
        'cancelled' => 'bool'
	];

	protected $dates = [
		'due',
		'activated_at'
	];

	protected $hidden = [
		'login_password'
	];

	protected $fillable = [
		'customer_id',
		'plan_id',
		'due',
		'total',
		'activated_at',
		'trial',
		'recurrence',
		'status',
		'domain',
		'server_id',
		'login_user',
		'login_password',
		'comment',
		'type_payment_id',
		'account_id',
        'cancelled'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

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

    public function optional()
    {
        return $this->belongsTo(\App\Models\Optional::class);
    }

	public function type_payment()
	{
		return $this->belongsTo(\App\Models\TypePayment::class);
	}

	public function invoices()
	{
		return $this->belongsToMany(\App\Models\Invoice::class, 'subscriptions_invoices')
					->withPivot('id')
					->withTimestamps();
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
