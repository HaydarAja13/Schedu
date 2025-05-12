<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentMkMhsDsnRng;
use Illuminate\Http\Request;

class EnrollmentMkMhsDsnRngController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(EnrollmentMkMhsDsnRng::with(['mataKuliah', 'enrollmentKelas', 'dosen'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mata_kuliah' => 'required|exists:mata_kuliah,id',
            'id_enrollment_kelas' => 'required|exists:enrollment_kelas,id',
            'id_dosen' => 'required|exists:dosen,id',
        ]);

        $data = EnrollmentMkMhsDsnRng::create([
            'id_mata_kuliah' => $request->id_mata_kuliah,
            'id_enrollment_kelas' => $request->id_enrollment_kelas,
            'id_dosen' => $request->id_dosen,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'enrollmentKelas', 'dosen'])->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = EnrollmentMkMhsDsnRng::findOrFail($id);

        $request->validate([
            'id_mata_kuliah' => 'sometimes|required|exists:mata_kuliah,id',
            'id_enrollment_kelas' => 'sometimes|required|exists:enrollment_kelas,id',
            'id_dosen' => 'sometimes|required|exists:dosen,id',
        ]);

        $data->update([
            'id_mata_kuliah' => $request->id_mata_kuliah ?? $data->id_mata_kuliah,
            'id_enrollment_kelas' => $request->id_enrollment_kelas ?? $data->id_enrollment_kelas,
            'id_dosen' => $request->id_dosen ?? $data->id_dosen,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EnrollmentMkMhsDsnRng::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}
