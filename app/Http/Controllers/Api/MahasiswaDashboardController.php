<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentMahasiswaKelas;
use App\Models\EnrollmentMkMhsDsnRng;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Mahasiswa;

class MahasiswaDashboardController extends Controller
{
    public function index() {
        $mahasiswa = request()->session()->get('user');

        if (!$mahasiswa) {
            return redirect('/login')->withErrors('Anda harus login sebagai mahasiswa.');
        }

        $mahasiswaDetail = Mahasiswa::with(['kelas', 
        'enrollmentMahasiswaKelas', 
        'enrollmentMahasiswaKelas.EnrollmentMkMhsDsnRng',
        'enrollmentMahasiswaKelas.enrollmentKelas.programStudi',
        'enrollmentMahasiswaKelas.enrollmentKelas.kelas',
        'enrollmentMahasiswaKelas.enrollmentKelas.angkatan',
        ])->find($mahasiswa->id);
        
        $jumlahMataKuliah = $mahasiswaDetail->enrollmentMahasiswaKelas[0]->enrollmentMkMhsDsnRng->count();
        
        $idEnrollmentKelas = $mahasiswaDetail->enrollmentMahasiswaKelas[0]->id_enrollment_kelas;
        $jumlahTemanSekelas = EnrollmentMahasiswaKelas::where('id_enrollment_kelas', $idEnrollmentKelas)->count();

        $jumlahDosen = EnrollmentMkMhsDsnRng::where('id_enrollment_kelas', $idEnrollmentKelas)->get()->count();
        return view('mahasiswa.dashboard', [
            'mahasiswa' => $mahasiswa,
            'jumlahMataKuliah' => $jumlahMataKuliah,
            'jumlahTemanSekelas' => $jumlahTemanSekelas,
            'jumlahDosen' => $jumlahDosen,
        ]);
    }
}