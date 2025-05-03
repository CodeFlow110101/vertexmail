<?php

use App\Http\Controllers\MailOpenController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/email/open/{id}', MailOpenController::class)->name('email.open');

