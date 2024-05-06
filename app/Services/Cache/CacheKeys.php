<?php

namespace App\Services\Cache;

use App\Models\Post;

final class CacheKeys
{
    public static function topPosts(): string
    {
        return 'top_posts';
    }

    public static function recentPosts(): string
    {
        return 'recent_posts';
    }

    public static function postsPage(int $num): string
    {
        return 'posts_page_' . $num;
    }

    public static function postBySlug(string $slug): string
    {
        return 'posts:' . $slug;
    }

    public static function postComments(Post $post): string
    {
        return 'post_comments_' . $post->id;
    }
}
