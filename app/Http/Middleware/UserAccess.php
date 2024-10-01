<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        $user = auth()->user();
        Log::info('UserAccess middleware', ['user_id' => $user->id, 'user_type' => $user->type, 'required_type' => $userType]);

        if ($user->type === $userType) {
            return $next($request);
        }

        Log::warning('Access denied', ['user_id' => $user->id, 'user_type' => $user->type, 'required_type' => $userType]);
        return response()->json(['You do not have permission to access for this page.']);
    }
}
