<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @property string $description
 * @property int $email_template_id
 * @property bool $domain
 * @property float $price
 * @property int $type_term_id
 * @property int $trial
 * @property int $payment_cycle_id
 * @property int $visibility
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 *
 * @property \App\Models\Account $account
 * @property \App\Models\PaymentCycle $payment_cycle
 * @property \App\Models\TypeTerm $type_term
 * @property \Illuminate\Database\Eloquent\Collection $invoice_items
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 *
 * @package App\Models
 */

/**
 * Class Optional.
 *
 * @package namespace App\Models;
 */
class Optional extends Model implements Transformable
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
        'payment_cycle_id' => 'int',
        'visibility' => 'int',
        'account_id' => 'int'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uuid',
        'status',
        'description',
        'email_template_id',
        'domain',
        'suspend_principal',
        'price',
        'type_term_id',
        'trial',
        'payment_cycle_id',
        'visibility',
        'plans',
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

    public function payment_cycle()
    {
        return $this->belongsTo(\App\Models\PaymentCycle::class);
    }

    public function type_term()
    {
        return $this->belongsTo(\App\Models\TypeTerm::class);
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
