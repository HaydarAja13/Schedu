<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\EnrollmentMkMhsDsnRng;
use App\Models\JamAwal;
use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\ProgramStudi;
use App\Models\EnrollmentKelas;

class GenerateController extends Controller
{
    public function generateJadwal(Request $request)
    {
        // Mulai tracking waktu eksekusi
        $startTime = microtime(true);

        // Atur batas waktu eksekusi menjadi 5 menit (300 detik)
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        $request->validate([
            'id_kelompok_prodi' => 'required|exists:kelompok_prodi,id',
        ]);

        $idKelompokProdi = $request->id_kelompok_prodi;
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        try {
            // Ambil semua prodi dalam kelompok ini
            $programStudiList = ProgramStudi::where('id_kelompok_prodi', $idKelompokProdi)->get();
            if ($programStudiList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada program studi dalam kelompok ini'], 400);
            }
            $prodiIDs = $programStudiList->pluck('id');

            // Ambil semua ruang milik kelompok prodi
            $ruangList = Ruang::where('id_kelompok_prodi', $idKelompokProdi)->get();
            if ($ruangList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada ruang tersedia untuk kelompok prodi ini'], 400);
            }

            // Ambil semua jam awal (dipakai untuk membentuk slot waktu)
            $jamAwalList = JamAwal::orderBy('id')->get();
            if ($jamAwalList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada jam tersedia'], 400);
            }

            // Ambil semua enrollment_kelas dari semua prodi
            $enrollmentKelasIDs = EnrollmentKelas::whereIn('id_program_studi', $prodiIDs)->pluck('id');

            // Ambil data enrollment mata kuliah - mahasiswa - dosen - ruang
            $enrollments = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'dosen', 'enrollmentKelas'])
                ->whereIn('id_enrollment_kelas', $enrollmentKelasIDs)
                ->get()
                ->sortByDesc(function ($e) {
                    return $e->mataKuliah->jam ?? 0;
                });

            // Hapus jadwal lama yang terkait prodi-prodi tersebut
            Jadwal::whereHas('enrollmentMkMhsDsnRng.enrollmentKelas', function ($q) use ($prodiIDs) {
                $q->whereIn('id_program_studi', $prodiIDs);
            })->delete();

            // Inisialisasi matriks jadwal
            $scheduleMatrix = $this->initializeScheduleMatrix($days, $jamAwalList, $ruangList);
            $dosenSchedule = [];
            $kelasSchedule = [];
            $failedPlacements = [];
            $successPlacements = [];
            $successCount = 0;

            foreach ($enrollments as $enrollment) {
                try {
                    $placementResult = $this->placeEnrollment(
                        $enrollment,
                        $days,
                        $ruangList,
                        $jamAwalList,
                        $scheduleMatrix,
                        $dosenSchedule,
                        $kelasSchedule
                    );

                    if ($placementResult['success']) {
                        $successCount++;
                        $successPlacements[] = [
                            'id' => $enrollment->id,
                            'mata_kuliah' => $enrollment->mataKuliah->nama_matkul ?? 'N/A',
                            'dosen' => $enrollment->dosen->nama_dosen ?? 'N/A',
                            'kelas' => $enrollment->enrollmentKelas->kelas->nama_kelas ?? 'N/A',
                            'jadwal' => $placementResult['jadwal']
                        ];
                    } else {
                        $failedPlacements[] = [
                            'id' => $enrollment->id,
                            'mata_kuliah' => $enrollment->mataKuliah->nama_matkul ?? 'N/A',
                            'dosen' => $enrollment->dosen->nama_dosen ?? 'N/A',
                            'kelas' => $enrollment->kelas->enrollmentKelas->nama_kelas ?? 'N/A',
                            'reason' => $placementResult['reason'] ?? 'Tidak ada slot tersedia'
                        ];
                    }
                } catch (\Throwable $e) {
                    $failedPlacements[] = [
                        'id' => $enrollment->id,
                        'mata_kuliah' => $enrollment->mataKuliah->nama_matkul ?? 'N/A',
                        'dosen' => $enrollment->dosen->nama_dosen ?? 'N/A',
                        'kelas' => $enrollment->enrollmentKelas->kelas->nama_kelas ?? 'N/A',
                        'reason' => 'Error: ' . $e->getMessage()
                    ];
                    Log::error('Error placing enrollment: ' . $e->getMessage(), [
                        'enrollment_id' => $enrollment->id
                    ]);
                }
            }

