<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MataKuliah::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required|string|unique:mata_kuliah',
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:4',
            'jam' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:8',
            'id_ruang' => 'nullable|exists:ruang,id',
            'jenis' => 'required|string|in:T,P',
        ]);

        $data = MataKuliah::create([
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'jam' => $request->jam,
            'semester' => $request->semester,
            'id_ruang' => $request->id_ruang ?? null,
            'jenis' => $request->jenis,
        ]);

        if (!$data) {
            return redirect()->route('admin.mata-kuliah')->with('error', 'Mata Kuliah gagal dibuat');
        }
        return redirect()->route('admin.mata-kuliah')->with('create', 'Mata Kuliah berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = MataKuliah::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = MataKuliah::findOrFail($id);

        $request->validate([
            'kode_matkul' => 'sometimes|required|string|max:20',
            'nama_matkul' => 'sometimes|required|string|max:255',
            'sks' => 'sometimes|required|integer|min:1|max:4',
            'jam' => 'sometimes|required|integer|min:1|max:4',
            'semester' => 'sometimes|required|integer|min:1|max:8',
            'id_ruang' => 'nullable|sometimes|exists:ruang,id',
            'jenis' => 'sometimes|required|string|in:T,P',
        ]);

        $data->update([
            'kode_matkul' => $request->kode_matkul ?? $data->kode_matkul,
            'nama_matkul' => $request->nama_matkul ?? $data->nama_matkul,
            'sks' => $request->sks ?? $data->sks,
            'jam' => $request->jam ?? $data->jam,
            'semester' => $request->semester ?? $data->semester,
            'id_ruang' => $request->id_ruang ?? $data->id_ruang ?? null,
            'jenis' => $request->jenis ?? $data->jenis,
        ]);

        if (!$data) {
            return redirect()->route('admin.mata-kuliah')->with('error', 'Mata Kuliah gagal diperbarui');
        }
        return redirect()->route('admin.mata-kuliah')->with('update', 'Mata Kuliah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = MataKuliah::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.mata-kuliah')->with('error', 'Mata Kuliah gagal dihapus');
        }
        return redirect()->route('admin.mata-kuliah')->with('delete', 'Mata Kuliah berhasil dihapus');
    }
}
