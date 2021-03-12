<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "created_at" => $this->created_at->toDateTimeString(),
            "content" => $this->content,
            "user"  => [
                "id" => $this->user->id,
                "name" => $this->user->name
            ]
        ];
    }
}
