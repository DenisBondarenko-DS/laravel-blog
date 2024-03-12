<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function update($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['avatar'])) {
            if (auth()->user()->avatar != null) {
                Storage::delete(auth()->user()->avatar);
            }

            $data['avatar'] = Storage::put('images', $data['avatar']);
        }

        auth()->user()->update($data);
    }
}
