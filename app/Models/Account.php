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
 * Class Account
 * 
 * @property int $id
 * @property string $name_business
 * @property string $uuid
 * @property boolean $logo
 * @property string $domain
 * @property string $email_contact
 * @property bool $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $abandoned_carts
 * @property \Illuminate\Database\Eloquent\Collection $attachments
 * @property \Illuminate\Database\Eloquent\Collection $banks
 * @property \Illuminate\Database\Eloquent\Collection $cancellations
 * @property \Illuminate\Database\Eloquent\Collection $credit_cards
 * @property \Illuminate\Database\Eloquent\Collection $customers
 * @property \Illuminate\Database\Eloquent\Collection $imports
 * @property \Illuminate\Database\Eloquent\Collection $invoices
 * @property \Illuminate\Database\Eloquent\Collection $modules
 * @property \Illuminate\Database\Eloquent\Collection $options
 * @property \Illuminate\Database\Eloquent\Collection $plans
 * @property \Illuminate\Database\Eloquent\Collection $servers
 * @property \Illuminate\Database\Eloquent\Collection $statements
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Account extends Eloquent implements Transformable
{
    use TransformableTrait;

	protected $perPage = 20;

	protected $casts = [
		'logo' => 'boolean',
		'status' => 'bool'
	];

	protected $fillable = [
		'name_business',
		'uuid',
		'logo',
		'domain',
		'email_contact',
		'status',
        'reseller_id',
	];

	public function reseller()
    {
        return $this->belongsTo(\App\Models\Reseller::class);
    }

    public function providers()
    {
        return $this->hasMany(\App\Models\Provider::class);
    }

	public function abandoned_carts()
	{
		return $this->hasMany(\App\Models\AbandonedCart::class);
	}

	public function attachments()
	{
		return $this->hasMany(\App\Models\Attachment::class);
	}

	public function banks()
	{
		return $this->hasMany(\App\Models\Bank::class);
	}

    public function logs()
    {
        return $this->morphMany(\App\Models\Log::class, 'logable');
    }

	public function cancellations()
	{
		return $this->hasMany(\App\Models\Cancellation::class);
	}

	public function credit_cards()
	{
		return $this->hasMany(\App\Models\CreditCard::class);
	}

	public function customers()
	{
		return $this->hasMany(\App\Models\Customer::class);
	}

	public function imports()
	{
		return $this->hasMany(\App\Models\Import::class);
	}

	public function invoices()
	{
		return $this->hasMany(\App\Models\Invoice::class);
	}

	public function modules()
	{
		return $this->belongsToMany(\App\Models\Module::class, 'modules_account')
					->withPivot('id', 'uuid', 'server_id', 'config')
					->withTimestamps();
	}

	public function options()
	{
		return $this->hasMany(\App\Models\Option::class);
	}

	public function plans()
	{
		return $this->hasMany(\App\Models\Plan::class);
	}

	public function servers()
	{
		return $this->hasMany(\App\Models\Server::class);
	}

	public function statements()
	{
		return $this->hasMany(\App\Models\Statement::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(\App\Models\Subscription::class);
	}

	public function transactions()
	{
		return $this->hasMany(\App\Models\Transaction::class);
	}

	public function users()
	{
		return $this->hasMany(\App\Models\User::class);
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
