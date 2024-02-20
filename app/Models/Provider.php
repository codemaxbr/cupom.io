<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Webpatser\Uuid\Uuid;

/**
 * Class Provider.
 *
 * @package namespace App\Models;
 */
class Provider extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fantasia',
        'uuid',
        'email',
        'type',
        'cpf_cnpj',
        'phone',
        'insc_municipal',
        'insc_estadual',
        'birthdate',
        'mobile',
        'status',
        'obs',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function debits()
    {
        return $this->hasMany(\App\Models\Debit::class);
    }

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

    public function servers()
    {
        return $this->hasMany(\App\Models\Server::class);
    }

    public function address()
    {
        return $this->hasOne(\App\Models\Address::class);
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
