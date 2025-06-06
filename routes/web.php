<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\EnrollmentKelasController;
use App\Http\Controllers\Api\EnrollmentMahasiswaKelasController;
use App\Http\Controllers\Api\EnrollmentMkMhsDsnRngController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\ProgramStudiController;
use App\Http\Controllers\Api\RuangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Models\Angkatan;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\EnrollmentKelas;
use App\Models\EnrollmentMahasiswaKelas;
use App\Models\EnrollmentMkMhsDsnRng;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Notification;
use App\Models\Ruang;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest.custom')->name('/');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest.custom')->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin
Route::get('/admin/dashboard', function () {
    $mahasiswaCount = Mahasiswa::count();
    $dosenCount = Dosen::count();
    $matakuliahCount = MataKuliah::count();
    $ruangCount = Ruang::count();

    $enrollmentIds = Jadwal::pluck('id_enrollment_mk_mhs_dsn_rng')->unique();
    $prodiIdsInJadwal = EnrollmentMkMhsDsnRng::whereIn('id', $enrollmentIds)
        ->pluck('id_enrollment_kelas');
    $prodiIds = EnrollmentKelas::whereIn('id', $prodiIdsInJadwal)
        ->pluck('id_program_studi')
        ->unique();

    $prodiSudah = ProgramStudi::whereIn('id', $prodiIds)->get()->take(3);
    $prodiBelum = ProgramStudi::whereNotIn('id', $prodiIds)->get()->take(5);

    $prodiSudahCount = $prodiSudah->count();
    $prodiBelumCount = $prodiBelum->count();

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

Route::get('/admin/mahasiswa', function () {
    return view('admin.mahasiswa');
})->middleware('role:admin')->name('admin.mahasiswa');


Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/admin/mahasiswa-create', function () {
    return view('admin.mahasiswa-create');
})->middleware('role:admin')->name('admin.mahasiswa-create');
Route::get('/admin/mahasiswa-update/{id}', function ($id) {
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('admin.mahasiswa-update', compact('id', 'mahasiswa'));
})->middleware('role:admin')->name('admin.mahasiswa-update');

// dosen admin
Route::get('/admin/dosen', function () {
    return view('admin.dosen');
})->middleware('role:admin')->name('admin.dosen');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
Route::get('/admin/dosen-create', function () {
    return view('admin.dosen-create');
})->middleware('role:admin')->name('admin.dosen-create');
Route::get('/admin/dosen-update/{id}', function ($id) {
    $dosen = Dosen::findOrFail($id);
    return view('admin.dosen-update', compact('id', 'dosen'));
})->middleware('role:admin')->name('admin.dosen-update');


Route::get('/admin/schedule', function () {
    $notification = Notification::with(['dosen', 'jamMulai', 'jamSelesai'])
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
    $programStudis = ProgramStudi::limit(3)->get();
    return view('admin.schedule', compact('programStudis', 'notification'));
})->middleware('role:admin')->name('admin.schedule');

Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware('role:admin')->name('admin.profile');

Route::get('/admin/profile-update', function (Request $request) {
    $user = $request->session()->get('user');
    return view('admin.profile-update', compact('user'));
})->middleware('role:admin');
// notifikasi

Route::get('/admin/notification', function () {
    return view('admin.notification');
})->middleware('role:admin')->name('admin.notification');


// enrollment kelas
Route::get('/admin/enrollment-kelas', function () {
    return view('admin.enrollment-kelas');
})->middleware('role:admin')->name('admin.enrollment-kelas');

