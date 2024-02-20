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
 * Class InvoiceItem
 * 
 * @property int $id
 * @property int $type_plan_id
 * @property int $invoice_id
 * @property int $plan_id
 * @property string $domain
 * @property string $description
 * @property float $price
 * @property float $discount
 * @property int $qty
 * @property \Carbon\Carbon $data
 * @property \Carbon\Carbon $data_end
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Invoice $invoice
 * @property \App\Models\Plan $plan
 * @property \App\Models\TypePlan $type_plan
 *
 * @package App\Models
 */
class InvoiceItem extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'type_plan_id' => 'int',
		'invoice_id' => 'int',
		'plan_id' => 'int',
		'price' => 'float',
		'discount' => 'float',
		'qty' => 'int'
	];

	protected $dates = [
		'data',
		'data_end'
	];

	protected $fillable = [
		'type_plan_id',
		'invoice_id',
		'plan_id',
		'domain',
		'description',
		'price',
		'discount',
		'qty',
		'data',
		'data_end'
	];

	public function invoice()
	{
		return $this->belongsTo(\App\Models\Invoice::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function plan()
	{
		return $this->belongsTo(\App\Models\Plan::class);
	}

	public function type_plan()
	{
		return $this->belongsTo(\App\Models\TypePlan::class);
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
