<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentKelas;
use Illuminate\Http\Request;

class EnrollmentKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tahun_akademik' => 'required|exists:tahun_akademik,id',
            'id_program_studi' => 'required|exists:program_studi,id',
            'id_kelas' => 'required|exists:kelas,id',
            'id_angkatan' => 'required|exists:angkatan,id',
        ]);

        $data = EnrollmentKelas::create([
            'id_tahun_akademik' => $request->id_tahun_akademik,
            'id_program_studi' => $request->id_program_studi,
            'id_kelas' => $request->id_kelas,
            'id_angkatan' => $request->id_angkatan,
        ]);
        if (!$data) {
            return redirect()->route('admin.enrollment-kelas')->with('error', 'Enrollment Kelas gagal dibuat');
        }
        return redirect()->route('admin.enrollment-kelas')->with('create', 'Enrollment Kelas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = EnrollmentKelas::findOrFail($id);

        $request->validate([
            'id_tahun_akademik' => 'sometimes|required|exists:tahun_akademik,id',
            'id_program_studi' => 'sometimes|required|exists:program_studi,id',
            'id_kelas' => 'sometimes|required|exists:kelas,id',
            'id_angkatan' => 'sometimes|required|exists:angkatan,id',
        ]);

        $data->update([
            'id_tahun_akademik' => $request->id_tahun_akademik ?? $data->id_tahun_akademik,
            'id_program_studi' => $request->id_program_studi ?? $data->id_program_studi,
            'id_kelas' => $request->id_kelas ?? $data->id_kelas,
            'id_angkatan' => $request->id_angkatan ?? $data->id_angkatan,
        ]);

        if (!$data) {
            return redirect()->route('admin.enrollment-kelas')->with('error', 'Enrollment Kelas gagal diperbarui');
        }
        return redirect()->route('admin.enrollment-kelas')->with('update', 'Enrollment Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EnrollmentKelas::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.enrollment-kelas')->with('error', 'Enrollment Kelas gagal dihapus');
        }
        return redirect()->route('admin.enrollment-kelas')->with('delete', 'Enrollment Kelas berhasil dihapus');
    }
}