Route::post('/enrollment-kelas', [EnrollmentKelasController::class, 'store'])->name('enrollment-kelas.store');
Route::put('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'update'])->name('enrollment-kelas.update');
Route::delete('/enrollment-kelas/{id}', [EnrollmentKelasController::class, 'destroy'])->name('enrollment-kelas.destroy');

Route::get('/admin/enrollment-kelas-create', function () {
    $tahunAkademik = TahunAkademik::where('status', 1)->get();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    return view('admin.enrollment-kelas-create', compact('tahunAkademik', 'programStudi', 'kelas', 'angkatan'));
})->middleware('role:admin')->name('admin.enrollment-kelas-create');

Route::get('/admin/enrollment-kelas-update/{id}', function ($id) {
    $tahunAkademik = TahunAkademik::where('status', 1)->get();
    $programStudi = ProgramStudi::all();
    $kelas = Kelas::all();
    $angkatan = Angkatan::all();
    $enrollment = EnrollmentKelas::findOrFail($id);
    return view('admin.enrollment-kelas-update', compact('id', 'tahunAkademik', 'programStudi', 'kelas', 'angkatan', 'enrollment'));
})->middleware('role:admin')->name('admin.enrollment-kelas-update');

// enrollment jadwal
Route::get('/admin/enrollment-jadwal', function () {
    return view('admin.enrollment-jadwal');
})->middleware('role:admin')->name('admin.enrollment-jadwal');

Route::post('/enrollment-jadwal', [EnrollmentMkMhsDsnRngController::class, 'store'])->name('enrollment-jadwal.store');
Route::put('/enrollment-jadwal/{id}', [EnrollmentMkMhsDsnRngController::class, 'update'])->name('enrollment-jadwal.update');
Route::delete('/enrollment-jadwal/{id}', [EnrollmentMkMhsDsnRngController::class, 'destroy'])->name('enrollment-jadwal.destroy');

Route::get('/admin/enrollment-jadwal-create', function () {
    $mataKuliah = MataKuliah::all();
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

Route::get('/admin/enrollment-jadwal-update/{id}', function ($id) {
    $mataKuliah = MataKuliah::all();
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

// enrollment mahasiswa kelas
Route::get('/admin/enrollment-mahasiswa-kelas', function () {
    return view('admin.enrollment-mahasiswa-kelas');
})->middleware('role:admin')->name('admin.enrollment-mahasiswa-kelas');

Route::post('/enrollment-mahasiswa-kelas', [EnrollmentMahasiswaKelasController::class, 'store'])->name('enrollment-mahasiswa-kelas.store');
Route::put('/enrollment-mahasiswa-kelas/{id}', [EnrollmentMahasiswaKelasController::class, 'update'])->name('enrollment-mahasiswa-kelas.update');
Route::delete('/enrollment-mahasiswa-kelas/{id}', [EnrollmentMahasiswaKelasController::class, 'destroy'])->name('enrollment-mahasiswa-kelas.destroy');


Route::get('/admin/enrollment-mahasiswa-kelas-create', function () {
    $tahunAkademikAktifIds = TahunAkademik::where('status', 1)->pluck('id');
    $enrollmentKelasAktifIds = EnrollmentKelas::whereIn('id_tahun_akademik', $tahunAkademikAktifIds)->pluck('id');

    $nimTerdaftar = EnrollmentMahasiswaKelas::whereIn('id_enrollment_kelas', $enrollmentKelasAktifIds)
        ->pluck('id_mahasiswa');

    $mahasiswa = Mahasiswa::whereNotIn('id', $nimTerdaftar)->get();

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


Route::get('/admin/enrollment-mahasiswa-kelas-update/{id}', function ($id) {
    $mahasiswa = Mahasiswa::all();
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

// dosen
Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->middleware('role:dosen')->name('dosen.dashboard');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware('role:mahasiswa')->name('mahasiswa.dashboard');

// Program Studi
Route::get('/admin/program-studi', function () {
    return view('admin.program-studi');
})->middleware('role:admin')->name('admin.program-studi');

Route::post('/program-studi', [ProgramStudiController::class, 'store'])->name('program-studi.store');
Route::put('/program-studi/{id}', [ProgramStudiController::class, 'update'])->name('program-studi.update');
Route::delete('/program-studi/{id}', [ProgramStudiController::class, 'destroy'])->name('program-studi.destroy');
Route::get('/admin/program-studi-create', function () {
    return view('admin.program-studi-create');
})->middleware('role:admin')->name('admin.program-studi-create');
Route::get('/admin/program-studi-update/{id}', function ($id) {
    $programStudi = ProgramStudi::findOrFail($id);
    return view('admin.program-studi-update', compact('id', 'programStudi'));
})->middleware('role:admin')->name('admin.program-studi-update');

// Mata Kuliah
Route::get('/admin/mata-kuliah', function () {
    return view('admin.mata-kuliah');
})->middleware('role:admin')->name('admin.mata-kuliah');
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');
Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.destroy');
Route::get('/admin/mata-kuliah-create', function () {
    return view('admin.mata-kuliah-create');
})->middleware('role:admin')->name('admin.mata-kuliah-create');
Route::get('/admin/mata-kuliah-update/{id}', function ($id) {
    $mataKuliah = MataKuliah::findOrFail($id);
    return view('admin.mata-kuliah-update', compact('id', 'mataKuliah'));
})->middleware('role:admin')->name('admin.mata-kuliah-update');

// Ruang
Route::get('/admin/ruang', function () {
    return view('admin.ruang');
})->middleware('role:admin')->name('admin.ruang');
Route::post('/ruang', [RuangController::class, 'store'])->name('ruang.store');
Route::put('/ruang/{id}', [RuangController::class, 'update'])->name('ruang.update');
Route::delete('/ruang/{id}', [RuangController::class, 'destroy'])->name('ruang.destroy');
Route::get('/admin/ruang-create', function () {
    return view('admin.ruang-create');
})->middleware('role:admin')->name('admin.ruang-create');
Route::get('/admin/ruang-update/{id}', function ($id) {
    $ruang = Ruang::findOrFail($id);
    return view('admin.ruang-update', compact('id', 'ruang'));
})->middleware('role:admin')->name('admin.ruang-update');

// Kelas
Route::get('/admin/kelas', function () {
    return view('admin.kelas');
})->middleware('role:admin')->name('admin.kelas');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
Route::get('/admin/kelas-create', function () {
    return view('admin.kelas-create');
})->middleware('role:admin')->name('admin.kelas-create');
Route::get('/admin/kelas-update/{id}', function ($id) {
    $kelas = Kelas::findOrFail($id);
    return view('admin.kelas-update', compact('id', 'kelas'));
})->middleware('role:admin')->name('admin.kelas-update');



Route::get('/generate', [GenerateController::class, 'generateJadwal']);
Route::get('/admin/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/dosen/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/mahasiswa/profile', [AuthController::class, 'profile'])->name('profile');
