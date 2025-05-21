<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApiKeyController extends Controller
{
    public function index()
    {
        return Inertia::render('ApiKeys/Index', [
            'keys' => auth()->user()->apiKeys
        ]);
    }

    public function create()
    {
        return Inertia::render('ApiKeys/Create');
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
        $this->authorize('delete', $apiKey);
        $apiKey->delete();

        return back();
    }
}
