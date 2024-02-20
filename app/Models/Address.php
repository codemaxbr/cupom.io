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
 * Class Address
 * 
 * @property int $id
 * @property string $zipcode
 * @property string $address
 * @property string $number
 * @property string $uf
 * @property string $city
 * @property string $district
 * @property string $additional
 * @property int $customer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Customer $customer
 *
 * @package App\Models
 */
class Address extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int'
	];

	protected $fillable = [
		'zipcode',
		'address',
		'number',
		'uf',
		'city',
		'district',
		'additional',
		'customer_id',
        'provider_id'
	];

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}

    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class);
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
