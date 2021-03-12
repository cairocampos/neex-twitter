<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function store(PostRequest $request)
    {
        $post = PostRepository::create($request);
        
        return response()->json(new PostResource($post));
    }

    public function getComments(Request $request, $post_id)
    {
        return response()->json(CommentResource::collection(PostRepository::comments($post_id)));
    }
}
