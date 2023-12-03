<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug) {
        $tag = Tag::query()->where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->latest()->paginate(3);

        return view('tags.show', compact('tag', 'posts'));
    }
}
