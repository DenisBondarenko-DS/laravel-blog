<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(UpdateRequest $request, ProfileService $profileService)
    {
        $profileService->update($request->validated());

        return to_route('profile.show')->with('success', 'Changes saved');
    }
}
