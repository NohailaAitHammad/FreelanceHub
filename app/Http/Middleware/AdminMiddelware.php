<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role->role === 'admin') {
            return $next($request);
        }

        return response()->json([
            "success" => false,
            "message" => "Unauthorized access"
        ], 403);
    }
}
