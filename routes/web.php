<?php

// ===================================================================
// IMPORT STATEMENTS
// ===================================================================

// API Controllers

use App\Http\Controllers\Api\AngkatanController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\EnrollmentKelasController;
use App\Http\Controllers\Api\EnrollmentMahasiswaKelasController;
use App\Http\Controllers\Api\EnrollmentMkMhsDsnRngController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\ProgramStudiController;
use App\Http\Controllers\Api\RuangController;
use App\Http\Controllers\Api\TahunAkademikController;
// Main Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;

// Models
use App\Models\Angkatan;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\EnrollmentKelas;
use App\Models\EnrollmentMahasiswaKelas;
use App\Models\EnrollmentMkMhsDsnRng;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\MataKuliah;
use App\Models\Notification;
use App\Models\Ruang;
use App\Models\TahunAkademik;

// Laravel Core
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ===================================================================
// AUTHENTICATION ROUTES
// ===================================================================

// Landing page - redirect to login if not authenticated
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest.custom')->name('/');

// Authentication endpoints
Route::post('/login', [AuthController::class, 'login'])->middleware('guest.custom')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================================================================
// ADMIN ROUTES
// ===================================================================

// ---------------------- ADMIN DASHBOARD ----------------------
Route::get('/admin/dashboard', function () {
    // Get basic counts for dashboard statistics
    $mahasiswaCount = Mahasiswa::count();
    $dosenCount = Dosen::count();
    $matakuliahCount = MataKuliah::count();
    $ruangCount = Ruang::count();

    // Complex query to get program studi that already have schedules
    $enrollmentIds = Jadwal::pluck('id_enrollment_mk_mhs_dsn_rng')->unique();
    $prodiIdsInJadwal = EnrollmentMkMhsDsnRng::whereIn('id', $enrollmentIds)
        ->pluck('id_enrollment_kelas');
    $prodiIds = EnrollmentKelas::whereIn('id', $prodiIdsInJadwal)
        ->pluck('id_program_studi')
        ->unique();

    // Get program studi that already have schedules (max 3)
    $prodiSudah = ProgramStudi::whereIn('id', $prodiIds)->get()->take(3);
    // Get program studi that don't have schedules yet (max 5)
    $prodiBelum = ProgramStudi::whereNotIn('id', $prodiIds)->get()->take(5);

    $prodiSudahCount = $prodiSudah->count();
    $prodiBelumCount = $prodiBelum->count();

    // Get latest notifications for dashboard
    $notification = Notification::with(['dosen', 'jamMulai', 'jamSelesai'])
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return view('admin.dashboard', compact(
        'mahasiswaCount',
        'dosenCount',
        'matakuliahCount',
        'ruangCount',
        'notification',
        'prodiSudah',
        'prodiBelum',
        'prodiSudahCount',
        'prodiBelumCount'
    ));
})->middleware('role:admin')->name('admin.dashboard');

// ---------------------- ADMIN MAHASISWA MANAGEMENT ----------------------

// Mahasiswa listing page
Route::get('/admin/mahasiswa', function () {
    return view('admin.mahasiswa');
})->middleware('role:admin')->name('admin.mahasiswa');

// Mahasiswa CRUD operations
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

// Mahasiswa create form
Route::get('/admin/mahasiswa-create', function () {
    return view('admin.mahasiswa-create');
})->middleware('role:admin')->name('admin.mahasiswa-create');

// Mahasiswa update form
Route::get('/admin/mahasiswa-update/{id}', function ($id) {
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('admin.mahasiswa-update', compact('id', 'mahasiswa'));
})->middleware('role:admin')->name('admin.mahasiswa-update');

// ---------------------- ADMIN DOSEN MANAGEMENT ----------------------

// Dosen listing page
Route::get('/admin/dosen', function () {
    return view('admin.dosen');
})->middleware('role:admin')->name('admin.dosen');

