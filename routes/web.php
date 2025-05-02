<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/email/open/{id}', function ($id) {
    // Log or update DB that the email with ID $id was opened
    // \App\Models\EmailLog::where('id', $id)->update(['opened_at' => now()]);
    Log::info('hello');
    // Return a 1x1 transparent PNG
    $pixel = base64_decode(
        'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII='
    );

    return Response::make($pixel, 200, [
        'Content-Type' => 'image/png',
        'Content-Length' => strlen($pixel),
        'Cache-Control' => 'no-cache, no-store, must-revalidate',
        'Pragma' => 'no-cache',
        'Expires' => '0',
    ]);
})->name('email.open');
