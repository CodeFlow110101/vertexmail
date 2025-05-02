<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/mail-tracker/{id}.png', function ($id) {
    // Log or store the view
    Log::info("Email opened for ID: {$id}");

    // Optionally: update DB to mark it as opened

    // Return a 1x1 transparent PNG
    return response()
        ->file(public_path('tracker.png'), [
            'Content-Type' => 'image/png',
        ]);
})->name('mail.tracker');