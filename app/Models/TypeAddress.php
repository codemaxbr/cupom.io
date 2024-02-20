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
 * Class TypeAddress
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @package App\Models
 */
class TypeAddress extends Eloquent implements Transformable
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if(isset($model->uuid))
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
