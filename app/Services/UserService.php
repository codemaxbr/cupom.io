<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 23/09/2018
 * Time: 13:38
 */

namespace App\Services;


use App\Models\User;
use Artesaos\Defender\Contracts\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return User::query()->where(['account_id' => AccountId()])->get()->all();
    }

    public function updateUser(User $user, $dados)
    {
        return $user->update($dados);
    }
}