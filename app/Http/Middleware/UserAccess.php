<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Conversion du type utilisateur en nombre entier pour correspondre avec la base de données
        $userTypeMapping = [
            'admin' => 0,
            'restoAdmin' => 1,
            'manager' => 2,
            'cuisinier' => 3,
        ];

        if (isset($userTypeMapping[$userType]) && auth()->user()->type == $userTypeMapping[$userType]) {
            return $next($request);
        }

        return response()->json(['You do not have permission to access for this page.']);
        // ou si tu veux une page d'erreur personnalisée
        // return response()->view('errors.check-permission');
    }
}
