<?php

/**
 * Created by Codemax Reliese.
 * Date: Sun, 26 Aug 2018 19:26:20 -0300.
 */

namespace App\Models;

use Artesaos\Defender\Traits\HasDefender;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $photo
 * @property bool $confirmed
 * @property string $token
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \Illuminate\Database\Eloquent\Collection $cancellations
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \Illuminate\Database\Eloquent\Collection $statements
 *
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasDefender;
    use HasApiTokens;

	protected $perPage = 20;

	protected $casts = [
		'photo' => 'boolean',
		'is_admin' => 'bool',
		'confirmed' => 'bool',
		'account_id' => 'int'
	];

	protected $hidden = [
		'password',
		'token',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'photo',
		'confirmed',
		'is_admin',
		'token',
		'remember_token',
		'account_id'
	];

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

	public function cancellations()
	{
		return $this->hasMany(\App\Models\Cancellation::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(\App\Models\Permission::class)
					->withPivot('value', 'expires');
	}

	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class);
	}

	public function isAdmin()
    {
        return $this->is_admin;
    }

	public function statements()
	{
		return $this->hasMany(\App\Models\Statement::class);
	}

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachmentable');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
