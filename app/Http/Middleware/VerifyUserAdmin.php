<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = '507f191e810c19729de860ea';
        if (!$request->header('Admin')) {
            return response()->json(['error' => 'Token Admin not found'], 401);
        }
        if ($request->header('Admin') != $admin) {
            return response()->json(['error' => 'Token Admin Invalido'], 401);
        }

        return $next($request);
    }
}
