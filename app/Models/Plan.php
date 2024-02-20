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
 * Class Plan
 * 
 * @property int $id
 * @property string $name
 * @property string $uuid
 * @property bool $status
 * @property int $type_plan_id
 * @property string $description
 * @property int $email_template_id
 * @property bool $domain
 * @property float $price
 * @property int $type_term_id
 * @property int $trial
 * @property float $price_installment
 * @property int $installments
 * @property int $payment_cycle_id
 * @property int $visibility
 * @property int $module_id
 * @property int $server_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\PaymentCycle $payment_cycle
 * @property \App\Models\TypePlan $type_plan
 * @property \App\Models\TypeTerm $type_term
 * @property \Illuminate\Database\Eloquent\Collection $abandoned_carts
 * @property \Illuminate\Database\Eloquent\Collection $cancellations
 * @property \Illuminate\Database\Eloquent\Collection $invoice_items
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 *
 * @package App\Models
 */
class Plan extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'status' => 'bool',
		'type_plan_id' => 'int',
		'email_template_id' => 'int',
		'domain' => 'bool',
		'price' => 'float',
		'type_term_id' => 'int',
		'trial' => 'int',
		'price_installment' => 'float',
		'installments' => 'int',
		'payment_cycle_id' => 'int',
		'visibility' => 'int',
		'module_id' => 'int',
		'server_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'name',
		'uuid',
		'status',
		'type_plan_id',
		'description',
		'email_template_id',
		'domain',
		'price',
		'type_term_id',
		'trial',
		'price_installment',
		'installments',
		'payment_cycle_id',
		'visibility',
		'module_id',
		'server_id',
		'account_id',
        'config'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

	public function payment_cycle()
	{
		return $this->belongsTo(\App\Models\PaymentCycle::class);
	}

	public function module()
    {
        return $this->belongsTo(\App\Models\Module::class);
    }

    public function server()
    {
        return $this->belongsTo(\App\Models\Server::class);
    }

	public function type_plan()
	{
		return $this->belongsTo(\App\Models\TypePlan::class);
	}

	public function type_term()
	{
		return $this->belongsTo(\App\Models\TypeTerm::class);
	}

	public function abandoned_carts()
	{
		return $this->hasMany(\App\Models\AbandonedCart::class);
	}

	public function cancellations()
	{
		return $this->hasMany(\App\Models\Cancellation::class);
	}

	public function invoice_items()
	{
		return $this->hasMany(\App\Models\InvoiceItem::class);
	}

	public function statements()
	{
		return $this->hasMany(\App\Models\Statement::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(\App\Models\Subscription::class);
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
