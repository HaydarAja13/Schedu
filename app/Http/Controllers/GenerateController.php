<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\EnrollmentMkMhsDsnRng;
use App\Models\JamAwal;
use App\Models\Jadwal;
use App\Models\Ruang;

class GenerateController extends Controller
{
    public function generateJadwal()
    {

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        $jamAwalList = JamAwal::orderBy('id')->get();
        $ruangList = Ruang::all();
        $enrollments = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'dosen', 'enrollmentKelas'])->get();

        Jadwal::truncate();

        foreach ($enrollments as $enrollment) {
            $placed = false;
            $max_attempts = 1000;
            $attempts = 0;

            $durasi = $enrollment->mataKuliah->jam;

            while (!$placed && $attempts < $max_attempts) {
                $hari = $days[array_rand($days)];
                $ruang = $ruangList->random();

                for ($i = 0; $i <= count($jamAwalList) - $durasi; $i++) {
                    $slotJam = $jamAwalList->slice($i, $durasi);
                    $jamAwal = $slotJam->first();
                    $jamAkhir = $slotJam->last();

                    $id_enrollment_kelas = $enrollment->id_enrollment_kelas;

                    $bentrok = Jadwal::where('hari', $hari)
                        ->where(function ($q) use ($jamAwal, $jamAkhir) {
                            $q->where(function ($q2) use ($jamAwal, $jamAkhir) {
                                $q2->where('id_jam_awal', '<=', $jamAkhir->id)
                                    ->where('id_jam_awal', '>=', $jamAwal->id);
                            })
                                ->orWhere(function ($q2) use ($jamAwal, $jamAkhir) {
                                    $q2->where('id_jam_akhir', '<=', $jamAkhir->id)
                                        ->where('id_jam_akhir', '>=', $jamAwal->id);
                                });
                        })
                        ->where(function ($q) use ($ruang, $enrollment, $id_enrollment_kelas) {
                            $q->where('id_ruang', $ruang->id)
                                ->orWhereHas('enrollmentMkMhsDsnRng', function ($q2) use ($enrollment, $id_enrollment_kelas) {
                                    $q2->where('id_dosen', $enrollment->id_dosen)
                                        ->orWhere('id_enrollment_kelas', $id_enrollment_kelas);
                                });
                        })
                        ->exists();

                    if (!$bentrok) {
                        Jadwal::create([
                            'id_enrollment_mk_mhs_dsn_rng' => $enrollment->id,
                            'hari' => $hari,
                            'id_jam_awal' => $jamAwal->id,
                            'id_jam_akhir' => $jamAkhir->id,
                            'id_ruang' => $ruang->id,
                        ]);
                        $placed = true;
                        break;
                    }
                }
                $attempts++;
            }
        }

        $jadwal = Jadwal::with([
            'enrollmentMkMhsDsnRng.mataKuliah',
            'enrollmentMkMhsDsnRng.dosen',
            'enrollmentMkMhsDsnRng.enrollmentKelas',
            'ruang',
            'jamAwal',
            'jamAkhir'
        ])->get();

        Storage::disk('local')->put('jadwal.json', $jadwal->toJson());

        return response()->json([
            'message' => 'Jadwal berhasil digenerate!',
            'data' => $jadwal
        ]);
    }
}
