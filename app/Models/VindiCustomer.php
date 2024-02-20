<?php

/**
 * Created by Codemax Reliese.
 * Date: Fri, 28 Sep 2018 10:46:27 -0300.
 */

namespace App\Models;

use Codemax\Database\Eloquent\Model as Eloquent;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Webpatser\Uuid\Uuid;

/**
 * Class VindiCustomer
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $vindi_id
 * @property int $payment_profile_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Customer $customer
 *
 * @package App\Models
 */
class VindiCustomer extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'vindi_id' => 'int',
		'payment_profile_id' => 'int'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	protected $fillable = [
		'customer_id',
		'vindi_id',
		'payment_profile_id'
	];

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}
}
