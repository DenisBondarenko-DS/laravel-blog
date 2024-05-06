<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\Post\ClearPostCacheService;

class PostObserver
{
    public function __construct(
        private readonly ClearPostCacheService $cacheService
    ) {}

    public function created(): void
    {
        $this->cacheService->clearPostPaginationCache();
        $this->cacheService->clearRecentPostsCache();
    }

    public function updated(Post $post): void
    {
        $this->cacheService->clearPostCache($post);
        $this->cacheService->checkAndClearRecentPostsCache($post);
        $this->cacheService->checkAndClearTopPostsCache($post);
        $this->cacheService->clearPostPaginationCache();
    }

    public function deleted(Post $post): void
    {
        $this->cacheService->clearPostCache($post);
        $this->cacheService->checkAndClearRecentPostsCache($post);
        $this->cacheService->checkAndClearTopPostsCache($post);
        $this->cacheService->clearPostPaginationCache();
        $this->cacheService->clearPostCommentsCache($post);
    }
}
