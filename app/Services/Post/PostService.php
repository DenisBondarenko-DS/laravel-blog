<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Services\Post\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function getPostsWithPagination()
    {
        $columns = ['id', 'title', 'slug', 'description', 'category_id', 'views', 'thumbnail', 'created_at'];

        return Post::with('category')->latest()->paginate(3, $columns);
    }

    public function getTopPosts()
    {
        $columns = ['id', 'title', 'slug', 'views', 'thumbnail', 'created_at'];

        return Post::orderBy('views', 'desc')->limit(3)->get($columns);
    }

    public function getRecentPosts()
    {
        $columns = ['id', 'title', 'slug', 'thumbnail', 'created_at'];

        return Post::latest()->limit(3)->get($columns);
    }

    public function getPostBySlug($slug): Post
    {
        return Post::where('slug', $slug)->with('category')->firstOrFail();
    }

    public function getPostComments(Post $post)
    {
        return $post->comments()->latest()->get();
    }

    public function incrementPostViews(Post $post): void
    {
        $post->views += 1;
        $post->updateQuietly();
    }
}

