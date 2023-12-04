<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->with('category')->latest()->paginate(3);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::query()->where('slug', $slug)->firstOrFail();
        $comments = Comment::query()->where('post_id', $post->id)->latest()->get();

        $post->views += 1;
        $post->update();

        return view('posts.show', compact('post', 'comments'));
    }
}
