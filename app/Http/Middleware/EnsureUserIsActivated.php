<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class EnsureUserIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->isActive()) {
            $message = __('Your account is not yet activated. Please check your email for an activation code.');

            flash($message);

            auth()->logout();

            throw new AuthenticationException($message);
        }

        return $next($request);
    }
}
