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
 * Class Shoppingcart
 * 
 * @property string $identifier
 * @property string $instance
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Shoppingcart extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $table = 'shoppingcart';
	protected $primaryKey = 'identifier';
	public $incrementing = false;
	protected $perPage = 20;

	protected $fillable = [
		'content'
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
