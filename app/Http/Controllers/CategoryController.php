<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug) {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->latest()->paginate(3);

        return view('categories.show', compact('category', 'posts'));
    }
}