// Dosen CRUD operations
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

// Dosen create form
Route::get('/admin/dosen-create', function () {
    return view('admin.dosen-create');
})->middleware('role:admin')->name('admin.dosen-create');

// Dosen update form
Route::get('/admin/dosen-update/{id}', function ($id) {
    $dosen = Dosen::findOrFail($id);
    return view('admin.dosen-update', compact('id', 'dosen'));
})->middleware('role:admin')->name('admin.dosen-update');

// ---------------------- ADMIN JURUSAN MANAGEMENT ----------------------
// Jurusan listing page
Route::get('/admin/jurusan', function () {
    return view('admin.jurusan');
})->middleware('role:admin')->name('admin.jurusan');

// Jurusan CRUD operations
Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

// Jurusan create form
Route::get('/admin/jurusan-create', function () {
    return view('admin.jurusan-create');
})->middleware('role:admin')->name('admin.jurusan-create');

// Jurusan update form 
Route::get('/admin/jurusan-update/{id}', function ($id) {
    $jurusan = Jurusan::findOrFail($id);
    return view('admin.jurusan-update', compact('id', 'jurusan'));
})->middleware('role:admin')->name('admin.jurusan-update');

// ---------------------- ADMIN ANGKATAN MANAGEMENT ----------------------
// Angkatan listing page
Route::get('/admin/angkatan', function () {
    return view('admin.angkatan');
})->middleware('role:admin')->name('admin.angkatan');

// Angkatan CRUD operations
Route::post('/angkatan', [AngkatanController::class, 'store'])->name('angkatan.store');
Route::put('/angkatan/{id}', [AngkatanController::class, 'update'])->name('angkatan.update');
Route::delete('/angkatan/{id}', [AngkatanController::class, 'destroy'])->name('angkatan.destroy');

// Angkatan create form
Route::get('/admin/angkatan-create', function () {
    return view('admin.angkatan-create');
})->middleware('role:admin')->name('admin.angkatan-create');

// Angkatan update form
Route::get('/admin/angkatan-update/{id}', function ($id) {
    $angkatan = Angkatan::findOrFail($id);
    return view('admin.angkatan-update', compact('id', 'angkatan'));
})->middleware('role:admin')->name('admin.angkatan-update');

// ---------------------- ADMIN PROGRAM STUDI MANAGEMENT ----------------------

// Program Studi listing page
Route::get('/admin/program-studi', function () {
    return view('admin.program-studi');
})->middleware('role:admin')->name('admin.program-studi');

// Program Studi CRUD operations
Route::post('/program-studi', [ProgramStudiController::class, 'store'])->name('program-studi.store');
Route::put('/program-studi/{id}', [ProgramStudiController::class, 'update'])->name('program-studi.update');
Route::delete('/program-studi/{id}', [ProgramStudiController::class, 'destroy'])->name('program-studi.destroy');

// Program Studi create form
Route::get('/admin/program-studi-create', function () {
    $jurusan = Jurusan::all();
    return view('admin.program-studi-create', compact('jurusan'));
})->middleware('role:admin')->name('admin.program-studi-create');

// Program Studi update form
Route::get('/admin/program-studi-update/{id}', function ($id) {
    $programStudi = ProgramStudi::findOrFail($id);
    $jurusan = Jurusan::all();
    return view('admin.program-studi-update', compact('id', 'programStudi', 'jurusan'));
})->middleware('role:admin')->name('admin.program-studi-update');

// ---------------------- ADMIN MATA KULIAH MANAGEMENT ----------------------

// Mata Kuliah listing page
Route::get('/admin/mata-kuliah', function () {
    return view('admin.mata-kuliah');
})->middleware('role:admin')->name('admin.mata-kuliah');

// Mata Kuliah CRUD operations
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');
Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.destroy');

