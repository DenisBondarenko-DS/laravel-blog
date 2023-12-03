<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'usersCount' => User::query()->count(),
            'categoriesCount' => Category::query()->count(),
            'tagsCount' => Tag::query()->count(),
            'postsCount' => Post::query()->count()
        ]);
    }
}
