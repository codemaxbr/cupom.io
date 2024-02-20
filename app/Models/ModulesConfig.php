<?php

/**
 * Created by Codemax Reliese.
 * Date: Thu, 22 Nov 2018 13:23:14 -0200.
 */

namespace App\Models;

use Codemax\Database\Eloquent\Model as Eloquent;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Webpatser\Uuid\Uuid;

/**
 * Class ModulesConfig
 *
 * @property int $id
 * @property string $uuid
 * @property int $module_id
 * @property string $config
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\Module $module
 *
 * @package App\Models
 */
class ModulesConfig extends Eloquent implements Transformable
{
    use TransformableTrait;

    protected $table = 'modules_config';
    protected $perPage = 20;

    protected $casts = [
        'module_id' => 'int'
    ];

    protected $fillable = [
        'uuid',
        'module_id',
        'account_id',
        'config'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function module()
    {
        return $this->belongsTo(\App\Models\Module::class);
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
