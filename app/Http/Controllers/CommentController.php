<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreRequest $request, Post $post)
    {
        Comment::query()->create(
            attributes: [
                ...$request->validated(),
                'user_id' => auth()->user()->id,
                'post_id' => $post->id
            ]
        );

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'commentsCount' => Comment::query()->where('post_id', $comment->post_id)->count()
        ]);
    }
}
