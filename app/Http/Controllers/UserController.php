<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $profile = auth()->user();
        return view('frontoffice.dashboard.update_profile', compact('profile'));
    }

    public function password()
    {
        return view('frontoffice.dashboard.update_password');
    }

    public function updateProfile(Request $request)
    {
        $userid = auth()->user()->id;
        $user = User::findOrFail($userid);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('avatars', 'public');
        }

        $user->update($data);

        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.profile')->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        if (!password_verify($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.password')->with($notification);
    }
}
