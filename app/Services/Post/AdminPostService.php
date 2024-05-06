<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdminPostService
{
    public function getPostsByUserRole()
    {
        return Post::query()->with('category', 'tags')
            ->when(auth()->user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate(5);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $post = Post::query()->create($data);
            $post->syncTags($data);
            $post->storeThumbnail($data);

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(404);
        }
    }

    public function update(array $data, Post $post)
    {
        try {
            DB::beginTransaction();

            $post->update($data);
            $post->syncTags($data);
            $post->updateThumbnail($data);

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function delete(Post $post)
    {
        try {
            DB::beginTransaction();

            $post->deleteTags();
            $post->deleteThumbnail();
            $post->comments()->delete();

            $post->delete();

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
