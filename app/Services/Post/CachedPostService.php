<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Services\Cache\CacheKeys;
use App\Services\Cache\CacheTags;
use App\Services\Post\Interfaces\PostServiceInterface;
use Illuminate\Support\Facades\Cache;

class CachedPostService implements PostServiceInterface
{
    const CACHE_TTL = 60;

    public function __construct(
        private readonly PostServiceInterface $base,
        private readonly ClearPostCacheService $cacheService
    ) {}

    public function getPostsWithPagination()
    {
        $cacheKey = CacheKeys::postsPage(request('page', 1));

        return Cache::tags(CacheTags::postPagination())->remember($cacheKey, self::CACHE_TTL, function () {
            return $this->base->getPostsWithPagination();
        });
    }

    public function getTopPosts()
    {
        return Cache::remember(CacheKeys::topPosts(), self::CACHE_TTL, function () {
            return $this->base->getTopPosts();
        });
    }

    public function getRecentPosts()
    {
        return Cache::remember(CacheKeys::recentPosts(), self::CACHE_TTL, function () {
            return $this->base->getRecentPosts();
        });
    }

    public function getPostBySlug($slug): Post
    {
        return Cache::remember(CacheKeys::postBySlug($slug), self::CACHE_TTL, function () use ($slug) {
            return $this->base->getPostBySlug($slug);
        });
    }

    public function incrementPostViews(Post $post): void
    {
        $post->views += 1;
        $post->updateQuietly();

        $this->cacheService->checkAndClearTopPostsCache($post);
        Cache::put(CacheKeys::postBySlug($post->slug), $post, self::CACHE_TTL);
    }
}

