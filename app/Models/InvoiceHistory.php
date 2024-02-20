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
 * Class InvoiceHistory
 * 
 * @property int $id
 * @property string $name
 * @property int $invoice_id
 * @property int $type_activity_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Invoice $invoice
 * @property \App\Models\TypeActivity $type_activity
 *
 * @package App\Models
 */
class InvoiceHistory extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'invoice_id' => 'int',
		'type_activity_id' => 'int'
	];

	protected $fillable = [
		'name',
		'invoice_id',
		'type_activity_id'
	];

	public function invoice()
	{
		return $this->belongsTo(\App\Models\Invoice::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function type_activity()
	{
		return $this->belongsTo(\App\Models\TypeActivity::class);
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
