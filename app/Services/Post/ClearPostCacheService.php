<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Services\Cache\CacheKeys;
use App\Services\Cache\CacheTags;
use Illuminate\Support\Facades\Cache;

class ClearPostCacheService
{
    public function clearRecentPostsCache(): void
    {
        Cache::forget(CacheKeys::recentPosts());
    }

    public function clearTopPostsCache(): void
    {
        Cache::forget(CacheKeys::topPosts());
    }

    public function checkAndClearRecentPostsCache(Post $post): void
    {
        $cachedPosts = Cache::get(CacheKeys::recentPosts(), []);

        foreach ($cachedPosts as $cachedPost) {
            if ($post->id == $cachedPost->id) {
                $this->clearRecentPostsCache();
                return;
            }
        }
    }

    public function checkAndClearTopPostsCache(Post $post): void
    {
        $cachedPosts = Cache::get(CacheKeys::topPosts(), []);

        foreach ($cachedPosts as $cachedPost) {
            if ($post->id == $cachedPost->id || $post->views > $cachedPost->views) {
                $this->clearTopPostsCache();
                return;
            }
        }
    }

    public function clearPostPaginationCache(): void
    {
        Cache::tags(CacheTags::postPagination())->flush();
    }

    public function clearPostCache(Post $post): void
    {
        Cache::forget(CacheKeys::postBySlug($post->slug));
    }

    public function clearPostCommentsCache(Post $post): void
    {
        Cache::forget(CacheKeys::postComments($post));
    }
}
