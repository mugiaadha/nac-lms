<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    public function index()
    {
        return view('frontoffice.home.home');
    }

    public function dashboard()
    {
        return view('frontoffice.dashboard.dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->with('message', 'Logged out successfully');
    }
}
