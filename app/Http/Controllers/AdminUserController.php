<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Requests\Admin\User\IndexRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('viewAny', User::class);

        $users = User::getUsersByFilter($request->validated());

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $user->update($request->all());

        return to_route('users.index')->with('success', 'Changes saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        Comment::query()->where('user_id', $user->id)->delete();
        $user->delete();

        return to_route('users.index')->with('success', 'User deleted');
    }
}
