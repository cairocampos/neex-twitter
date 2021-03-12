<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(CommentRequest $request)
    {   
        $data = $request->toArray();
        $data["user_id"] = auth()->user()->id;

        $comment = Comment::create($data);
    
        return response()->json(new CommentResource($comment));

    }
}
