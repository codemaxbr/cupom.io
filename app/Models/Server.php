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
 * Class Server
 * 
 * @property int $id
 * @property string $uuid
 * @property string $monitor
 * @property string $name
 * @property string $datacenter
 * @property string $ip
 * @property int $limit_accounts
 * @property float $cost
 * @property string $ns1
 * @property string $ns1_ip
 * @property string $ns2
 * @property string $ns2_ip
 * @property string $ns3
 * @property string $ns3_ip
 * @property string $ns4
 * @property string $ns4_ip
 * @property int $module_id
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Module $module
 * @property \Illuminate\Database\Eloquent\Collection $modules_accounts
 *
 * @package App\Models
 */
class Server extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'limit_accounts' => 'int',
		'cost' => 'float',
		'module_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'monitor',
		'name',
		'datacenter',
		'ip',
		'limit_accounts',
		'config',
		'cost',
		'ns1',
		'ns1_ip',
		'ns2',
		'ns2_ip',
		'ns3',
		'ns3_ip',
		'ns4',
		'ns4_ip',
		'module_id',
		'account_id',
		'provider_id'
	];

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class);
    }

	public function module()
	{
		return $this->belongsTo(\App\Models\Module::class);
	}

	public function modules_accounts()
	{
		return $this->hasMany(\App\Models\ModulesAccount::class);
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
