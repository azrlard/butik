<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $adminGuard = Auth::guard('admin');

        if (!$adminGuard->check() || !in_array($adminGuard->user()->role, ['admin', 'manajer'])) {
            abort(403, 'Unauthorized. Admin / Manajer access only.');
        }

        return $next($request);
    }
}