<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Kelas::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:20',
        ]);

        $data = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        if (!$data) {
            return redirect()->route('admin.kelas')->with('error', 'Kelas gagal dibuat');
        }
        return redirect()->route('admin.kelas')->with('create', 'Kelas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Kelas::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'sometimes|required|string|max:20',
        ]);

        $data->update([
            'nama_kelas' => $request->nama_kelas ?? $data->nama_kelas,
        ]);

        if (!$data) {
            return redirect()->route('admin.kelas')->with('error', 'Kelas gagal diperbarui');
        }
        return redirect()->route('admin.kelas')->with('update', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.kelas')->with('error', 'Kelas gagal dihapus');
        }
        return redirect()->route('admin.kelas')->with('delete', 'Kelas berhasil dihapus');
    }
}