// Mata Kuliah create form
Route::get('/admin/mata-kuliah-create', function () {
    $ruang = Ruang::all();
    return view('admin.mata-kuliah-create', compact('ruang'));
})->middleware('role:admin')->name('admin.mata-kuliah-create');

// Mata Kuliah update form
Route::get('/admin/mata-kuliah-update/{id}', function ($id) {
    $ruang = Ruang::all();
    $mataKuliah = MataKuliah::findOrFail($id);
    return view('admin.mata-kuliah-update', compact('id', 'mataKuliah', 'ruang'));
})->middleware('role:admin')->name('admin.mata-kuliah-update');

// ---------------------- ADMIN RUANG MANAGEMENT ----------------------

// Ruang listing page
Route::get('/admin/ruang', function () {
    return view('admin.ruang');
})->middleware('role:admin')->name('admin.ruang');

// Ruang CRUD operations
Route::post('/ruang', [RuangController::class, 'store'])->name('ruang.store');
Route::put('/ruang/{id}', [RuangController::class, 'update'])->name('ruang.update');
Route::delete('/ruang/{id}', [RuangController::class, 'destroy'])->name('ruang.destroy');

// Ruang create form
Route::get('/admin/ruang-create', function () {
    return view('admin.ruang-create');
})->middleware('role:admin')->name('admin.ruang-create');

// Ruang update form
Route::get('/admin/ruang-update/{id}', function ($id) {
    $ruang = Ruang::findOrFail($id);
    return view('admin.ruang-update', compact('id', 'ruang'));
})->middleware('role:admin')->name('admin.ruang-update');

// ---------------------- ADMIN KELAS MANAGEMENT ----------------------

// Kelas listing page
Route::get('/admin/kelas', function () {
    return view('admin.kelas');
})->middleware('role:admin')->name('admin.kelas');

// Kelas CRUD operations
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Kelas create form
Route::get('/admin/kelas-create', function () {
    return view('admin.kelas-create');
})->middleware('role:admin')->name('admin.kelas-create');

// Kelas update form
Route::get('/admin/kelas-update/{id}', function ($id) {
    $kelas = Kelas::findOrFail($id);
    return view('admin.kelas-update', compact('id', 'kelas'));
})->middleware('role:admin')->name('admin.kelas-update');


// ---------------------- ADMIN ANGKATAN MANAGEMENT ----------------------

// Angkatan listing page
Route::get('/admin/angkatan', function () {
    return view('admin.angkatan');
})->middleware('role:admin')->name('admin.angkatan');

// Angkatan CRUD operations
Route::post('/angkatan', [AngkatanController::class, 'store'])->name('angkatan.store');
Route::put('/angkatan/{id}', [AngkatanController::class, 'update'])->name('angkatan.update');
Route::delete('/angkatan/{id}', [AngkatanController::class, 'destroy'])->name('angkatan.destroy');

// Angkatan create form
Route::get('/admin/angkatan-create', function () {
    return view('admin.angkatan-create');
})->middleware('role:admin')->name('admin.angkatan-create');

// Angkatan update form
Route::get('/admin/angkatan-update/{id}', function ($id) {
    $angkatan = Angkatan::findOrFail($id);
    return view('admin.angkatan-update', compact('id', 'angkatan'));
})->middleware('role:admin')->name('admin.angkatan-update');

// ---------------------- ADMIN TAHUN AKADEMIK MANAGEMENT ----------------------

// Tahun Akademik listing page
Route::get('/admin/tahun-akademik', function () {
    return view('admin.tahun-akademik');
})->middleware('role:admin')->name('admin.tahun-akademik');

// Tahun Akademik CRUD operations
Route::post('/tahun-akademik', [TahunAkademikController::class, 'store'])->name('tahun-akademik.store');
Route::put('/tahun-akademik/{id}', [TahunAkademikController::class, 'update'])->name('tahun-akademik.update');
Route::delete('/tahun-akademik/{id}', [TahunAkademikController::class, 'destroy'])->name('tahun-akademik.destroy');

