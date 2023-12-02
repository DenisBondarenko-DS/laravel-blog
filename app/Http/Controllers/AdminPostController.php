<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function __construct (
        private PostService $postService
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postQuery = Post::query();

        if (auth()->user()->isAdmin()) {
            $postQuery->where('user_id', auth()->user()->id);
        }

        $posts = $postQuery->with('category', 'tags')->latest()->paginate(5);
        $categories = Category::query()->get(['id', 'title']);

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get(['id', 'title']);
        $tags = Tag::query()->get(['id', 'title']);

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->postService->store($request->validated());

        return to_route('posts.index')->with('success', 'Post added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::query()->get(['id', 'title']);
        $tags = Tag::query()->get(['id', 'title']);

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $this->postService->update($request->validated(), $post);

        return to_route('posts.index')->with('success', 'Changes saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->delete($post);

        return to_route('posts.index')->with('success', 'Post deleted');
    }
}
