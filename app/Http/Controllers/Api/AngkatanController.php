<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Angkatan::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_angkatan' => 'required|string',
        ]);

        $data = Angkatan::create([
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        if (!$data) {
            return redirect()->route('admin.angkatan')->with('error', 'Angkatan gagal dibuat');
        }
        return redirect()->route('admin.angkatan')->with('create', 'Angkatan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Angkatan::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Angkatan::findOrFail($id);

        $request->validate([
            'tahun_angkatan' => 'sometimes|required|string|',
        ]);

        $data->update([
            'tahun_angkatan' => $request->tahun_angkatan ?? $data->tahun_angkatan,

        ]);

        if (!$data) {
            return redirect()->route('admin.angkatan')->with('error', 'Angkatan gagal diperbarui');
        }
        return redirect()->route('admin.angkatan')->with('update', 'Angkatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Angkatan::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.angkatan')->with('error', 'Angkatan gagal dihapus');
        }
        return redirect()->route('admin.angkatan')->with('delete', 'Angkatan berhasil dihapus');
    }
}
