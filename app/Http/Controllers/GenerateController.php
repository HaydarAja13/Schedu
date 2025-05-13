<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnrollmentMkMhsDsnRng;
use App\Models\JamAwal;
use App\Models\JamAkhir;
use App\Models\Jadwal;
use App\Models\Ruang;

class GenerateController extends Controller
{
    public function generateJadwal()
    {
        // Step 1: Ambil data dari tabel terkait
        $enrollments = EnrollmentMkMhsDsnRng::all();
        $jamAwal = JamAwal::all()->sortBy('nama_jam');
        $jamAkhir = JamAkhir::all()->sortBy('nama_jam');
        $ruangs = Ruang::all();

        // Variabel untuk menyimpan hasil jadwal
        $jadwalResult = [];

        // Step 2: Algoritma penjadwalan dengan tambahan ruang
        foreach ($enrollments as $enrollment) {
            foreach ($jamAwal as $start) {
                foreach ($jamAkhir as $end) {
                    if ($end->nama_jam > $start->nama_jam) {
                        // Cek apakah waktu atau ruang bentrok
                        $isConflicted = false;
                        $selectedRuang = null;

                        foreach ($ruangs as $ruang) {
                            $isConflicted = false; // Reset konflik per ruang
                            foreach ($jadwalResult as $jadwal) {
                                if (
                                    ($jadwal['id_jam_awal'] == $start->id || $jadwal['id_jam_akhir'] == $end->id) &&
                                    $jadwal['id_ruang'] == $ruang->id
                                ) {
                                    $isConflicted = true;
                                    break;
                                }
                            }
                            if (!$isConflicted) {
                                $selectedRuang = $ruang;
                                break;
                            }
                        }

                        if (!$isConflicted && $selectedRuang) {
                            // Tambahkan ke hasil jadwal
                            $jadwalResult[] = [
                                'id_enrollment_mk_mhs_dsn_rng' => $enrollment->id,
                                'hari' => 'Senin', // Ubah sesuai logika Anda
                                'id_jam_awal' => $start->id,
                                'id_jam_akhir' => $end->id,
                                'id_ruang' => $selectedRuang->id,
                            ];
                            break;
                        }
                    }
                }
            }
        }

        // Step 3: Simpan hasil ke tabel `jadwal`
        foreach ($jadwalResult as $jadwal) {
            Jadwal::create($jadwal);
        }

        return response()->json(['message' => 'Jadwal berhasil digenerate!', 'data' => $jadwalResult]);
    }
}
