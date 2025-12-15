<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role ?? null;

        if (empty($roles) || !in_array($userRole, $roles)) {
            return redirect('/dashboard')->with('error', 'U heeft geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
