<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokProdi;

class KelompokProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(KelompokProdi::with('programStudi')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok_prodi' => 'required|string|max:100|unique:nama_kelompok_prodi,nama_kelompok_prodi',
        ]);

        $data = KelompokProdi::create([
            'nama_kelompok_prodi' => $request->nama_kelompok_prodi,
        ]);

        if (!$data) {
            return redirect()->route('admin.kelompok-prodi')->with('error', 'Kelompok Prodi gagal dibuat');
        }
        return redirect()->route('admin.kelompok-prodi')->with('create', 'Kelompok Prodi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = KelompokProdi::with('programStudi')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = KelompokProdi::findOrFail($id);

        $request->validate([
            'nama_kelompok_prodi' => 'sometimes|required|string|max:100|unique:nama_kelompok_prodi,nama_kelompok_prodi,' . $id,
        ]);

        $data->update([
            'nama_kelompok_prodi' => $request->nama_kelompok_prodi ?? $data->nama_kelompok_prodi,
        ]);

        if (!$data) {
            return redirect()->route('admin.kelompok-prodi')->with('error', 'Kelompok Prodi gagal diperbarui');
        }
        return redirect()->route('admin.kelompok-prodi')->with('update', 'Kelompok Prodi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KelompokProdi::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.kelompok-prodi')->with('error', 'Kelompok Prodi gagal dihapus');
        }
        return redirect()->route('admin.kelompok-prodi')->with('delete', 'Kelompok Prodi berhasil dihapus');
    }
}
