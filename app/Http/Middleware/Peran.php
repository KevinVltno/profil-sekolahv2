<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Peran
{
    public function handle(Request $request, Closure $next, string ...$peran): Response
    {
        $user = $request->user('admin');

        abort_unless($user && in_array($user->role, $peran, true), 403);

        return $next($request);
    }
}