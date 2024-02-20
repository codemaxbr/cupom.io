<?php

namespace App\Http\Controllers\Front;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    private $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('cliente.home');
        $this->middleware('guest:front')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.customers.login');
    }

    public function login(Request $request)
    {
        // Valida os dados do form
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        // Tenta fazer o login do cliente
        if (Auth::guard('front')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){

            // Se for sucesso, redireciona para Home do usuario
            return redirect()->intended($this->redirectTo);
        }

        // Se for falso, volta para o login
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('front')->logout();
        return redirect('/');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        //Auth::login($authUser, true);
        Auth::guard('front')->login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = Customer::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return Customer::create([
            'type'     => 'fisica',
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'account_id' => AccountId_byDomain()
        ]);
    }
}
