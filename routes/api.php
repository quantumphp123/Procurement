<?php

use Illuminate\Support\Facades\Route;

// Example route (optional)
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
