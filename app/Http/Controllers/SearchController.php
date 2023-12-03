<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            's' => 'required'
        ]);

        $queryString = $request->s;
        $posts = Post::query()->like($queryString)->with('category')->latest()->paginate(3);

        return view('posts.search', compact('queryString', 'posts'));
    }
}