// Tahun Akademik create form
Route::get('/admin/tahun-akademik-create', function () {
    return view('admin.tahun-akademik-create');
})->middleware('role:admin')->name('admin.tahun-akademik-create');

// Tahun Akademik update form
Route::get('/admin/tahun-akademik-update/{id}', function ($id) {
    $tahunAkademik = TahunAkademik::findOrFail($id);
    return view('admin.tahun-akademik-update', compact('id', 'tahunAkademik'));
})->middleware('role:admin')->name('admin.tahun-akademik-update');

// ---------------------- ADMIN ENROLLMENT MANAGEMENT ----------------------

// Enrollment Kelas - for managing class enrollments
Route::get('/admin/enrollment-kelas', function () {
    return view('admin.enrollment-kelas');
})->middleware('role:admin')->name('admin.enrollment-kelas');

// Enrollment Kelas CRUD operations
Route::post('/enrollment-kelas', [EnrollmentKelasController::class, 'store'])->name('enrollment-kelas.store');
Route::put('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'update'])->name('enrollment-kelas.update');
Route::delete('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'destroy'])->name('enrollment-kelas.destroy');

// Enrollment Kelas create form
Route::get('/admin/enrollment-kelas-create', function () {
    $tahunAkademik = TahunAkademik::where('status', 1)->get();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    return view('admin.enrollment-kelas-create', compact('tahunAkademik', 'programStudi', 'kelas', 'angkatan'));
})->middleware('role:admin')->name('admin.enrollment-kelas-create');

// Enrollment Kelas update form
Route::get('/admin/enrollment-kelas-update/{id}', function ($id) {
    $tahunAkademik = TahunAkademik::where('status', 1)->get();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    $enrollment = EnrollmentKelas::findOrFail($id);
    return view('admin.enrollment-kelas-update', compact('id', 'tahunAkademik', 'programStudi', 'kelas', 'angkatan', 'enrollment'));
})->middleware('role:admin')->name('admin.enrollment-kelas-update');

// Enrollment Jadwal - for managing schedule enrollments (mata kuliah + mahasiswa + dosen + ruang)
Route::get('/admin/enrollment-jadwal', function () {
    return view('admin.enrollment-jadwal');
})->middleware('role:admin')->name('admin.enrollment-jadwal');

// Enrollment Jadwal CRUD operations
Route::post('/enrollment-jadwal', [EnrollmentMkMhsDsnRngController::class, 'store'])->name('enrollment-jadwal.store');
Route::put('/enrollment-jadwal/{id}', [EnrollmentMkMhsDsnRngController::class, 'update'])->name('enrollment-jadwal.update');
Route::delete('/enrollment-jadwal/{id}', [EnrollmentMkMhsDsnRngController::class, 'destroy'])->name('enrollment-jadwal.destroy');

// Enrollment Jadwal create form
Route::get('/admin/enrollment-jadwal-create', function () {
    $mataKuliah = MataKuliah::all();
    // Build class display names for dropdown selection
    $enrollmentKelas = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->get()
        ->map(function ($item) {
            $kelas = $item->kelas ? $item->kelas->nama_kelas : 'Tanpa Nama Kelas';
            $prodi = $item->programStudi ? $item->programStudi->kode_prodi : 'Tanpa Prodi';
            $angkatan = $item->angkatan ? $item->angkatan->tahun_angkatan : 'Tanpa Angkatan';
            $item->nama_kelas_display = "{$prodi}-{$angkatan}{$kelas}";
            return $item;
        });
    $dosen = Dosen::all();
    return view('admin.enrollment-jadwal-create', compact('mataKuliah', 'enrollmentKelas', 'dosen'));
})->middleware('role:admin')->name('admin.enrollment-jadwal-create');

// Enrollment Jadwal update form
Route::get('/admin/enrollment-jadwal-update/{id}', function ($id) {
    $mataKuliah = MataKuliah::all();
    // Build class display names for dropdown selection
    $enrollmentKelas = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->get()
        ->map(function ($item) {
            $kelas = $item->kelas ? $item->kelas->nama_kelas : 'Tanpa Nama Kelas';
            $prodi = $item->programStudi ? $item->programStudi->kode_prodi : 'Tanpa Prodi';
            $angkatan = $item->angkatan ? $item->angkatan->tahun_angkatan : 'Tanpa Angkatan';
            $item->nama_kelas_display = "{$prodi}-{$angkatan}{$kelas}";
            return $item;
        });
    $dosen = Dosen::all();
    $enrollment = EnrollmentMkMhsDsnRng::findOrFail($id);
    return view('admin.enrollment-jadwal-update', compact('id', 'mataKuliah', 'enrollmentKelas', 'dosen', 'enrollment'));
})->middleware('role:admin')->name('admin.enrollment-jadwal-update');

// Enrollment Mahasiswa Kelas - for enrolling students to specific classes
Route::get('/admin/enrollment-mahasiswa-kelas', function () {
    return view('admin.enrollment-mahasiswa-kelas');
})->middleware('role:admin')->name('admin.enrollment-mahasiswa-kelas');

// Enrollment Mahasiswa Kelas CRUD operations
Route::post('/enrollment-mahasiswa-kelas', [EnrollmentMahasiswaKelasController::class, 'store'])->name('enrollment-mahasiswa-kelas.store');
Route::put('/enrollment-mahasiswa-kelas/{id}', [EnrollmentMahasiswaKelasController::class, 'update'])->name('enrollment-mahasiswa-kelas.update');
Route::delete('/enrollment-mahasiswa-kelas/{id}', [EnrollmentMahasiswaKelasController::class, 'destroy'])->name('enrollment-mahasiswa-kelas.destroy');

// Enrollment Mahasiswa Kelas create form
Route::get('/admin/enrollment-mahasiswa-kelas-create', function () {
    // Get active academic years
    $tahunAkademikAktifIds = TahunAkademik::where('status', 1)->pluck('id');
    $enrollmentKelasAktifIds = EnrollmentKelas::whereIn('id_tahun_akademik', $tahunAkademikAktifIds)->pluck('id');

    // Get students that are already enrolled to avoid duplicates
    $nimTerdaftar = EnrollmentMahasiswaKelas::whereIn('id_enrollment_kelas', $enrollmentKelasAktifIds)
        ->pluck('id_mahasiswa');

    // Get students that are not yet enrolled in any active class
    $mahasiswa = Mahasiswa::whereNotIn('id', $nimTerdaftar)->get();

    // Build class display names for active academic years only
    $enrollmentKelas = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])
        ->whereIn('id_tahun_akademik', $tahunAkademikAktifIds)
        ->get()
        ->map(function ($item) {
            $kelas = $item->kelas ? $item->kelas->nama_kelas : 'Tanpa Nama Kelas';
            $prodi = $item->programStudi ? $item->programStudi->kode_prodi : 'Tanpa Prodi';
            $angkatan = $item->angkatan ? $item->angkatan->tahun_angkatan : 'Tanpa Angkatan';
            $item->nama_kelas_display = "{$prodi}-{$angkatan}{$kelas}";
            return $item;
        });

    return view('admin.enrollment-mahasiswa-kelas-create', compact('mahasiswa', 'enrollmentKelas'));
})->middleware('role:admin')->name('admin.enrollment-mahasiswa-kelas-create');

