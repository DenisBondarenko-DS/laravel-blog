<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'category' => CategoryResource::make($this->category),
            'tags' => TagResource::collection($this->tags),
            'views' => $this->views,
            'comments' => [
                'total' => $this->totalComments(),
                'list' => CommentResource::collection($this->comments)
            ],
            'created_at' => $this->getPostDate()
        ];
    }
}
