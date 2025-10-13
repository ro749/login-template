<?php

namespace Ro749\LoginTemplate\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->admin) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder');
    }
}