            $executionTime = round(microtime(true) - $startTime, 2);

            // Siapkan data untuk response dan JSON file
            $responseData = [
                'success' => true,
                'timestamp' => now()->toDateTimeString(),
                'kelompok_prodi_id' => $idKelompokProdi,
                'program_studi' => $programStudiList->map(function ($prodi) {
                    return [
                        'id' => $prodi->id,
                        'nama' => $prodi->nama_prodi ?? 'N/A'
                    ];
                })->toArray(),
                'statistics' => [
                    'total_enrollments' => $enrollments->count(),
                    'jumlah_jadwal_berhasil' => $successCount,
                    'jumlah_gagal' => count($failedPlacements),
                    'success_rate' => $enrollments->count() > 0 ? round(($successCount / $enrollments->count()) * 100, 2) : 0,
                    'waktu_eksekusi' => "{$executionTime} detik"
                ],
                'berhasil_ditempatkan' => $successPlacements,
                'gagal_ditempatkan' => $failedPlacements,
                'resources' => [
                    'total_ruang' => $ruangList->count(),
                    'total_jam_slot' => $jamAwalList->count(),
                    'total_hari' => count($days)
                ]
            ];

            // Simpan ke file JSON
            $jsonResult = $this->saveToJsonFile($responseData, $idKelompokProdi);

            // Tambahkan info file ke response
            $responseData['file_info'] = $jsonResult;

