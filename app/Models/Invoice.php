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
 * Class Invoice
 * 
 * @property int $id
 * @property int $customer_id
 * @property float $total
 * @property float $fee
 * @property float $discount
 * @property int $type_invoice_id
 * @property string $uuid
 * @property \Carbon\Carbon $due
 * @property string $reason
 * @property string $obs
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Customer $customer
 * @property \App\Models\TypeInvoice $type_invoice
 * @property \Illuminate\Database\Eloquent\Collection $invoice_histories
 * @property \Illuminate\Database\Eloquent\Collection $invoice_items
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 *
 * @package App\Models
 */
class Invoice extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'customer_id' => 'int',
		'total' => 'float',
		'fee' => 'float',
		'discount' => 'float',
		'type_invoice_id' => 'int',
		'statement_id' => 'int',
		'status' => 'int',
		'account_id' => 'int'
	];

	protected $dates = [
		'due'
	];

	protected $fillable = [
		'customer_id',
		'total',
		'fee',
		'discount',
		'type_invoice_id',
		'uuid',
		'due',
		'reason',
		'obs',
		'status',
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

	public function type_invoice()
	{
		return $this->belongsTo(\App\Models\TypeInvoice::class);
	}

	public function invoice_histories()
	{
		return $this->hasMany(\App\Models\InvoiceHistory::class);
	}

	public function invoice_items()
	{
		return $this->hasMany(\App\Models\InvoiceItem::class);
	}
/*
	public function statements()
    {
        return $this->hasMany(\App\Models\Statement::class);
    }*/

	public function statement()
	{
		return $this->hasOne(\App\Models\Statement::class);
	}

    public function attachment()
    {
        return $this->morphOne(\App\Models\Attachment::class, 'attachmentable');
    }

	public function subscriptions()
	{
		return $this->belongsToMany(\App\Models\Subscription::class, 'subscriptions_invoices')
					->withPivot('id')
					->withTimestamps();
	}

	public function transactions()
	{
		return $this->hasMany(\App\Models\Transaction::class);
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
