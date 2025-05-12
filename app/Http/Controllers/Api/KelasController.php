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

        return response()->json($data, 201);
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

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Kelas deleted successfully']);
    }
}