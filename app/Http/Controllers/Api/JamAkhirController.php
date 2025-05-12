<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JamAkhir;
use Illuminate\Http\Request;

class JamAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(JamAkhir::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jam' => 'required|string|max:100',
            'keterangan' => 'required|string|max:100',
        ]);

        $data = JamAkhir::create([
            'nama_jam' => $request->nama_jam,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = JamAkhir::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = JamAkhir::findOrFail($id);

        $request->validate([
            'nama_jam' => 'sometimes|required|string|max:100',
            'keterangan' => 'sometimes|required|string|max:100',
        ]);

        $data->update([
            'nama_jam' => $request->nama_jam->nama_jam ?? $data->nama_jam,
            'nama_dosen' => $request->keterangan ?? $data->keterangan,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JamAkhir::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Jam Akhir deleted successfully']);
    }
}
