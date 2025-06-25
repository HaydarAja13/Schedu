<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentMahasiswaKelas;
use App\Models\EnrollmentMkMhsDsnRng;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Dosen;

class DosenDashboardController extends Controller
{
    public function index(Request $request)
    {
        $dosen = $request->session()->get('user');

        if (!$dosen) {
            return redirect('/login')->withErrors('Anda harus login sebagai dosen.');
        }

        // Ambil semua id_enrollment_kelas yang diampu dosen
        $enrollmentKelasIds = EnrollmentMkMhsDsnRng::where('id_dosen', $dosen->id)
            ->pluck('id_enrollment_kelas')
            ->unique();

        // Jumlah mahasiswa unik dari semua kelas yang diampu dosen
        $jumlahMahasiswa = EnrollmentMahasiswaKelas::whereIn('id_enrollment_kelas', $enrollmentKelasIds)
            ->distinct('id_mahasiswa')
            ->count('id_mahasiswa');

        // Jumlah mata kuliah unik
        $jumlahMataKuliah = EnrollmentMkMhsDsnRng::where('id_dosen', $dosen->id)
            ->distinct('id_mata_kuliah')
            ->count('id_mata_kuliah');

        // Jumlah kelas unik
        $jumlahKelas = $enrollmentKelasIds->count();

        // Jam mengajar (isi sesuai kebutuhan)
        $jamMengajar = 0;

        return view('dosen.dashboard', [
            'dosen' => $dosen,
            'jumlahMataKuliah' => $jumlahMataKuliah,
            'jumlahKelas' => $jumlahKelas,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jamMengajar' => $jamMengajar,
        ]);
    }
}