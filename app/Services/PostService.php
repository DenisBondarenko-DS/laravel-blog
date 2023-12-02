<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
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
            Storage::delete($post->thumbnail);
            $data['thumbnail'] = Storage::put('images', $data['thumbnail']);
        }

        $post->update($data);

        $tags = $data['tags'] ?? null;
        $post->tags()->sync($tags);
    }

    public function delete(Post $post)
    {
        $post->tags()->sync([]);

        if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }

        $post->delete();
    }
}
