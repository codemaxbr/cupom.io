<?php

/**
 * Created by Codemax Reliese.
 * Date: Sun, 26 Aug 2018 20:25:46 -0300.
 */

namespace App\Models;

use Codemax\Database\Eloquent\Model as Eloquent;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Attachment
 * 
 * @property int $id
 * @property string $name
 * @property string $uuid
 * @property int $account_id
 * @property string $attachmentable_type
 * @property int $attachmentable_id
 * @property string $file_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Account $account
 *
 * @package App\Models
 */
class Attachment extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'account_id' => 'int',
		'attachmentable_id' => 'int'
	];

	protected $fillable = [
		'name',
		'uuid',
		'account_id',
		'attachmentable_type',
		'attachmentable_id',
		'file_url'
	];

	public function attachmentable()
    {
        return $this->morphTo();
    }

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}
}
