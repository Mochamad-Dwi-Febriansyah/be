<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Siswa;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Siswa::where('login_tokens' , $request->token)->first();

        if (!$user || !$request->token){
            return response()->json(['message' => 'Unauthorized User'], 401);
        }

        return $next($request);
    }
}
