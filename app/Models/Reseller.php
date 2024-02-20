<?php

namespace App\Models;

use Artesaos\Defender\Traits\HasDefender;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Reseller.
 *
 * @package namespace App\Models;
 */
class Reseller extends Authenticatable implements JWTSubject
{

    use Notifiable;
    use HasDefender;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'cpf_cnpj',
        'password',
        'email_nfe',
        'phone',
        'mobile',
        'ins_municipal',
        'ins_estadual',
        'skype',
        'whatsapp',
        'birthdate',
        'status',
        'obs',
        'confirmed',
        'token',
    ];

    public function accounts()
    {
        return $this->hasMany(\App\Models\Account::class);
    }

    public function invoices()
    {
        return $this->hasMany(\App\Models\InvoiceAccount::class);
    }

    public function plans()
    {
        return $this->belongsTo(\App\Models\AccountPlan::class);
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
