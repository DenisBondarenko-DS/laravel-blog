<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostImageService
{
    private Post $post;

    public function setPost(Post $post): PostImageService
    {
        $this->post = $post;
        return $this;
    }

    public function storeImage(array $data): bool|string|null
    {
        if (isset($data['thumbnail'])) {
            $folder = date('Y-m-d');
            return Storage::put("images/$folder", $data['thumbnail']);
        }

        return null;
    }

    public function updateImage(array $data): bool|string|null
    {
        if (isset($data['thumbnail'])) {
            $this->deleteImage();
        }

        return $this->storeImage($data);
    }

    public function deleteImage(): void
    {
        if ($this->post->thumbnail) {
            Storage::delete($this->post->thumbnail);
        }
    }
}
