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
 * Class TypePayment
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * 
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 *
 * @package App\Models
 */
class TypePayment extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'name',
		'slug'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
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
