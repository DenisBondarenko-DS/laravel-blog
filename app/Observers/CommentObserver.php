<?php

namespace App\Observers;

use App\Models\Comment;
use App\Services\Post\ClearPostCacheService;

class CommentObserver
{
    public function __construct(
        private readonly ClearPostCacheService $cacheService
    ) {}

    public function saved(Comment $comment): void
    {
        $this->cacheService->clearPostCommentsCache($comment->post);
    }

    public function deleted(Comment $comment): void
    {
        $this->cacheService->clearPostCommentsCache($comment->post);
    }
}
