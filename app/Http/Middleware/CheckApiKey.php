<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Auth;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer la clé API dans le header "x-api-key"
        $key = $request->header('x-api-key');

        if (!$key) {
            return response()->json(['error' => 'API key is missing'], 401);
        }

        // Chercher dans la base de données une clé qui correspond
        $apiKey = ApiKey::where('key', $key)->first();

        if (!$apiKey) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        // Authentifier l'utilisateur associé à cette clé
        Auth::login($apiKey->user);

        return $next($request);
    }
}
