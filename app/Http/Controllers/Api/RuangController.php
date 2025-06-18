<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Ruang::with( 'kelompokProdi')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:50',
            'keterangan' => 'required|in:0,1',
            'id_kelompok_ruang' => 'required|exists:kelompok_ruang,id',
        ]);

        $data = Ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'keterangan' => $request->keterangan,
            'id_kelompok_ruang' => $request->id_kelompok_ruang,
        ]);

        if (!$data) {
            return redirect()->route('admin.ruang')->with('error', 'Ruang gagal dibuat');
        }
        return redirect()->route('admin.ruang')->with('create', 'Ruang berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Ruang::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Ruang::findOrFail($id);

        $request->validate([
            'nama_ruang' => 'sometimes|required|string|max:50',
            'keterangan' => 'sometimes|required|in:0,1',
            'id_kelompok_ruang' => 'sometimes|required|exists:kelompok_ruang,id',
        ]);

        $data->update([
            'nama_ruang' => $request->nama_ruang ?? $data->nama_ruang,
            'keterangan' => $request->keterangan ?? $data->keterangan,
            'id_kelompok_ruang' => $request->id_kelompok_ruang ?? $data->id_kelompok_ruang, 
        ]);

        if (!$data) {
            return redirect()->route('admin.ruang')->with('error', 'Ruang gagal diperbarui');
        }
        return redirect()->route('admin.ruang')->with('update', 'Ruang berhasil diperbarui');;
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Ruang::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.ruang')->with('error', 'Ruang gagal dihapus');
        }
        return redirect()->route('admin.ruang')->with('delete', 'Ruang berhasil dihapus');
    }
}