<?php

namespace App\Services\Cache;

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
}
