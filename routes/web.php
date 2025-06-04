<?php

use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\RuangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest.custom')->name('/');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest.custom')->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:admin')->name('admin.dashboard');

Route::get('/admin/mahasiswa', function () {
    return view('admin.mahasiswa');
})->middleware('role:admin')->name('admin.mahasiswa');



Route::get('/admin/kelas', function () {
    return view('admin.kelas.index');
})->middleware('role:admin')->name('admin.kelas.index');
Route::post('/admin/kelas', [KelasController::class, 'store'])
    ->middleware('role:admin')
    ->name('admin.kelas.store');

Route::middleware('role:admin')->group(function () {
    Route::get('/kelas', [KelasController::class,'index'])->name('kelas.index');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/create', [KelasController::class,'create'])->name('kelas.create');
    Route::put('/kelas/{id}', [KelasController::class,'update'])->name('kelas.update');
    Route::get('/kelas/{id}/edit', [KelasController::class,'edit'])->name('kelas.edit');
    Route::delete('/kelas/{id}', [KelasController::class,'destroy'])->name('kelas.destroy');
    Route::get('/kelas/{id}', [KelasController::class,'show'])->name('kelas.show');
});

Route::get('/admin/ruang', function () {
    return view('admin.ruang.index');
})->middleware('role:admin')->name('admin.ruang.index');
Route::get('/ruang', [RuangController::class,'index'])->name('ruang.index');
Route::post('/ruang', [RuangController::class,'store'])->name('ruang.store');
Route::get('/ruang/create', [RuangController::class,'create'])->name('ruang.create');
Route::put('/ruang/{id}', [RuangController::class,'update'])->name('ruang.update');
Route::get('/ruang/{id}/edit', [RuangController::class,'edit'])->name('ruang.edit');
Route::delete('/ruang/{id}', [RuangController::class,'destroy'])->name('ruang.destroy');
Route::get('/ruang/{id}', [RuangController::class,'show'])->name('ruang.show');

Route::get('/admin/schedule', function () {
    $programStudis = ProgramStudi::limit(3)->get();
    return view('admin.schedule', compact('programStudis'));
})->middleware('role:admin')->name('admin.schedule');

Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware('role:admin')->name('admin.profile');

Route::get('/admin/notification', function () {
    return view('admin.notification');
})->middleware('role:admin')->name('admin.notification');


Route::get('/admin/enrollment-kelas', function () {
    return view('admin.enrollment-kelas');
})->middleware('role:admin')->name('admin.enrollment-kelas');
// dosen

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');




Route::get('/generate', [GenerateController::class, 'generateJadwal']);