            return response()->json($responseData);

        } catch (\Exception $e) {
            Log::error('Error in generateJadwal: ' . $e->getMessage(), [
                'kelompok_prodi_id' => $idKelompokProdi,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat generate jadwal',
                'message' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }

    /**
     * Simpan data ke file JSON
     */
    private function saveToJsonFile($data, $idKelompokProdi)
    {
        try {
            // Buat nama file unik dengan timestamp
            $timestamp = now()->format('Y-m-d_H-i-s');
            $fileName = "jadwal_kelompok_{$idKelompokProdi}_{$timestamp}.json";
            $filePath = "jadwal/{$fileName}";

            // Pastikan direktori ada
            if (!Storage::exists('jadwal')) {
                Storage::makeDirectory('jadwal');
            }

            // Convert data ke JSON dengan format yang rapi
            $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            if ($jsonContent === false) {
                throw new \Exception('Gagal convert data ke JSON: ' . json_last_error_msg());
            }

            // Simpan file
            $saved = Storage::put($filePath, $jsonContent);

            if (!$saved) {
                throw new \Exception('Gagal menyimpan file ke storage');
            }

            // Cek apakah file benar-benar tersimpan
            if (!Storage::exists($filePath)) {
                throw new \Exception('File tidak ditemukan setelah penyimpanan');
            }

            $fileSize = Storage::size($filePath);

            Log::info("File JSON berhasil dibuat", [
                'file_path' => $filePath,
                'file_size' => $fileSize,
                'kelompok_prodi_id' => $idKelompokProdi
            ]);

            return [
                'saved' => true,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => $fileSize,
                'full_path' => storage_path('app/' . $filePath),
                'download_url' => route('download.jadwal', ['filename' => $fileName]),
                'created_at' => now()->toDateTimeString()
            ];

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan file JSON: ' . $e->getMessage(), [
                'kelompok_prodi_id' => $idKelompokProdi,
                'error_trace' => $e->getTraceAsString()
            ]);

            return [
                'saved' => false,
                'error' => $e->getMessage(),
                'attempted_path' => $filePath ?? 'N/A'
            ];
        }
    }

    /**
     * Method untuk download file JSON (tambahkan route untuk ini)
     */
    public function downloadJadwal($filename)
    {
        try {
            $filePath = "jadwal/{$filename}";

            if (!Storage::exists($filePath)) {
                return response()->json(['error' => 'File tidak ditemukan'], 404);
            }

            return Storage::download($filePath, $filename, [
                'Content-Type' => 'application/json',
            ]);

        } catch (\Exception $e) {
            Log::error('Error download file: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal download file'], 500);
        }
    }

    /**
     * Validasi foreign key sebelum insert
     */
    private function validateForeignKeys($enrollmentId, $jamAwalId, $jamAkhirId, $ruangId)
    {
        // Cek apakah enrollment exists
        if (!EnrollmentMkMhsDsnRng::find($enrollmentId)) {
            return false;
        }

        // Cek apakah jam awal exists
        if (!JamAwal::find($jamAwalId)) {
            return false;
        }

        // Cek apakah jam akhir exists
        if (!JamAwal::find($jamAkhirId)) {
            return false;
        }

        // Cek apakah ruang exists
        if (!Ruang::find($ruangId)) {
            return false;
        }

        return true;
    }

    /**
     * Rollback marking slot jika terjadi error
     */
    private function rollbackSlotMarking($hari, $idRuang, $slotJam, &$scheduleMatrix, &$dosenSchedule, &$kelasSchedule, $idDosen, $idKelas)
    {
        // Rollback ruang marking
        foreach ($slotJam as $jam) {
            $scheduleMatrix[$hari][$idRuang][$jam->id] = false;
        }

        // Rollback dosen marking
        if (isset($dosenSchedule[$idDosen][$hari])) {
            foreach ($slotJam as $jam) {
                $key = array_search($jam->id, $dosenSchedule[$idDosen][$hari]);
                if ($key !== false) {
                    unset($dosenSchedule[$idDosen][$hari][$key]);
                }
            }
        }

        // Rollback kelas marking
        if (isset($kelasSchedule[$idKelas][$hari])) {
            foreach ($slotJam as $jam) {
                $key = array_search($jam->id, $kelasSchedule[$idKelas][$hari]);
                if ($key !== false) {
                    unset($kelasSchedule[$idKelas][$hari][$key]);
                }
            }
        }
    }

    /**
     * Inisialisasi matrix untuk tracking jadwal
     */
    private function initializeScheduleMatrix($days, $jamAwalList, $ruangList)
    {
        $matrix = [];
        foreach ($days as $day) {
            $matrix[$day] = [];
            foreach ($ruangList as $ruang) {
                $matrix[$day][$ruang->id] = [];
                foreach ($jamAwalList as $jam) {
                    $matrix[$day][$ruang->id][$jam->id] = false; // false = available
                }
            }
        }
        return $matrix;
    }

    /**
     * Tempatkan enrollment ke jadwal
     */
    private function placeEnrollment($enrollment, $days, $ruangList, $jamAwalList, &$scheduleMatrix, &$dosenSchedule, &$kelasSchedule)
    {
        // Validasi data enrollment terlebih dahulu
        if (!$enrollment || !$enrollment->mataKuliah || !$enrollment->id_dosen || !$enrollment->id_enrollment_kelas) {
            return [
                'success' => false,
                'reason' => 'Data enrollment tidak lengkap'
            ];
        }

        $durasi = $enrollment->mataKuliah->jam ?? 1;
        $idDosen = $enrollment->id_dosen;
        $idKelas = $enrollment->id_enrollment_kelas;

        // Validasi durasi
        if ($durasi <= 0 || $durasi > count($jamAwalList)) {
            return [
                'success' => false,
                'reason' => "Durasi tidak valid: {$durasi}"
            ];
        }

        // Coba setiap hari berurutan (bukan random)
        foreach ($days as $hari) {
            // Coba setiap ruang berurutan
            foreach ($ruangList as $ruang) {
                // Validasi ruang
                if (!$ruang || !$ruang->id) {
                    continue;
                }

                // Coba setiap slot jam berurutan (prioritas jam awal)
                for ($i = 0; $i <= count($jamAwalList) - $durasi; $i++) {
                    $slotJam = $jamAwalList->slice($i, $durasi);
                    $jamAwal = $slotJam->first();
                    $jamAkhir = $slotJam->last();

                    // Validasi jam
                    if (!$jamAwal || !$jamAkhir || !$jamAwal->id || !$jamAkhir->id) {
                        continue;
                    }

                    // Cek apakah slot ini available
                    if ($this->isSlotAvailable($hari, $ruang->id, $slotJam, $scheduleMatrix, $dosenSchedule, $kelasSchedule, $idDosen, $idKelas)) {

                        // Double check foreign key existence sebelum insert
                        if (!$this->validateForeignKeys($enrollment->id, $jamAwal->id, $jamAkhir->id, $ruang->id)) {
                            continue;
                        }

                        try {
                            // Tandai slot sebagai terpakai
                            $this->markSlotAsUsed($hari, $ruang->id, $slotJam, $scheduleMatrix, $dosenSchedule, $kelasSchedule, $idDosen, $idKelas);

                            // Buat jadwal dengan try-catch
                            $jadwal = Jadwal::create([
                                'id_enrollment_mk_mhs_dsn_rng' => $enrollment->id,
                                'hari' => $hari,
                                'id_jam_awal' => $jamAwal->id,
                                'id_jam_akhir' => $jamAkhir->id,
                                'id_ruang' => $ruang->id,
                            ]);

                            return [
                                'success' => true,
                                'jadwal' => [
                                    'id' => $jadwal->id,
                                    'hari' => $hari,
                                    'jam_awal' => $jamAwal->keterangan ?? 'N/A',
                                    'jam_akhir' => $jamAkhir->keterangan ?? 'N/A',
                                    'ruang' => $ruang->nama_ruang ?? 'N/A',
                                    'durasi' => $durasi
                                ]
                            ];

                        } catch (\Exception $e) {
                            // Rollback marking jika gagal insert
                            $this->rollbackSlotMarking($hari, $ruang->id, $slotJam, $scheduleMatrix, $dosenSchedule, $kelasSchedule, $idDosen, $idKelas);

                            // Log error untuk debugging
                            Log::error('Gagal membuat jadwal: ' . $e->getMessage(), [
                                'enrollment_id' => $enrollment->id,
                                'hari' => $hari,
                                'jam_awal' => $jamAwal->id,
                                'jam_akhir' => $jamAkhir->id,
                                'ruang' => $ruang->id
                            ]);

                            continue; // Coba slot berikutnya
                        }
                    }
                }
            }
        }

        return [
            'success' => false,
            'reason' => 'Tidak ada slot tersedia untuk semua kombinasi hari, ruang, dan waktu'
        ]; // Tidak berhasil ditempatkan
    }

    /**
     * Cek apakah slot tersedia
     */
    private function isSlotAvailable($hari, $idRuang, $slotJam, $scheduleMatrix, $dosenSchedule, $kelasSchedule, $idDosen, $idKelas)
    {
        // Cek bentrok ruang
        foreach ($slotJam as $jam) {
            if ($scheduleMatrix[$hari][$idRuang][$jam->id]) {
                return false; // Ruang sudah terpakai
            }
        }

        // Cek bentrok dosen
        if (isset($dosenSchedule[$idDosen][$hari])) {
            foreach ($slotJam as $jam) {
                if (in_array($jam->id, $dosenSchedule[$idDosen][$hari])) {
                    return false; // Dosen sudah mengajar
                }
            }
        }

        // Cek bentrok kelas
        if (isset($kelasSchedule[$idKelas][$hari])) {
            foreach ($slotJam as $jam) {
                if (in_array($jam->id, $kelasSchedule[$idKelas][$hari])) {
                    return false; // Kelas sudah ada jadwal
                }
            }
        }

        return true;
    }

    /**
     * Tandai slot sebagai terpakai
     */
    private function markSlotAsUsed($hari, $idRuang, $slotJam, &$scheduleMatrix, &$dosenSchedule, &$kelasSchedule, $idDosen, $idKelas)
    {
        // Tandai ruang sebagai terpakai
        foreach ($slotJam as $jam) {
            $scheduleMatrix[$hari][$idRuang][$jam->id] = true;
        }

        // Tandai dosen sebagai terpakai
        if (!isset($dosenSchedule[$idDosen])) {
            $dosenSchedule[$idDosen] = [];
        }
        if (!isset($dosenSchedule[$idDosen][$hari])) {
            $dosenSchedule[$idDosen][$hari] = [];
        }
        foreach ($slotJam as $jam) {
            $dosenSchedule[$idDosen][$hari][] = $jam->id;
        }

        // Tandai kelas sebagai terpakai
        if (!isset($kelasSchedule[$idKelas])) {
            $kelasSchedule[$idKelas] = [];
        }
        if (!isset($kelasSchedule[$idKelas][$hari])) {
            $kelasSchedule[$idKelas][$hari] = [];
        }
        foreach ($slotJam as $jam) {
            $kelasSchedule[$idKelas][$hari][] = $jam->id;
        }
    }
}