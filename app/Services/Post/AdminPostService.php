<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPostService
{
    public function __construct(
        private readonly PostImageService $imageService
    ) {}

    public function getPostsByUserRole(): LengthAwarePaginator
    {
        return Post::with('category', 'tags')
            ->when(auth()->user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate(5);
    }

    public function store(array $data): void
    {
        try {
            DB::transaction(function () use ($data) {

                $this->storePost($data);

            });
        } catch (\Throwable $e) {
            Log::channel('mylog')->error($e->getMessage());
            abort(404);
        }
    }

    public function update(array $data, Post $post): void
    {
        try {
            DB::transaction(function () use ($data, $post) {

                $this->updatePost($data, $post);

            });
        } catch (\Throwable $e) {
            Log::channel('mylog')->error($e->getMessage());
            abort(500);
        }
    }

    public function delete(Post $post): void
    {
        try {
            DB::transaction(function () use ($post) {

                $this->deletePost($post);

            });
        } catch (\Throwable $e) {
            Log::channel('mylog')->error($e->getMessage());
            abort(500);
        }
    }

    public function storePost(array $data): void
    {
        $data['thumbnail'] = $this->imageService->storeImage($data);

        $post = Post::create($data);

        $this->syncTags($data, $post);
    }

    public function updatePost(array $data, Post $post): void
    {
        $data['thumbnail'] = $this->imageService->setPost($post)->updateImage($data);

        $post->update($data);

        $this->syncTags($data, $post);
    }

    public function deletePost(Post $post): void
    {
        $this->deleteTags($post);
        $this->imageService->setPost($post)->deleteImage();
        $post->comments()->delete();

        $post->delete();
    }

    private function syncTags(array $data, Post $post): void
    {
        $tags = $data['tags'] ?? null;
        $post->tags()->sync($tags);
    }

    private function deleteTags(Post $post): void
    {
        $post->tags()->sync([]);
    }
}
