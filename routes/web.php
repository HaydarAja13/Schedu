<?php

use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// generate

Route::get('/generate', [GenerateController::class, 'generateJadwal']);