<?php

namespace App\Http\Repositories;

use App\Models\{
    User,
    Follower
};

class UserRepository
{
    public static function getProfiles()
    {   
        $id = auth()->user()->id;

        return User::whereNotIn("id", function ($query) use ($id) {
                $query->select("user_id")
                ->from("followers")
                ->where("follower_id", $id);
            })
            ->where("id", "!=", $id)
            ->inRandomOrder()
            ->get();
           
    }
    
    public static function follow($user_id)
    {    
        $data = [
            "user_id"       => $user_id,
            "follower_id"   => auth()->user()->id,
        ];

        $follow = app()->make(Follower::class)
            ->where($data)
            ->first();

        if(!$follow) {
            $data["created_at"] = now();
            return Follower::create($data);
        }

        return response()->json(["message" => "Você já segue esse usuário!"], 403);
    }

    public static function unfollow($user_id)
    {
        $data = [
            "user_id"       => $user_id,
            "follower_id"   => auth()->user()->id,
        ];

        $follow = app()->make(Follower::class)
            ->where($data)
            ->first();

        if($follow) {
            $follow->delete();
            return response()->json([], 200);
        }

        return response()->json(["message" => "Você não segue esse usuário!"], 403);
    }
}