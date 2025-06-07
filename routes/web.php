<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ProgramStudiTable;
use App\Livewire\ProgramStudiForm;
use App\Livewire\DosenTable;
use App\Livewire\DosenForm;
use App\Livewire\MatkulTable;
use App\Livewire\MatkulForm;


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

Route::get('/admin/schedule', function () {
    return view('admin.schedule');
})->middleware('role:admin')->name('admin.schedule');

Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware('role:admin')->name('admin.profile');

Route::get('/admin/notification', function () {
    return view('admin.notification');
})->middleware('role:admin')->name('admin.notification');

Route::get('/admin/program-studi', function () {
    return view('admin.program-studi');
})->middleware('role:admin')->name('admin.program-studi');


// dosen

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

//Program Studi
// Tambahkan route untuk form
Route::get('/admin/program-studi/tambah', \App\Livewire\ProgramStudiForm::class)
    ->middleware('role:admin')
    ->name('admin.program-studi.create');

Route::get('/admin/program-studi/edit/{id}', \App\Livewire\ProgramStudiForm::class)
    ->middleware('role:admin')
    ->name('admin.program-studi.edit');

//Livewire Matkul
Route::get('/admin/mata-kuliah/tambah', \App\Livewire\ProgramStudiForm::class)
    ->middleware('role:admin')
    ->name('admin.mata-kuliah.create');

Route::get('/admin/mata-kuliah/edit/{id}', \App\Livewire\ProgramStudiForm::class)
    ->middleware('role:admin')
    ->name('admin.mata-kuliah.edit');
//
//Livewire Dosen
Route::get('/admin/dosen/tambah', \App\Livewire\DosenForm::class)
    ->middleware('role:admin')
    ->name('admin.dosen.create');

Route::get('/admin/dosen/edit/{id}', \App\Livewire\DosenForm::class)
    ->middleware('role:admin')
    ->name('admin.dosen.edit');

// Program Studi
Route::get('/admin/program-studi', \App\Livewire\ProgramStudiTable::class)
    ->middleware('role:admin')
    ->name('admin.program-studi');

// Dosen
Route::get('/admin/dosen', \App\Livewire\DosenTable::class)
    ->middleware('role:admin')
    ->name('admin.dosen');

Route::get('/generate', [GenerateController::class, 'generateJadwal']);
