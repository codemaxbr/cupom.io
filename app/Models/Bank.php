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
 * Class Bank
 * 
 * @property int $id
 * @property string $bank
 * @property string $owner
 * @property string $wallet
 * @property string $type_bank
 * @property int $agency
 * @property int $account
 * @property int $digit
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class Bank extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'agency' => 'int',
		'account' => 'int',
		'digit' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'bank',
		'owner',
		'wallet',
		'type_bank',
		'agency',
		'account',
		'digit',
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
