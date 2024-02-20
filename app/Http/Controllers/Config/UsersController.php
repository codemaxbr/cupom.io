<?php

namespace App\Http\Controllers\Config;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UsersController constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function users()
    {
        $users = $this->userService->getUsers();

        return view('config.users.accounts')->with([
            'users' => $users
        ]);
    }

    public function userView(User $user)
    {
        return view('config.users.edit')->with(['user' => $user]);
    }

    public function saveUser(Request $request, User $user)
    {
        $update = [
            'name' => $request->nome,
            'email' => $request->email,
            'photo' => $request->foto,
            'confirmed' => $request->status,
            'group_id' => $request->grupo
        ];

        if($request->has(['nova_senha', 'confirma_senha'])){
            $update['password'] = Hash::make($request->senha);
        }

        if($this->userService->updateUser($user, $update)){
            return redirect()->route('config.users')->with('success', 'Usuário "'.$user->name.'" foi alterado.');
        }
    }

    public function groups()
    {
        return 'Config group users';
    }
}
