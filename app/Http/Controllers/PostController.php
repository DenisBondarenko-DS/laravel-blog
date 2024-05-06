<?php

namespace App\Http\Controllers;

use App\Services\Post\Interfaces\PostServiceInterface;

class PostController extends Controller
{
    public function __construct(
        private readonly PostServiceInterface $postService
    ) {}

    public function index()
    {
        $posts = $this->postService->getPostsWithPagination();

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = $this->postService->getPostBySlug($slug);
        $comments = $post->comments()->latest()->get();

        $this->postService->incrementPostViews($post);

        return view('posts.show', compact('post', 'comments'));
    }
}
