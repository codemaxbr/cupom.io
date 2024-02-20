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
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string $readable_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Permission extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $fillable = [
		'name',
		'readable_name'
	];

	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class)
					->withPivot('value', 'expires');
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('value', 'expires');
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
