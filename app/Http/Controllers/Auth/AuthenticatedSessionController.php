<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontoffice.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->role === 'admin') {
            $url = RouteServiceProvider::ADMIN_HOME;
        } elseif ($request->user()->role === 'instructor') {
            $url = RouteServiceProvider::INSTRUCTOR_HOME;
        } elseif ($request->user()->role === 'user') {
            $url = RouteServiceProvider::HOME;
        }

        return redirect()->intended($url)->with('message', 'Logged in successfully');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
