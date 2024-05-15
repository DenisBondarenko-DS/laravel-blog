<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\MinifiedPostResource;
use App\Http\Resources\Post\PostV2Resource;
use App\Services\Post\Interfaces\PostServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly PostServiceInterface $postService
    ) {}

    public function index()
    {
        $posts = $this->postService->getPostsWithPagination();

        return MinifiedPostResource::collection($posts);
    }

    public function show(string $slug)
    {
        $post = $this->postService->getPostBySlug($slug);
        $comments = $this->postService->getPostComments($post);

        $this->postService->incrementPostViews($post);

        return response()->json([
            'post' => PostV2Resource::make($post),
            'comments' => [
                'total' => $post->totalComments(),
                'list' => CommentResource::collection($comments)
            ]
        ]);
    }
}
