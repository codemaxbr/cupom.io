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
 * Class Transaction
 * 
 * @property int $id
 * @property int $invoice_id
 * @property int $customer_id
 * @property float $total
 * @property int $module_id
 * @property string $external_id
 * @property string $status
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\Invoice $invoice
 * @property \App\Models\Module $module
 *
 * @package App\Models
 */
class Transaction extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'invoice_id' => 'int',
		'customer_id' => 'int',
		'total' => 'float',
		'module_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'customer_id',
		'total',
		'module_id',
		'external_id',
		'status',
		'url',
		'account_id'
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

	public function invoice()
	{
		return $this->belongsTo(\App\Models\Invoice::class);
	}

	public function module()
	{
		return $this->belongsTo(\App\Models\Module::class);
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
