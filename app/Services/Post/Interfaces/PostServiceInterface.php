<?php

namespace App\Services\Post\Interfaces;

use App\Models\Post;

interface PostServiceInterface
{
    public function getPostsWithPagination();

    public function getTopPosts();

    public function getRecentPosts();

    public function getPostBySlug($slug): Post;

    public function incrementPostViews(Post $post): void;
}
