<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentMahasiswaKelas;
use Illuminate\Http\Request;

class EnrollmentMahasiswaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(EnrollmentMahasiswaKelas::with(['mahasiswa', 'enrollmentKelas'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id',
            'id_enrollment_kelas' => 'required|exists:enrollment_kelas,id',
        ]);

        $data = EnrollmentMahasiswaKelas::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_enrollment_kelas' => $request->id_enrollment_kelas,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = EnrollmentMahasiswaKelas::with(['mahasiswa', 'enrollmentKelas'])->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = EnrollmentMahasiswaKelas::findOrFail($id);

        $request->validate([
            'id_mahasiswa' => 'sometimes|required|exists:mahasiswa,id',
            'id_enrollment_kelas' => 'sometimes|required|exists:enrollment_kelas,id',
        ]);

        $data->update([
            'id_mahasiswa' => $request->id_mahasiswa ?? $data->id_mahasiswa,
            'id_enrollment_kelas' => $request->id_enrollment_kelas ?? $data->id_enrollment_kelas,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EnrollmentMahasiswaKelas::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Enrollment Mahasiswa Kelas deleted successfully']);
    }
}