// Enrollment Mahasiswa Kelas update form
Route::get('/admin/enrollment-mahasiswa-kelas-update/{id}', function ($id) {
    $mahasiswa = Mahasiswa::all();
    // Build class display names for dropdown selection
    $enrollmentKelas = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->get()
        ->map(function ($item) {
            $kelas = $item->kelas ? $item->kelas->nama_kelas : 'Tanpa Nama Kelas';
            $prodi = $item->programStudi ? $item->programStudi->kode_prodi : 'Tanpa Prodi';
            $angkatan = $item->angkatan ? $item->angkatan->tahun_angkatan : 'Tanpa Angkatan';
            $item->nama_kelas_display = "{$prodi}-{$angkatan}{$kelas}";
            return $item;
        });
    $enrollment = EnrollmentMahasiswaKelas::findOrFail($id);
    return view('admin.enrollment-mahasiswa-kelas-update', compact('id', 'mahasiswa', 'enrollmentKelas', 'enrollment'));
})->middleware('role:admin')->name('admin.enrollment-mahasiswa-kelas-update');

// ---------------------- ADMIN SCHEDULE & NOTIFICATION MANAGEMENT ----------------------

// Schedule management page
Route::get('/admin/schedule', function () {
    $notification = Notification::with(['dosen', 'jamMulai', 'jamSelesai'])
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
    $programStudis = ProgramStudi::limit(3)->get();
    return view('admin.schedule', compact('programStudis', 'notification'));
})->middleware('role:admin')->name('admin.schedule');

