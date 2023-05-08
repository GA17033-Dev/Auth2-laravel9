<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Decode;
use Laravel\Passport\Token;

class CheckClientTokenAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $jwt =  Decode::jwt_client($token);
        $client_id = $jwt->aud;
        $token = Token::where('client_id', $client_id)->where('revoked', 0)
            ->where('expires_at', '>', now())
            ->orderBy('expires_at', 'desc')
            ->first();

        if (!$token) {
            return response()->json(['error' => 'token is invalid or has expired.'], 401);
        }
        return $next($request);
    }
}
