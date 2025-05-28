<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute Halaman Utama (Login)
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest.custom')->name('/');

// Rute Autentikasi
Route::post('/login', [AuthController::class, 'login'])->middleware('guest.custom')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:admin')->name('admin.dashboard');

Route::get('/admin/mahasiswa', function () {
    return view('admin.mahasiswa');
})->middleware('role:admin')->name('admin.mahasiswa');

Route::get('/admin/schedule', function () {
    return view('admin.schedule');
})->middleware('role:admin')->name('admin.schedule');

Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware('role:admin')->name('admin.profile');

Route::get('/admin/notification', function () {
    return view('admin.notification');
})->middleware('role:admin')->name('admin.notification');

// dosen

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

Route::get('/generate', [GenerateController::class, 'generateJadwal']);
