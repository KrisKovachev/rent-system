<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $stats = [
            'active_rentals' => 0,
            'pending_applications' => 0,
        ];

        return view('profile.index', compact('user', 'stats'));
    }

    //USER INFORMATION UPDATE
    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'city'    => ['nullable', 'string', 'max:120'],
            'country' => ['nullable', 'string', 'max:120'],
        ]);
        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    //PROFILE AVATAR UPLOAD
    public function uploadAvatar(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);
        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update([
            'avatar_path' => $path,
        ]);

        return back()->with('success', 'Avatar updated.');
    }

    //PROFILE PASSWORD UPDATE
    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