// Notification management page
Route::get('/admin/notification', function () {
    return view('admin.notification');
})->middleware('role:admin')->name('admin.notification');

// ---------------------- ADMIN PROFILE MANAGEMENT ----------------------

// Admin profile view
Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware('role:admin')->name('admin.profile');

// Admin profile update form
Route::get('/admin/profile-update', function (Request $request) {
    $user = $request->session()->get('user');
    return view('admin.profile-update', compact('user'));
})->middleware('role:admin');

// ===================================================================
// DOSEN ROUTES
// ===================================================================

// ---------------------- Dosen Sidebar ----------------------
Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/dosen/schedule', function () {
    return view('dosen.schedule');
})->middleware('role:dosen')->name('dosen.schedule');

Route::get('/dosen/mata-kuliah', function () {
    return view('dosen.mata-kuliah');
})->middleware('role:dosen')->name('dosen.mata-kuliah');

Route::get('/dosen/requirement-dosen', function () {
    return view('dosen.requirement-dosen');
})->middleware('role:dosen')->name('requirement.dosen');

// ---------------------- dosen PROFILE MANAGEMENT ----------------------
// dosen profile view
Route::get('/dosen/profile', function () {
    return view('dosen.profile');
})->middleware('role:dosen')->name('dosen.profile');

// dosen profile update form
Route::get('/dosen/profile-update', function (Request $request) {
    $user = $request->session()->get('user');
    return view('dosen.profile-update', compact('user'));
})->middleware('role:dosen');

// ===================================================================
// MAHASISWA ROUTES
// ===================================================================

// Mahasiswa dashboard
Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

Route::get('/mahasiswa/schedule', function () {
    return view('mahasiswa.schedule');
})->middleware('role:mahasiswa')->name('mahasiswa.schedule');

Route::get('/mahasiswa/mata-kuliah', function () {
    return view('mahasiswa.mata-kuliah');
})->middleware('role:mahasiswa')->name('mahasiswa.mata-kuliah');

Route::get('/mahasiswa/dosen', function () {
    return view('mahasiswa.dosen');
})->middleware('role:mahasiswa')->name('mahasiswa.dosen');

Route::get('/mahasiswa/profile', function () {
    return view('mahasiswa.profile');
})->middleware('role:mahasiswa')->name('mahasiswa.profile');

// ===================================================================
// SHARED PROFILE ROUTES (ALL ROLES)
// ===================================================================

// Profile routes accessible by all authenticated users
Route::get('/admin/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/dosen/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/mahasiswa/profile', [AuthController::class, 'profile'])->name('profile');

// ===================================================================
// UTILITY ROUTES
// ===================================================================

// Schedule generation utility
Route::get('/generate', [GenerateController::class, 'generateJadwal']);