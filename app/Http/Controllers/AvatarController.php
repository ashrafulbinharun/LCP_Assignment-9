<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        $request->validated();

        if (auth()->user()->avatar_url) {
            Storage::disk('public')->delete(auth()->user()->avatar_url);
        }

        auth()->user()->update([
            'avatar_url' => $request->file('avatar')->store('avatars', 'public'),
        ]);

        return back()->with(['success' => 'Profile avatar updated successful']);
    }

    public function destroy()
    {
        if (auth()->user()->avatar_url) {
            Storage::disk('public')->delete(auth()->user()->avatar_url);
        }

        auth()->user()->update([
            'avatar_url' => null,
        ]);

        return back()->with(['success' => 'Profile avatar deleted successful']);
    }
}
