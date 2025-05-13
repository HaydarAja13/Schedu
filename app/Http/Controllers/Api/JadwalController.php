<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Jadwal::with(['enrollmentMkMhsDsnRng', 'jamAwal', 'jamAkhir', 'ruang'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_enrollment_mk_mhs_dsn_rng' => 'required|exists:enrollment_mk_mhs_dsn_rng,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'id_jam_awal' => 'required|exists:jam_awal,id',
            'id_jam_akhir' => 'required|exists:jam_akhir,id',
            'id_ruang' => 'required|exists:ruang,id',
        ]);

        $data = Jadwal::create([
            'id_enrollment_mk_mhs_dsn_rng' => $request->id_enrollment_mk_mhs_dsn_rng,
            'hari' => $request->hari,
            'id_jam_awal' => $request->id_jam_awal,
            'id_jam_akhir' => $request->id_jam_akhir,
            'id_ruang' => $request->id_ruang,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Jadwal::with(['enrollmentMkMhsDsnRng', 'jamAwal', 'jamAkhir', 'ruang'])->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Jadwal::findOrFail($id);

        $request->validate([
            'id_enrollment_mk_mhs_dsn_rng' => 'sometimes|required|exists:enrollment_mk_mhs_dsn_rng,id',
            'hari' => 'sometimes|required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'id_jam_awal' => 'sometimes|required|exists:jam_awal,id',
            'id_jam_akhir' => 'sometimes|required|exists:jam_akhir,id',
            'id_ruang' => 'sometimes|required|exists:ruang,id',
        ]);

        $data->update([
            'id_enrollment_mk_mhs_dsn_rng' => $request->id_enrollment_mk_mhs_dsn_rng ?? $data->id_enrollment_mk_mhs_dsn_rng,
            'hari' => $request->hari ?? $data->hari,
            'id_jam_awal' => $request->id_jam_awal ?? $data->id_jam_awal,
            'id_jam_akhir' => $request->id_jam_akhir ?? $data->id_jam_akhir,
            'id_ruang' => $request->id_ruang ?? $data->id_ruang,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Jadwal::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Jadwal deleted successfully']);
    }
}
