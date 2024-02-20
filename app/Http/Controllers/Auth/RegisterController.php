<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use App\Models\User;
use App\Notifications\EmailActivation;
use App\Services\AccountService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Webpatser\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AccountService $accountService)
    {
        $this->middleware('guest');
        $this->accountService = $accountService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'domain.unique' => 'O domínio já está em uso, tente outro.',
        ];

        return Validator::make($data, [
            'domain' => 'required|string|max:191|unique:accounts,domain',
            'name_business' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $this->uuid = Uuid::generate()->string;

        $acc = [
            'name_business' => $data['name_business'],
            'domain' => $data['domain'],
            'email_contact' => $data['email'],
            'uuid' => $this->uuid,
            'reseller_id' => 1
        ];

        $account = $this->accountService->newAccount($acc);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'account_id' => $account
        ]);
    }

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input)->validate();

        $data = $this->create($input)->toArray();
        $data['token'] = str_random(25);

        $user = User::find($data['id']);
        $user->token = $data['token'];
        $user->save();

        $account = Account::find($user->account_id);
        $data['domain'] = $account->domain;

        $user->notify(new EmailActivation($data));
        //return redirect()->route('login')->with('status', 'Ótimo! Agora confirme seu e-mail para começar a usar o GerentePRO.');
        return view('auth.register-done');
    }

    public function confirmation($token)
    {
        $user = User::where('token', $token)->first();

        if(!is_null($user)){
            $user->confirmed = 1;
            $user->token = '';
            $user->save();

            $account = Account::find($user->account_id);
            $account->status = 1;
            $account->save();

            return redirect()->route('login')->with('success', 'Cadastro confirmado! Vamos começar?');
        }

        return redirect()->route('login')->with('status', 'Desculpe, token inválido.');
    }
}
