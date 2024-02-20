<?php

/**
 * Created by Codemax Reliese.
 * Date: Tue, 02 Oct 2018 12:44:47 -0300.
 */

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $name
 * @property string $uuid
 * @property string $type
 * @property string $cpf_cnpj
 * @property string $password
 * @property string $email
 * @property string $email_nfe
 * @property string $business
 * @property string $phone
 * @property string $mobile
 * @property string $ins_municipal
 * @property string $ins_estadual
 * @property string $skype
 * @property string $whatsapp
 * @property string $rg
 * @property \Carbon\Carbon $birthdate
 * @property string $genre
 * @property bool $status
 * @property string $obs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $account_id
 * @property int $vindi_id
 * @property string $remember_token
 * @property string $provider
 * @property string $provider_id
 * 
 * @property \App\Models\Account $account
 * @property \Illuminate\Database\Eloquent\Collection $abandoned_carts
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $cancellations
 * @property \Illuminate\Database\Eloquent\Collection $credit_cards
 * @property \Illuminate\Database\Eloquent\Collection $invoices
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 *
 * @package App\Models
 */
class Customer extends Authenticatable
{
    use Notifiable;

	protected $perPage = 20;

	protected $casts = [
		'status' => 'bool',
		'account_id' => 'int',
		'vindi_id' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'uuid',
		'type',
		'cpf_cnpj',
		'password',
		'email',
		'email_nfe',
		'business',
		'phone',
		'mobile',
		'ins_municipal',
		'ins_estadual',
		'skype',
		'whatsapp',
		'rg',
		'birthdate',
		'genre',
		'status',
		'obs',
		'account_id',
		'vindi_id',
		'remember_token',
		'provider',
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

	public function abandoned_carts()
	{
		return $this->hasMany(\App\Models\AbandonedCart::class);
	}

	public function address()
	{
		return $this->hasOne(\App\Models\Address::class);
	}

    public function invoicesPending()
    {
        return $this->invoices()->where(['status' => '0']);
    }

    public function invoicesOverdue()
    {
        return $this->invoices()->where(['status' => '2']);
    }

	public function cancellations()
	{
		return $this->hasMany(\App\Models\Cancellation::class);
	}

	public function credit_cards()
	{
		return $this->hasMany(\App\Models\CreditCard::class);
	}

	public function invoices()
	{
		return $this->hasMany(\App\Models\Invoice::class);
	}

	public function statements()
	{
		return $this->hasMany(\App\Models\Statement::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(\App\Models\Subscription::class);
	}

	public function attachment()
    {
        return $this->morphOne(\App\Models\Attachment::class, 'attachmentable');
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
