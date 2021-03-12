<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository
{
    public static function create($request)
    {
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->content = $request->content;
        $post->save();

        return $post;
    }

    public static function comments($post_id)
    {   
        $post = Post::find($post_id);

        if(!$post) {
            return response()->json([
                "message" => not_found()
            ], 404);
        }

        return $post->comments()
            ->orderBy("created_at", "desc")
            ->get();
    }
    
}