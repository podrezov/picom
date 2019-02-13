<?php

namespace App\Http\Middleware;

use App\Models\Roles\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthorOrModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user() || !Auth::user()->hasRole([Role::MODERATOR, Role::AUTHOR])) {
            return abort(404);
        }

        return $next($request);
    }
}
