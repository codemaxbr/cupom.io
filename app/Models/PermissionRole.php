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
 * Class PermissionRole
 * 
 * @property int $permission_id
 * @property int $role_id
 * @property int $value
 * @property \Carbon\Carbon $expires
 * 
 * @property \App\Models\Permission $permission
 * @property \App\Models\Role $role
 *
 * @package App\Models
 */
class PermissionRole extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $table = 'permission_role';
	protected $primaryKey = NULL;
	public $incrementing = false;
	protected $perPage = 20;
	public $timestamps = false;

	protected $casts = [
		'permission_id' => 'int',
		'role_id' => 'int',
		'value' => 'int'
	];

	protected $dates = [
		'expires'
	];

	protected $fillable = [
		'permission_id',
		'role_id',
		'value',
		'expires'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
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
