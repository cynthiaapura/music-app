<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApiKeyController extends Controller
{
    public function index()
    {
        return Inertia::render('Api/Index', [
        'keys' => auth()->user()->apiKeys()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Api/Create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $apiKey = ApiKey::create([
            'user_id' => auth()->id(),
            'name' => $request->name
        ]);

        return redirect()->route('api-keys.index');
    }

    public function destroy(ApiKey $apiKey)
    {
        // Vérification manuelle de l'autorisation
        if ($apiKey->user_id !== auth()->id()) {
            abort(403, 'Non autorisé');
        }

        $apiKey->delete();

        return redirect()->route('api-keys.index');    }
}
