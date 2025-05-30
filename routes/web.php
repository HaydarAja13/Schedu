<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\EnrollmentKelasController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\EnrollmentKelas;
use App\Models\TahunAkademik;
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

Route::post('/enrollment-kelas', [EnrollmentKelasController::class, 'store'])->name('enrollment-kelas.store');
Route::put('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'update'])->name('enrollment-kelas.update');
Route::delete('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'destroy'])->name('enrollment-kelas.destroy');

Route::get('/admin/enrollment-kelas-create', function () {
    $tahunAkademik = TahunAkademik::all();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    return view('admin.enrollment-kelas-create', compact('tahunAkademik', 'programStudi', 'kelas', 'angkatan'));
})->middleware('role:admin')->name('admin.enrollment-kelas-create');

Route::get('/admin/enrollment-kelas-update/{id}', function ($id) {
    $tahunAkademik = TahunAkademik::all();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    $enrollment = EnrollmentKelas::findOrFail($id);
    return view('admin.enrollment-kelas-update', compact('id', 'tahunAkademik', 'programStudi', 'kelas', 'angkatan', 'enrollment'));
})->middleware('role:admin')->name('admin.enrollment-kelas-update');
// dosen

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');


Route::get('/generate', [GenerateController::class, 'generateJadwal']);
