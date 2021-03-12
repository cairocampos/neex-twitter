<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function feed()
    {
        /**
         * Pegar os posts de meu usuário e dos usuários que eu sigo (folower_id = eu)
         */        
        $posts = Post::whereHas('user', function ($query) {
            return $query->where('user_id', auth()->user()->id)
                    ->orWhereIn('user_id', auth()->user()->follows->map(
                        function ($follower) {
                            return $follower->id;
                        }
                    ));
        })
        ->with("user")
        ->paginate(10);

        return response()->json($posts);
    }


    /**
     * Retorna os feeds dos usuários randomicamente que não sigo
     */
    public function discover()
    {
        $posts = Post::whereHas('user', function ($query) {
            return $query->where('user_id', auth()->user()->id)
                    ->orWhereNotIn('user_id', auth()->user()->follows->map(
                        function ($follower) {
                            return $follower->id;
                        }
                    ));
        })
        ->with("user")
        ->paginate(10);

        return response()->json($posts);
    }
}
