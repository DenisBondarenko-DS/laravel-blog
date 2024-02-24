<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PostService
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

    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;

        if (isset($data['thumbnail'])) {
            $data['thumbnail'] = Storage::put('images', $data['thumbnail']);
        }

        $post = Post::query()->create($data);

        $tags = $data['tags'] ?? null;
        $post->tags()->sync($tags);
    }

    public function update($data, Post $post)
    {
        if (isset($data['thumbnail'])) {
            if ($post->thumbnail != null) {
                Storage::delete($post->thumbnail);
            }

            $data['thumbnail'] = Storage::put('images', $data['thumbnail']);
        }

        $post->update($data);

        $tags = $data['tags'] ?? null;
        $post->tags()->sync($tags);
    }

    public function delete(Post $post)
    {
        $post->tags()->sync([]);
        Comment::query()->where('post_id', $post->id)->delete();

        if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }

        $post->delete();
    }
}
