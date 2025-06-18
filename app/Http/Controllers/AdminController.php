<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('backoffice.admin.dashboard');
    }

    public function profile()
    {
        $profile = auth()->user();
        return view('backoffice.admin.profile', compact('profile'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'))->with('message', 'Logged out successfully');
    }

    public function login()
    {
        return view('backoffice.admin.login');
    }

    public function profileUpdate(Request $request)
    {
        $profileId = auth()->user()->id;
        $profile = User::findOrFail($profileId);
        $profile->name = $request->input('username');
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->address = $request->input('address');

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('avatars', 'public');
            $profile->photo = $imagePath;
        }

        $profile->save();

        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        $profileId = auth()->user()->id;
        $profile = User::findOrFail($profileId);
        return view('backoffice.admin.change_password', compact('profile'));
    }

    public function profileUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $profileId = auth()->user()->id;
        $profile = User::findOrFail($profileId);

        if (!Hash::check($request->input('current_password'), $profile->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $profile->password = Hash::make($request->input('new_password'));
        $profile->save();

        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
