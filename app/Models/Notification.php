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
 * Class Notification
 * 
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Notification extends Eloquent implements Transformable
{
    use TransformableTrait;

	public $incrementing = false;
	protected $perPage = 20;

	protected $casts = [
		'notifiable_id' => 'int'
	];

	protected $dates = [
		'read_at'
	];

	protected $fillable = [
		'type',
		'notifiable_type',
		'notifiable_id',
		'data',
		'read_at'
	];

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
