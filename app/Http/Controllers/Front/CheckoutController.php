<?php

namespace App\Http\Controllers\Front;

use App\Events\ConfirmPayment;
use App\Events\CustomerRegistered;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Module;
use App\Models\Plan;
use App\Services\InvoiceService;
use App\Services\ModuleService;
use App\Services\PlanService;

use CodemaxBR\Vindi\Facades\Vindi;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Webpatser\Uuid\Uuid;

class CheckoutController extends Controller
{
    /**
     * @var PlanService
     */
    private $planService;
    private $redirectTo;
    private $sessionId;
    private $finished = false;

    /**
     * @var ModuleService
     */
    private $moduleService;
    /**
     * @var Vindi
     */
    private $vindi;
    /**
     * @var InvoiceService
     */
    private $invoiceService;

    /**
     * CheckoutController constructor.
     * @param PlanService $planService
     * @param ModuleService $moduleService
     * @throws \Exception
     */
    public function __construct(PlanService $planService, ModuleService $moduleService)
    {
        $this->planService = $planService;
        $uuid = Uuid::generate(4);
        $this->sessionId = $uuid;
        $this->moduleService = $moduleService;
    }

    /**
     * @param Request $request
     * @param Plan $plan
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function addToCart(Request $request, Plan $plan)
    {
        // Instância o carrinho a sessão ativa
        $cart = Cart::instance('default');
        $cart->destroy();

        // Adiciona o item ao carrinho
        $cart->add($plan->id, $plan->name, 1, $plan->price, [
            'ciclo' => $plan->payment_cycle->name,
            'months' => $plan->payment_cycle->months,
            'term' => $plan->type_term->name,
            'type' => $plan->type_plan->id,
        ])->associate(Plan::class);

        $request->session()->put('cart', $cart->content());
        $request->session()->put('total_cart', $plan->price);

        if(Auth::guard('front')->check()){
            return redirect()->route('checkout.pagamento');
        }else{
            return redirect()->route('checkout');
        }
    }

    public function stepPayment(Request $request)
    {
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart'); // pega o carrinho
            $user = Auth::guard('front')->user();

            return view('front.checkout.payment')->with([
                'cart' => $cart,
                'user' => $user
            ]);

        }else{
            return redirect()->route('index');
        }
    }

    public function finishSubscription(Request $request)
    {
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart'); // pega o carrinho
            $user = Auth::guard('front')->user();

            $invoice = $this->processPayment($request, $request->method_payment, $user);

            if($this->finished){

                $request->session()->remove('cart');

                return view('front.checkout.finished')->with([
                    'cart' => $cart,
                    'user' => $user,
                    'request' => $request,
                    'invoice' => $invoice,
                ]);
            }else{
                return redirect()->route('checkout.pagamento')->with('response', $invoice->error);
            }
        }else{
            return redirect()->route('checkout');
        }
    }

    /**
     * @param $type
     * @return object
     */
    private function processPayment(Request $request, $method, Customer $customer)
    {
        $module = Module::find(getOption($method.'_gateway'));
        $account = Account::find(AccountId());
        $plugin = $this->moduleService->getConfig($module, $account);

        $eventPayment = '\App\Events\\'.$method.'Payment';
        $response = event(new $eventPayment($plugin, $request, $customer));

        if($response[1] != null && $response[1]->status == "success")
        {
            $this->finished = true;
            return (object) [
                'invoice' => $response[0],
                'response' => $response[1],
                'transaction' => $response[2]
            ];
        }else{
            $this->finished = false;
            return (object) ['error' => $response[1]->error];
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|unique:customers',
            'password' => 'required|string|min:6',
            'cpf' => 'required|string|min:14',
            'genre' => 'required',
            'phone' => 'required|string|min:14',
            'mobile' => 'required|string|min:15',
            'birthdate' => 'required|date',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createCustomer($data)
    {
        return Customer::create([
            'uuid' => Uuid::generate(4),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cpf_cnpj' => $data['cpf'],
            'genre' => $data['genre'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'birthdate' => $data['birthdate'],
            'account_id' => AccountId_byDomain()
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('front');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $customer = $this->createCustomer($request->all());
        $cart = $request->session()->get('cart'); // pega o carrinho

        if (Auth::guard('front')->attempt(['email' => $request->email, 'password' => $request->password])) {

            //event(new CustomerRegistered($customer));
            return redirect()->intended(route('checkout.pagamento'));
        }
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
            return redirect()->intended(route('checkout.pagamento'));
        }

        // Se for falso, volta para o login
        return redirect()->back()->withErrors(['password' => trans('auth.failed')]);
    }

    public function index(Request $request, Plan $plan)
    {
        // Se tiver item no carrinho
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart'); // pega o carrinho
            if(Auth::guard('front')->check()){

                // Usuário está logado.
                return redirect()->route('checkout.pagamento');
            }else{
                return view('front.checkout.auth-register')->with([
                    'cart' => $cart
                ]);
            }
        }else{
            // Se não tiver nenhum item no carrinho, manda para Index
            return redirect()->route('index');
        }
    }

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
            'provider_id' => $user->id
        ]);
    }

    private function registered(Request $request, $customer)
    {
    }
}
