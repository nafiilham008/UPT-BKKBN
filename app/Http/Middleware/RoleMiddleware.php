<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        // Memastikan pengguna sudah login
        if (!$user) {
            return redirect()->route('login');
        }

        // Memeriksa apakah peran pengguna adalah "User Remaja"
        if (in_array('User Remaja', $roles) && $user->role === 'User Remaja') {
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }

        // // Memeriksa apakah peran pengguna tidak sama dengan salah satu dari peran yang diberikan
        // if (!in_array($user->role, $roles)) {
        //     abort(403, 'Unauthorized');
        // }

        return $next($request);
    }
}
