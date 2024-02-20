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
 * Class CreditCard
 * 
 * @property int $id
 * @property string $flag
 * @property string $start_number
 * @property string $final_number
 * @property string $owner
 * @property string $expires
 * @property int $customer_id
 * @property int $payment_profile_id
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 *
 * @package App\Models
 */
class CreditCard extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'payment_profile_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'flag',
		'start_number',
		'final_number',
		'owner',
		'expires',
		'customer_id',
		'payment_profile_id',
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if(isset($model->uuid))
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
