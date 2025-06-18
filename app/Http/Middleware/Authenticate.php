<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $path = $request->path(); // Contoh: 'admin/dashboard' atau 'instructor/home'

        if (str_starts_with($path, 'admin')) {
            return route('admin.login');
        } elseif (str_starts_with($path, 'instructor')) {
            return route('instructor.login');
        }

        // Default fallback, misalnya ke halaman umum
        return route('login');
    }
}
