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
 * Class Option
 * 
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 *
 * @package App\Models
 */
class Option extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;
	public $timestamps = false;

	protected $casts = [
		'account_id' => 'int'
	];

	protected $fillable = [
		'name',
		'value',
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if(isset($model->uuid))
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
