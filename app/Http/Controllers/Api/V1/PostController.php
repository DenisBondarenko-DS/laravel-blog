<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\MinifiedPostResource;
use App\Http\Resources\Post\PostResource;
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

        $this->postService->incrementPostViews($post);

        return PostResource::make($post);
    }
}
