<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    /**
     * AuthController constructor.
     */
    public function __construct()
    {

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Usuário e/ou senha inválidos.'
            ]);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function user(Request $request)
    {

        $token = JWTAuth::getToken();

        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
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

    public function register(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        
        $input = $request->all();
        return response()->json($input);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response([
                'status' => 'success',
                'msg' => 'Sessão encerrada com sucesso!'
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response([
                'status' => 'error',
                'msg' => 'Failed to logout, please try again.'
            ]);
        }
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

}
