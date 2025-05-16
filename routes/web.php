<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest.custom')->name('/');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest.custom')->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:admin')->name('admin.dashboard');

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

Route::get('/generate', [GenerateController::class, 'generateJadwal']);
