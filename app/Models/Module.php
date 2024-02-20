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
 * Class Module
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $logo
 * @property string $description
 * @property int $type_module_id
 * 
 * @property \App\Models\TypeModule $type_module
 * @property \Illuminate\Database\Eloquent\Collection $accounts
 * @property \Illuminate\Database\Eloquent\Collection $servers
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 *
 * @package App\Models
 */
class Module extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;
	public $timestamps = false;

	protected $casts = [
		'type_module_id' => 'int'
	];

	protected $fillable = [
		'name',
		'slug',
		'logo',
		'description',
		'type_module_id'
	];

	public function type_module()
	{
		return $this->belongsTo(\App\Models\TypeModule::class);
	}

	public function accounts()
	{
		return $this->belongsToMany(\App\Models\Account::class, 'modules_account')
					->withPivot('id', 'uuid', 'server_id', 'config')
					->withTimestamps();
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function servers()
	{
		return $this->hasMany(\App\Models\Server::class);
	}

	public function transactions()
	{
		return $this->hasMany(\App\Models\Transaction::class);
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
