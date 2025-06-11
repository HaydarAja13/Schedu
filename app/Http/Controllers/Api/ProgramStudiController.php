<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ProgramStudi::with('jurusan')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|exists:jurusan,id',
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:10|unique:program_studi,kode_prodi',
        ]);

        $data = ProgramStudi::create([
            'id_jurusan' => $request->id_jurusan,
            'nama_prodi' => $request->nama_prodi,
            'kode_prodi' => $request->kode_prodi,
        ]);

        if (!$data) {
            return redirect()->route('admin.program-studi')->with('error', 'Program Studi gagal dibuat');
        }
        return redirect()->route('admin.program-studi')->with('create', 'Program Studi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProgramStudi::with('jurusan')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ProgramStudi::findOrFail($id);

        $request->validate([
            'id_jurusan' => 'sometimes|required|exists:jurusan,id',
            'nama_prodi' => 'sometimes|required|string|max:100',
            'kode_prodi' => 'sometimes|required|string|max:10|unique:program_studi,kode_prodi,' . $id,
        ]);

        $data->update([
            'id_jurusan' => $request->id_jurusan ?? $data->id_jurusan,
            'nama_prodi' => $request->nama_prodi ?? $data->nama_prodi,
            'kode_prodi' => $request->kode_prodi ?? $data->kode_prodi,
        ]);

        if (!$data) {
            return redirect()->route('admin.program-studi')->with('error', 'Program Studi gagal diperbarui');
        }
        return redirect()->route('admin.program-studi')->with('update', 'Program Studi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProgramStudi::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.program-studi')->with('error', 'Program Studi gagal dihapus');
        }
        return redirect()->route('admin.program-studi')->with('delete', 'Program Studi berhasil dihapus');
    }
}
