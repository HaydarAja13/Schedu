<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Ruang;
use App\Models\ProgramStudi;
use App\Models\Jadwal;
use App\Models\EnrollmentKelas;
use App\Models\EnrollmentMkMhsDsnRng;

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

// Grup Rute untuk Admin
Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        // Data Kartu Ringkasan
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahRuang = Ruang::count();
        $jumlahMataKuliah = MataKuliah::count();

        // Data Permintaan Ubah Jadwal (Dummy Data)
        $permintaanJadwalDosen = [
            ['id' => 1, 'nama_dosen' => 'Wiktasari', 'deskripsi' => 'Hari Senin tidak bisa sampai malam', 'status' => 'pending', 'foto_profil' => 'https://i.pravatar.cc/150?img=1'],
            ['id' => 2, 'nama_dosen' => 'Kurnianingsih', 'deskripsi' => 'Jumat saya ke US', 'status' => 'pending', 'foto_profil' => 'https://i.pravatar.cc/150?img=2'],
            ['id' => 3, 'nama_dosen' => 'Ismayanti', 'deskripsi' => 'Karena tidak bisa pagi', 'status' => 'pending', 'foto_profil' => 'https://i.pravatar.cc/150?img=3'],
            ['id' => 4, 'nama_dosen' => 'Budi Santoso', 'deskripsi' => 'Jumat hanya bisa sampai siang', 'status' => 'pending', 'foto_profil' => 'https://i.pravatar.cc/150?img=4'],
        ];

        // Data Prodi Belum Terjadwal
        $allProdis = ProgramStudi::all();
        $prodiIdsWithJadwal = Jadwal::query()
            ->select('program_studi.id')
            ->join('enrollment_mk_mhs_dsn_rng', 'jadwal.id_enrollment_mk_mhs_dsn_rng', '=', 'enrollment_mk_mhs_dsn_rng.id')
            ->join('enrollment_kelas', 'enrollment_mk_mhs_dsn_rng.id_enrollment_kelas', '=', 'enrollment_kelas.id')
            ->join('program_studi', 'enrollment_kelas.id_program_studi', '=', 'program_studi.id')
            ->distinct()
            ->pluck('program_studi.id');

        $prodisWithJadwal = $allProdis->whereIn('id', $prodiIdsWithJadwal);
        $prodisWithoutJadwal = $allProdis->whereNotIn('id', $prodiIdsWithJadwal);

        $totalTerjadwal = $prodisWithJadwal->count();
        $totalBelumTerjadwal = $prodisWithoutJadwal->count();

        $programStudiBelumTerjadwal = $prodisWithoutJadwal->map(function ($prodi) {
            return ['id' => $prodi->id, 'nama_prodi' => $prodi->nama_prodi];
        })->take(4);

        $title = 'Dashboard'; // Judul halaman untuk template

        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahRuang',
            'jumlahMataKuliah',
            'permintaanJadwalDosen',
            'programStudiBelumTerjadwal',
            'totalTerjadwal',
            'totalBelumTerjadwal',
            'title'
        ));
    })->name('dashboard');

    // Manajemen Mahasiswa
    Route::get('/mahasiswa', function () {
        $title = 'Manajemen Mahasiswa';
        return view('admin.mahasiswa', compact('title'));
    })->name('mahasiswa');

    // Jadwal Perkuliahan
    Route::get('/schedule', function () {
        $title = 'Jadwal Perkuliahan';
        return view('admin.schedule', compact('title'));
    })->name('schedule');

    // Buat Jadwal Baru
    Route::get('/schedule/create', function () {
        $prodiId = request('prodi_id');
        $prodi = null;
        if ($prodiId) {
            $prodi = ProgramStudi::find($prodiId);
        }
        $title = 'Buat Jadwal Baru';
        return view('admin.schedule-create', compact('prodi', 'title'));
    })->name('schedule.create');

    // Manajemen Dosen
    Route::get('/dosen', function () {
        $title = 'Manajemen Dosen';
        return view('admin.dosen', compact('title'));
    })->name('dosen');

    // Manajemen Ruang
    Route::get('/ruang', function () {
        $title = 'Manajemen Ruang';
        return view('admin.ruang', compact('title'));
    })->name('ruang');

    // Manajemen Mata Kuliah
    Route::get('/mata-kuliah', function () {
        $title = 'Manajemen Mata Kuliah';
        return view('admin.mata-kuliah', compact('title'));
    })->name('mata-kuliah');

    // Profil Admin
    Route::get('/profile', function () {
        $title = 'Profil Pengguna';
        return view('admin.profile', compact('title'));
    })->name('profile');

    // Notifikasi Admin
    Route::get('/notification', function () {
        $title = 'Notifikasi';
        // Contoh: $notifications = Notification::latest()->get();
        return view('admin.notification', compact('title'));
    })->name('notification');

});

// Grup Rute untuk Dosen
Route::prefix('dosen')->middleware('role:dosen')->name('dosen.')->group(function () {
    // Dashboard Dosen
    Route::get('/dashboard', function () {
        $title = 'Dashboard Dosen';
        return view('dosen.dashboard', compact('title'));
    })->name('dashboard');
});

// Grup Rute untuk Mahasiswa
Route::prefix('mahasiswa')->middleware('role:mahasiswa')->name('mahasiswa.')->group(function () {
    // Dashboard Mahasiswa
    Route::get('/dashboard', function () {
        $title = 'Dashboard Mahasiswa';
        return view('mahasiswa.dashboard', compact('title'));
    })->name('dashboard');
});

// Rute Generate Jadwal
Route::get('/generate', [GenerateController::class, 'generateJadwal']);

    