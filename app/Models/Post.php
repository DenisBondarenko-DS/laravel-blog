<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'user_id', 'thumbnail'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function totalComments()
    {
        return $this->comments()->count();
    }

    public function getImage()
    {
        if (!$this->thumbnail) {
            return asset('no-image.jpg');
        }

        return asset("storage/$this->thumbnail");
    }

    public function getPostDate()
    {
        return Carbon::parse($this->created_at)->format('d F, Y');
    }

    public function scopeLike($query, $s)
    {
        return $query->where('title', 'LIKE', "%{$s}%");
    }

    public function syncTags(array $data)
    {
        $tags = $data['tags'] ?? null;
        $this->tags()->sync($tags);
    }

    public function deleteTags()
    {
        $this->tags()->sync([]);
    }

    public function storeThumbnail(array $data)
    {
        if (isset($data['thumbnail'])) {
            $this->thumbnail = Storage::put('images', $data['thumbnail']);
            $this->save();
        }
    }

    public function updateThumbnail(array $data)
    {
        if (isset($data['thumbnail'])) {
            $this->deleteThumbnail();
        }

        $this->storeThumbnail($data);
    }

    public function deleteThumbnail()
    {
        if ($this->thumbnail) {
            Storage::delete($this->thumbnail);
        }
    }
}
