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
     * Show the form for creating a new resource.
     */
    

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
            return redirect()->route('admin.kelas')->with('error', 'Data kelas gagal ditambahkan');
        }

        return redirect()->route('admin.kelas')->with('create', 'Data kelas berhasil ditambahkan');
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
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'sometimes|required|string|max:20',
        ]);

        $updated = $data->update([
            'nama_kelas' => $request->nama_kelas ?? $data->nama_kelas,
        ]);

        if (!$updated) {
            return redirect()->route('admin.kelas')->with('error', 'Data kelas gagal diperbarui');
        }

        return redirect()->route('admin.kelas')->with('update', 'Data kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::findOrFail($id);
        $deleted = $data->delete();

        if (!$deleted) {
            return redirect()->route('admin.kelas')->with('error', 'Data kelas gagal dihapus');
        }

        return redirect()->route('admin.kelas')->with('delete', 'Data kelas berhasil dihapus');
    }
}
