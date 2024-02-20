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
 * Class ModulesAccount
 * 
 * @property int $id
 * @property string $uuid
 * @property int $module_id
 * @property int $server_id
 * @property int $account_id
 * @property string $config
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Module $module
 * @property \App\Models\Server $server
 *
 * @package App\Models
 */
class ModulesAccount extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $table = 'modules_account';
	protected $perPage = 20;

	protected $casts = [
		'module_id' => 'int',
		'server_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'module_id',
		'server_id',
		'account_id',
		'config'
	];

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function module()
	{
		return $this->belongsTo(\App\Models\Module::class);
	}

	public function server()
	{
		return $this->belongsTo(\App\Models\Server::class);
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
