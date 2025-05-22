<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;
use App\Http\Middleware\CheckApiKey;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

Route::middleware([CheckApiKey::class])->get('/playlists', [PlaylistController::class, 'indexApi']);
