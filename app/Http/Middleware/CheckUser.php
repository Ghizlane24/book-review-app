<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user's role is 'user'
        if ($request->user()->role != 'user') {
            // Flash an error message and redirect to the profile page
            session()->flash('error', 'You are not authorized to access this section.');
            return redirect()->route('account.profile');
        }

        // Proceed to the next middleware or request
        return $next($request);
    }
}
