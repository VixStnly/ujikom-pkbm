<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function edit()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function editGuru()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('profile.editGuru', compact('user'));
    }
    public function editAdmin()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('profile.editAdmin', compact('user'));
    }

    public function update(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|min:6',
            'password' => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048', // Image validation
        ]);

        // Update user's name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update password if current password and new password are provided
        if ($request->filled('current_password') && $request->filled('password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete the old image if exists
            if ($user->profile_image) {
                Storage::delete('public/profil/' . $user->profile_image);
            }

            // Save the new image
            $filename = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->storeAs('public/profil', $filename);
            $user->profile_image = $filename; // Save the filename in the profile_image column
        }

        // Save all changes to the database
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
