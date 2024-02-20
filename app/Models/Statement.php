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
 * Class Statement
 * 
 * @property int $id
 * @property string $name
 * @property int $customer_id
 * @property float $total
 * @property string $type
 * @property string $obs
 * @property int $type_payment_id
 * @property int $invoice_id
 * @property int $plan_id
 * @property int $account_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\Invoice $invoice
 * @property \App\Models\Plan $plan
 * @property \App\Models\TypePayment $type_payment
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Statement extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'total' => 'float',
		'type_payment_id' => 'int',
		'invoice_id' => 'int',
		'plan_id' => 'int',
		'account_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'customer_id',
		'total',
		'type',
		'obs',
		'type_payment_id',
		'invoice_id',
		'plan_id',
		'account_id',
        'type_invoice_id',
		'user_id'
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

	public function totalPedido()
    {
        return $this->invoices()->where(['type_invoice_id' => 2]);
    }
/*
	public function invoices()
    {
        return $this->hasMany(\App\Models\Invoice::class);
    }*/

	public function invoice()
	{
		return $this->belongsTo(\App\Models\Invoice::class);
	}

    public function type_invoice()
    {
        return $this->belongsTo(\App\Models\TypeInvoice::class);
    }

	public function plan()
	{
		return $this->belongsTo(\App\Models\Plan::class);
	}

	public function type_payment()
	{
		return $this->belongsTo(\App\Models\TypePayment::class);
	}

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachmentable');
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
