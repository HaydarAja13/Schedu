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
use Illuminate\Support\Collection;

class GenerateController extends Controller
{
    private const MAX_JAM_PER_HARI_PER_KELAS = 8;
    private const MAX_EXECUTION_TIME = 360; // 6 menit
    private const MAX_ITERATIONS = 20000;
    private const MAX_BACKTRACKS = 2000;

    private $scheduleMatrix;
    private $dosenSchedule;
    private $kelasSchedule;
    private $jamAwalList;
    private $ruangList;
    private $days;
    private $backtrackCount = 0;
    private $retryQueue = [];

    public function generateJadwal(Request $request)
    {
        $startTime = microtime(true);
        set_time_limit(self::MAX_EXECUTION_TIME);
        ini_set('memory_limit', '512M');

        $request->validate([
            'id_kelompok_prodi' => 'required|exists:kelompok_prodi,id',
        ]);

        $idKelompokProdi = $request->id_kelompok_prodi;
        $this->days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        try {
            // Inisialisasi data
            $programStudiList = ProgramStudi::where('id_kelompok_prodi', $idKelompokProdi)->get();
            if ($programStudiList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada program studi dalam kelompok ini'], 400);
            }
            $prodiIDs = $programStudiList->pluck('id');

            $this->ruangList = Ruang::where('id_kelompok_prodi', $idKelompokProdi)->get();
            if ($this->ruangList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada ruang tersedia untuk kelompok prodi ini'], 400);
            }

            $this->jamAwalList = JamAwal::orderBy('id')->get();
            if ($this->jamAwalList->isEmpty()) {
                return response()->json(['error' => 'Tidak ada jam tersedia'], 400);
            }

            // Debug: Log jam data untuk kelompok prodi ini
            Log::debug('Jam Awal Data for Kelompok Prodi ' . $idKelompokProdi, [
                'count' => $this->jamAwalList->count(),
                'sample' => $this->jamAwalList->take(5)->toArray()
            ]);

            $enrollmentKelasIDs = EnrollmentKelas::whereIn('id_program_studi', $prodiIDs)->pluck('id');

            // Dapatkan enrollments dengan prioritas yang lebih baik
            $enrollments = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'dosen', 'enrollmentKelas.programStudi', 'enrollmentKelas.kelas'])
                ->whereIn('id_enrollment_kelas', $enrollmentKelasIDs)
                ->get()
                ->sortByDesc(function ($e) {
                    $priority = $e->mataKuliah->jam ?? 0;
                    $priority += optional($e->dosen)->enrollments ? count($e->dosen->enrollments) * 0.1 : 0;
                    $priority += optional($e->enrollmentKelas)->enrollments ? count($e->enrollmentKelas->enrollments) * 0.1 : 0;
                    return $priority;
                });

            // Hapus jadwal lama
            Jadwal::whereHas('enrollmentMkMhsDsnRng.enrollmentKelas', fn($q) => $q->whereIn('id_program_studi', $prodiIDs))->delete();

            $this->initializeScheduleMatrix();

            $placements = [];
            $failedPlacements = [];
            $iteration = 0;
            $maxRetries = 3;

            // Fase pertama - coba tempatkan semua jadwal
            foreach ($enrollments as $enrollment) {
                $placementResult = $this->findAndPlaceBestSlot($enrollment, false);

                if ($placementResult['success']) {
                    $placements[] = $this->formatSuccessOutput($enrollment, $placementResult['jadwal']);
                } else {
                    $this->retryQueue[] = $enrollment;
                }

                $iteration++;
                if ((microtime(true) - $startTime) > self::MAX_EXECUTION_TIME)
                    break;
            }

            // Fase kedua - coba tempatkan yang gagal dengan strategi berbeda
            $retryAttempt = 0;
            while (
                !empty($this->retryQueue) &&
                (microtime(true) - $startTime) < self::MAX_EXECUTION_TIME &&
                $iteration < self::MAX_ITERATIONS &&
                $retryAttempt < $maxRetries
            ) {
                $currentRetryQueue = $this->retryQueue;
                $this->retryQueue = [];

                foreach ($currentRetryQueue as $enrollment) {
                    $placementResult = $this->findAndPlaceBestSlot($enrollment, true);

                    if ($placementResult['success']) {
                        $placements[] = $this->formatSuccessOutput($enrollment, $placementResult['jadwal']);
                    } else {
                        $this->retryQueue[] = $enrollment;
                    }

                    $iteration++;
                    if ((microtime(true) - $startTime) > self::MAX_EXECUTION_TIME)
                        break 2;
                }
                $retryAttempt++;
            }

