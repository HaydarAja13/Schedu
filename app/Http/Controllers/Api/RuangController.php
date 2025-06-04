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
        return response()->json(Ruang::all());
        // $ruang = Ruang::all();
        // return view('admin.ruang.index', compact('ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:50',
            'keterangan' => 'required|in:0,1',
        ]);

        $data = Ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'keterangan' => $request->keterangan,
        ]);

        if (!$data) {
            return redirect()->route('admin.ruang.index')->with('error', 'Data ruang gagal ditambahkan');
        }

        return redirect()->route('admin.ruang.index')->with('create', 'Data ruang berhasil ditambahkan');
    }
    
    function create()
    {
        return view('admin.ruang.create');
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
        ]);

        $updated = $data->update([
            'nama_ruang' => $request->nama_ruang ?? $data->nama_ruang,
            'keterangan' => $request->keterangan ?? $data->keterangan,
        ]);

        if (!$updated) {
            return redirect()->route('admin.ruang.index')->with('error', 'Data ruang gagal diperbarui');
        }

        return redirect()->route('admin.ruang.index')->with('update', 'Data ruang berhasil diperbarui');
    }
    function edit(string $id)
    {
        $data = Ruang::findOrFail($id);
        return view('admin.ruang.edit', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Ruang::findOrFail($id);
        $deleted = $data->delete();

        if (!$deleted) {
            return redirect()->route('admin.ruang.index')->with('error', 'Data ruang gagal dihapus');
        }

        return redirect()->route('admin.ruang.index')->with('delete', 'Data ruang berhasil dihapus');
    }
}