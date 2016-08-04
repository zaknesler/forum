<?php

namespace Forum\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->suspended) {
            Auth::logout();

            notify()->flash('Uh oh..', 'error', [
                'text'  => 'Your account has been suspended.',
                'timer' => 2000,
            ]);

            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