            // Fase ketiga - coba dengan backtracking untuk yang masih gagal
            if (!empty($this->retryQueue) && $this->backtrackCount < self::MAX_BACKTRACKS) {
                foreach ($this->retryQueue as $key => $enrollment) {
                    $backtrackResult = $this->tryBacktrackPlacement($enrollment, $placements, $enrollments);

                    if ($backtrackResult['success']) {
                        $placements[] = $this->formatSuccessOutput($enrollment, $backtrackResult['jadwal']);
                        unset($this->retryQueue[$key]);
                    }

                    if ((microtime(true) - $startTime) > self::MAX_EXECUTION_TIME || $this->backtrackCount >= self::MAX_BACKTRACKS) {
                        break;
                    }
                }
            }

            // Format output untuk yang gagal
            if (!empty($this->retryQueue)) {
                $failedPlacements = array_map(function ($enrollment) {
                    return $this->formatFailedOutput($enrollment, 'Tidak ditemukan slot yang cocok setelah iterasi maksimum.');
                }, array_values($this->retryQueue));
            }

            $executionTime = round(microtime(true) - $startTime, 2);
            $responseData = $this->buildFinalResponse(
                $idKelompokProdi,
                $programStudiList,
                $enrollments->count(),
                $placements,
                $failedPlacements,
                $executionTime,
                $this->ruangList->count(),
                $this->jamAwalList->count(),
                count($this->days)
            );

            $jsonResult = $this->saveToJsonFile($responseData, $idKelompokProdi);
            $responseData['file_info'] = $jsonResult;

