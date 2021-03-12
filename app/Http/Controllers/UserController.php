<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    /**
     * Retorna os perfis dos usuários que não estou seguindo
     */
    public function index()
    {
        return UserRepository::getProfiles();
    }

    /**
     * Segue um usuário
     */
    public function follow($user_id)
    {
        return UserRepository::follow($user_id);
    }

    /**
     * Deixar de seguir um usuário
     */
    public static function unfollow($user_id)
    {
        return UserRepository::unfollow($user_id);
    }

    public function show()
    {
        return auth()->user();
    }
}
