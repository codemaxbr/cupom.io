<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('home');
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Valida os dados do form
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        // Tenta fazer o login do cliente
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'account_id' => AccountId(),
            'confirmed' => 1
        ], $request->remember)){

            // Se for sucesso, redireciona para Home do usuario
            return redirect()->intended($this->redirectTo);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