            return response()->json($responseData);

        } catch (\Exception $e) {
            Log::error('Error Kritis di generateJadwal: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'kelompok_prodi' => $idKelompokProdi
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan fatal saat generate jadwal',
                'message' => $e->getMessage(),
                'kelompok_prodi' => $idKelompokProdi
            ], 500);
        }
    }

    private function findAndPlaceBestSlot($enrollment, bool $isRetry = false)
    {
        if (!$enrollment?->mataKuliah || !$enrollment->id_dosen || !$enrollment->id_enrollment_kelas) {
            return ['success' => false, 'reason' => 'Data enrollment tidak lengkap'];
        }

        $durasi = $enrollment->mataKuliah->jam ?? 1;
        $idDosen = $enrollment->id_dosen;
        $idKelas = $enrollment->id_enrollment_kelas;

        if ($durasi <= 0 || $durasi > $this->jamAwalList->count()) {
            return ['success' => false, 'reason' => "Durasi tidak valid: {$durasi}. Harus antara 1 dan " . $this->jamAwalList->count()];
        }

        $bestSlot = null;
        $lowestCost = PHP_INT_MAX;

        $days = $isRetry ? $this->shuffleWithPriority($this->days) : $this->days;
        $ruangList = $isRetry ? $this->shuffleWithPriority($this->ruangList) : $this->ruangList;

        foreach ($days as $hari) {
            foreach ($ruangList as $ruang) {
                for ($i = 0; $i <= $this->jamAwalList->count() - $durasi; $i++) {
                    $slotJam = $this->jamAwalList->slice($i, $durasi);

                    if ($this->isSlotAvailable($hari, $ruang->id, $slotJam, $idDosen, $idKelas, $durasi)) {
                        $currentCost = $this->calculateAdvancedSlotCost($hari, $slotJam, $idDosen, $idKelas, $durasi, $isRetry);

                        if ($currentCost < $lowestCost) {
                            $lowestCost = $currentCost;
                            $bestSlot = [
                                'hari' => $hari,
                                'ruang' => $ruang,
                                'slotJam' => $slotJam,
                                'jamAwal' => $slotJam->first(),
                                'jamAkhir' => $slotJam->last()
                            ];
                        }
                    }
                }
            }
        }

        if ($bestSlot) {
            try {
                $this->markSlotAsUsed($bestSlot['hari'], $bestSlot['ruang']->id, $bestSlot['slotJam'], $idDosen, $idKelas, $durasi);

                $jadwal = Jadwal::create([
                    'id_enrollment_mk_mhs_dsn_rng' => $enrollment->id,
                    'hari' => $bestSlot['hari'],
                    'id_jam_awal' => $bestSlot['jamAwal']->id,
                    'id_jam_akhir' => $bestSlot['jamAkhir']->id,
                    'id_ruang' => $bestSlot['ruang']->id,
                ]);

                return [
                    'success' => true,
                    'jadwal' => [
                        'id' => $jadwal->id,
                        'hari' => $bestSlot['hari'],
                        'jam_awal' => $bestSlot['jamAwal']->keterangan,
                        'jam_akhir' => $bestSlot['jamAkhir']->keterangan,
                        'id_jam_awal' => $bestSlot['jamAwal']->id,
                        'id_jam_akhir' => $bestSlot['jamAkhir']->id,
                        'ruang' => $bestSlot['ruang']->nama_ruang,
                        'durasi' => $durasi
                    ]
                ];
            } catch (\Exception $e) {
                Log::error('Gagal membuat jadwal setelah menemukan slot terbaik: ' . $e->getMessage());
                return ['success' => false, 'reason' => 'Error saat menyimpan jadwal: ' . $e->getMessage()];
            }
        }

        return ['success' => false, 'reason' => 'Tidak ada slot tersedia yang memenuhi semua kriteria'];
    }

    private function tryBacktrackPlacement($enrollment, &$placements, Collection $enrollments)
    {
        $this->backtrackCount++;

        $durasi = $enrollment->mataKuliah->jam ?? 1;
        $idDosen = $enrollment->id_dosen;
        $idKelas = $enrollment->id_enrollment_kelas;

        if ($durasi <= 0 || $durasi > $this->jamAwalList->count()) {
            return ['success' => false, 'reason' => "Durasi tidak valid: {$durasi}"];
        }

        foreach ($this->days as $hari) {
            foreach ($this->ruangList as $ruang) {
                for ($i = 0; $i <= $this->jamAwalList->count() - $durasi; $i++) {
                    $slotJam = $this->jamAwalList->slice($i, $durasi);
                    $conflicts = $this->findConflicts($hari, $ruang->id, $slotJam, $idDosen, $idKelas);

                    if (count($conflicts) > 0 && $this->canRescheduleConflicts($conflicts)) {
                        if ($this->rescheduleConflicts($conflicts, $placements, $enrollments)) {
                            if ($this->isSlotAvailable($hari, $ruang->id, $slotJam, $idDosen, $idKelas, $durasi)) {
                                $this->markSlotAsUsed($hari, $ruang->id, $slotJam, $idDosen, $idKelas, $durasi);

                                $jadwal = Jadwal::create([
                                    'id_enrollment_mk_mhs_dsn_rng' => $enrollment->id,
                                    'hari' => $hari,
                                    'id_jam_awal' => $slotJam->first()->id,
                                    'id_jam_akhir' => $slotJam->last()->id,
                                    'id_ruang' => $ruang->id,
                                ]);

                                return [
                                    'success' => true,
                                    'jadwal' => [
                                        'id' => $jadwal->id,
                                        'hari' => $hari,
                                        'jam_awal' => $slotJam->first()->keterangan,
                                        'jam_akhir' => $slotJam->last()->keterangan,
                                        'id_jam_awal' => $slotJam->first()->id,
                                        'id_jam_akhir' => $slotJam->last()->id,
                                        'ruang' => $ruang->nama_ruang,
                                        'durasi' => $durasi
                                    ]
                                ];
                            }
                        }
                    }
                }
            }
        }

        return ['success' => false, 'reason' => 'Tidak bisa menemukan slot bahkan dengan backtracking'];
    }

    private function findConflicts($hari, $idRuang, $slotJam, $idDosen, $idKelas)
    {
        $conflicts = [];

        foreach ($slotJam as $jam) {
            $jamId = $jam->id;
            if (!empty($this->scheduleMatrix[$hari][$idRuang][$jamId])) {
                $conflicts[] = ['type' => 'ruang', 'hari' => $hari, 'id_ruang' => $idRuang, 'jam_id' => $jamId];
            }
            if (!empty($this->dosenSchedule[$idDosen][$hari]) && in_array($jamId, $this->dosenSchedule[$idDosen][$hari])) {
                $conflicts[] = ['type' => 'dosen', 'hari' => $hari, 'id_dosen' => $idDosen, 'jam_id' => $jamId];
            }
            if (!empty($this->kelasSchedule[$idKelas][$hari]['slots']) && in_array($jamId, $this->kelasSchedule[$idKelas][$hari]['slots'])) {
                $conflicts[] = ['type' => 'kelas', 'hari' => $hari, 'id_kelas' => $idKelas, 'jam_id' => $jamId];
            }
        }
        return array_unique($conflicts, SORT_REGULAR);
    }

    private function canRescheduleConflicts($conflicts)
    {
        return count($conflicts) > 0 && count($conflicts) <= 2;
    }

    private function rescheduleConflicts($conflicts, &$placements, Collection $enrollments)
    {
        $rescheduled = false;
        foreach ($conflicts as $conflict) {
            if ($conflict['type'] === 'ruang') {
                foreach ($placements as $key => $placement) {
                    if (
                        $placement['jadwal']['hari'] === $conflict['hari'] &&
                        $this->ruangList->firstWhere('nama_ruang', $placement['jadwal']['ruang'])->id == $conflict['id_ruang'] &&
                        $this->isJamInRange($conflict['jam_id'], $placement['jadwal']['id_jam_awal'], $placement['jadwal']['id_jam_akhir'])
                    ) {
                        $jamAwalObj = $this->jamAwalList->firstWhere('id', $placement['jadwal']['id_jam_awal']);
                        $jamAkhirObj = $this->jamAwalList->firstWhere('id', $placement['jadwal']['id_jam_akhir']);

                        if (!$jamAwalObj || !$jamAkhirObj)
                            continue;

                        $this->clearSlotFromMatrix(
                            $placement['jadwal']['hari'],
                            $conflict['id_ruang'],
                            $jamAwalObj,
                            $jamAkhirObj,
                            $placement['id_dosen'],
                            $placement['id_kelas']
                        );

                        Jadwal::where('id', $placement['jadwal']['id'])->delete();

                        $enrollmentToReschedule = $enrollments->firstWhere('id', $placement['id']);
                        if ($enrollmentToReschedule) {
                            unset($placements[$key]);
                            $this->retryQueue[] = $enrollmentToReschedule;
                            $rescheduled = true;
                        } else {
                            Log::warning("Enrollment to reschedule not found", ['id' => $placement['id']]);
                        }
                        break;
                    }
                }
            }
            // Implementasi serupa untuk jenis konflik dosen dan kelas jika diperlukan
        }
        return $rescheduled;
    }

    private function isJamInRange($jamId, $startId, $endId)
    {
        return $jamId >= $startId && $jamId <= $endId;
    }

    private function clearSlotFromMatrix($hari, $idRuang, $jamAwal, $jamAkhir, $idDosen, $idKelas)
    {
        $jamAwalId = is_object($jamAwal) ? $jamAwal->id : $jamAwal;
        $jamAkhirId = is_object($jamAkhir) ? $jamAkhir->id : $jamAkhir;

        if (!is_numeric($jamAwalId) || !is_numeric($jamAkhirId)) {
            Log::error('Invalid jam IDs in clearSlotFromMatrix', compact('hari', 'idRuang', 'jamAwal', 'jamAkhir', 'idDosen', 'idKelas'));
            return;
        }

        $jamIds = range($jamAwalId, $jamAkhirId);

        foreach ($jamIds as $jamId) {
            if (isset($this->scheduleMatrix[$hari][$idRuang][$jamId])) {
                $this->scheduleMatrix[$hari][$idRuang][$jamId] = false;
            }

            if (isset($this->dosenSchedule[$idDosen][$hari])) {
                $this->dosenSchedule[$idDosen][$hari] = array_diff($this->dosenSchedule[$idDosen][$hari], [$jamId]);
            }

            if (isset($this->kelasSchedule[$idKelas][$hari]['slots'])) {
                $this->kelasSchedule[$idKelas][$hari]['slots'] = array_diff($this->kelasSchedule[$idKelas][$hari]['slots'], [$jamId]);
                $this->kelasSchedule[$idKelas][$hari]['total_jam'] -= 1;
            }
        }
    }

    private function calculateAdvancedSlotCost($hari, $slotJam, $idDosen, $idKelas, $durasi, $isRetry)
    {
        $cost = 0;
        $dayIndex = array_search($hari, $this->days);
        if ($dayIndex !== false) {
            $cost += $isRetry ? ($dayIndex * 5) : ((count($this->days) - 1 - $dayIndex) * 10);
        }

        $jamMulaiId = $slotJam->first()->id;
        $jamAkhirId = $slotJam->last()->id;
        $totalJam = count($this->jamAwalList);

        if ($jamMulaiId <= 2)
            $cost += 10;
        elseif ($jamMulaiId <= 4)
            $cost += 5;
        if ($jamAkhirId >= $totalJam - 2)
            $cost += 10;
        elseif ($jamAkhirId >= $totalJam - 4)
            $cost += 5;

        $cost += ($this->dosenSchedule[$idDosen][$hari] ?? []) ? count($this->dosenSchedule[$idDosen][$hari]) * 2 : 0;
        $cost += ($this->kelasSchedule[$idKelas][$hari]['total_jam'] ?? 0) * 3;
        $cost += ($durasi - 1) * 5;

        return $cost;
    }

    private function shuffleWithPriority($items)
    {
        $itemsArray = is_array($items) ? $items : $items->all();
        $firstItems = array_slice($itemsArray, 0, 2);
        $restItems = array_slice($itemsArray, 2);
        shuffle($restItems);
        return array_merge($firstItems, $restItems);
    }

    private function isSlotAvailable($hari, $idRuang, $slotJam, $idDosen, $idKelas, $durasi)
    {
        $bebanJamSaatIni = $this->kelasSchedule[$idKelas][$hari]['total_jam'] ?? 0;
        if (($bebanJamSaatIni + $durasi) > self::MAX_JAM_PER_HARI_PER_KELAS) {
            return false;
        }

        foreach ($slotJam as $jam) {
            $jamId = $jam->id;
            if (!empty($this->scheduleMatrix[$hari][$idRuang][$jamId]))
                return false;
            if (!empty($this->dosenSchedule[$idDosen][$hari]) && in_array($jamId, $this->dosenSchedule[$idDosen][$hari]))
                return false;
            if (!empty($this->kelasSchedule[$idKelas][$hari]['slots']) && in_array($jamId, $this->kelasSchedule[$idKelas][$hari]['slots']))
                return false;
        }
        return true;
    }

    private function markSlotAsUsed($hari, $idRuang, $slotJam, $idDosen, $idKelas, $durasi)
    {
        if (!isset($this->dosenSchedule[$idDosen][$hari]))
            $this->dosenSchedule[$idDosen][$hari] = [];
        if (!isset($this->kelasSchedule[$idKelas][$hari]))
            $this->kelasSchedule[$idKelas][$hari] = ['total_jam' => 0, 'slots' => []];

        $this->kelasSchedule[$idKelas][$hari]['total_jam'] += $durasi;

        foreach ($slotJam as $jam) {
            $jamId = $jam->id;
            $this->scheduleMatrix[$hari][$idRuang][$jamId] = true;
            $this->dosenSchedule[$idDosen][$hari][] = $jamId;
            $this->kelasSchedule[$idKelas][$hari]['slots'][] = $jamId;
        }
    }

    private function initializeScheduleMatrix()
    {
        $this->scheduleMatrix = [];
        $this->dosenSchedule = [];
        $this->kelasSchedule = [];

        foreach ($this->days as $day) {
            $this->scheduleMatrix[$day] = [];
            foreach ($this->ruangList as $ruang) {
                $this->scheduleMatrix[$day][$ruang->id] = array_fill_keys($this->jamAwalList->pluck('id')->toArray(), false);
            }
        }
    }

    private function formatSuccessOutput($enrollment, $jadwalData)
    {
        $prodi = $enrollment->enrollmentKelas->programStudi;
        return [
            'id' => $enrollment->id,
            'mata_kuliah' => $enrollment->mataKuliah->nama_matkul ?? 'N/A',
            'dosen' => $enrollment->dosen->nama_dosen ?? 'N/A',
            'kelas_lengkap' => $this->getNamaKelasLengkap($enrollment),
            'program_studi' => $prodi->nama_prodi ?? 'N/A',
            'prodi_id' => $prodi->id ?? null,
            'id_dosen' => $enrollment->id_dosen,
            'id_kelas' => $enrollment->id_enrollment_kelas,
            'jadwal' => $jadwalData
        ];
    }

    private function formatFailedOutput($enrollment, $reason)
    {
        $prodi = $enrollment->enrollmentKelas->programStudi;
        return [
            'id' => $enrollment->id,
            'mata_kuliah' => $enrollment->mataKuliah->nama_matkul ?? 'N/A',
            'dosen' => $enrollment->dosen->nama_dosen ?? 'N/A',
            'kelas_lengkap' => $this->getNamaKelasLengkap($enrollment),
            'program_studi' => $prodi->nama_prodi ?? 'N/A',
            'prodi_id' => $prodi->id ?? null,
            'id_dosen' => $enrollment->id_dosen,
            'id_kelas' => $enrollment->id_enrollment_kelas,
            'reason' => $reason
        ];
    }

    private function buildFinalResponse($idKelompokProdi, $programStudiList, $totalEnrollments, $successPlacements, $failedPlacements, $executionTime, $totalRuang, $totalJamSlot, $totalHari)
    {
        return [
            'success' => true,
            'timestamp' => now()->toDateTimeString(),
            'kelompok_prodi_id' => $idKelompokProdi,
            'program_studi' => $programStudiList->map(fn($prodi) => ['id' => $prodi->id, 'nama' => $prodi->nama_prodi, 'kode' => $prodi->kode_prodi])->toArray(),
            'statistics' => [
                'total_enrollments' => $totalEnrollments,
                'jumlah_jadwal_berhasil' => count($successPlacements),
                'jumlah_gagal' => count($failedPlacements),
                'success_rate' => $totalEnrollments > 0 ? round((count($successPlacements) / $totalEnrollments) * 100, 2) : 0,
                'waktu_eksekusi' => "{$executionTime} detik"
            ],
            'berhasil_ditempatkan' => $successPlacements,
            'gagal_ditempatkan' => $failedPlacements,
            'resources' => ['total_ruang' => $totalRuang, 'total_jam_slot' => $totalJamSlot, 'total_hari' => $totalHari]
        ];
    }

    private function getNamaKelasLengkap($enrollment)
    {
        try {
            $kodeProdi = $enrollment->enrollmentKelas->programStudi->kode_prodi ?? 'N/A';
            $angkatan = substr(optional($enrollment->enrollmentKelas->angkatan)->tahun_angkatan ?? '0', -1);
            $namaKelas = $enrollment->enrollmentKelas->kelas->nama_kelas ?? 'N/A';
            return strtoupper($kodeProdi) . '-' . $angkatan . strtoupper($namaKelas);
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    private function saveToJsonFile($data, $idKelompokProdi)
    {
        try {
            $fileName = "jadwal_kelompok_{$idKelompokProdi}.json";
            $filePath = "jadwal/{$fileName}";

            if (!Storage::exists('jadwal')) {
                Storage::makeDirectory('jadwal');
            }

            Storage::put($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            return ['saved' => true, 'file_name' => $fileName, 'file_path' => storage_path("app/{$filePath}"), 'message' => 'File berhasil disimpan/diperbarui'];
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan file JSON: ' . $e->getMessage());
            return ['saved' => false, 'error' => $e->getMessage()];
        }
    }

    public function downloadJadwal($idKelompokProdi)
    {
        $fileName = "jadwal_kelompok_{$idKelompokProdi}.json";
        $filePath = "jadwal/{$fileName}";

        if (!Storage::exists($filePath)) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        return Storage::download($filePath);
    }
}