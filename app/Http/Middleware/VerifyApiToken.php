<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérer le jeton depuis l'en-tête Authorization
        $token = $request->header('Authorization');

        // Vérifier si le jeton est valide
        if (!$token || !User::where('api_token', $token)->exists()) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }

        return $next($request);
    }
}
