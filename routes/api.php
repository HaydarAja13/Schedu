<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AngkatanController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\EnrollmentKelasController;
use App\Http\Controllers\Api\EnrollmentMahasiswaKelasController;
use App\Http\Controllers\Api\EnrollmentMkMhsDsnRngController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\JamAkhirController;
use App\Http\Controllers\Api\JamAwalController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\ProgramStudiController;
use App\Http\Controllers\Api\RuangController;
use App\Http\Controllers\Api\TahunAkademikController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::apiResource('dosen', DosenController::class);
Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('admin', AdminController::class);
Route::apiResource('ruang', RuangController::class);
Route::apiResource('kelas', KelasController::class);
Route::apiResource('angkatan', AngkatanController::class);
Route::apiResource('tahun-akademik', TahunAkademikController::class);
Route::apiResource('program-studi', ProgramStudiController::class);
Route::apiResource('jurusan', JurusanController::class);
Route::apiResource('enrollment-kelas', EnrollmentKelasController::class);
Route::apiResource('jam-awal', JamAwalController::class);
Route::apiResource('jam-akhir', JamAkhirController::class);
Route::apiResource('enrollment-mahasiswa-kelas', EnrollmentMahasiswaKelasController::class);
Route::apiResource('mata-kuliah', MataKuliahController::class);
Route::apiResource('enrollment-all', EnrollmentMkMhsDsnRngController::class);
Route::apiResource('jadwal', JadwalController::class);
Route::get('enrollment-all/count-by-mahasiswa/{mahasiswa_id}', [EnrollmentMkMhsDsnRngController::class, 'countByMahasiswa']);
Route::get('enrollment-all/count-by-dosen/{dosen_id}', [EnrollmentMkMhsDsnRngController::class, 'countByDosen']);

