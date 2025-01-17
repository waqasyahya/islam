<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictAccessToAuthPages
{
    /**
     * List of allowed email addresses
     *
     * @var array
     */
    protected $allowedEmails = [
        'waqasyahya143s@gmail.com',
        // Add more allowed emails if needed
    ];

    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated
        if (Auth::check()) {
            // Check if the user's email is in the allowed list
            if (in_array(Auth::user()->email, $this->allowedEmails)) {
                return $next($request);
            }

            // If the email is not allowed, redirect to home or a different page
            return redirect('/')->with('error', 'Unauthorized access!');
        }

        // If the user is not authenticated, proceed with the request
        return $next($request);
    }
}
