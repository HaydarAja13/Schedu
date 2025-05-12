<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Jurusan::with('programStudi')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan',
        ]);

        $data = Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Jurusan::with('programStudi')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Jurusan::findOrFail($id);

        $request->validate([
            'nama_jurusan' => 'sometimes|required|string|max:100|unique:jurusan,nama_jurusan,' . $id,
        ]);

        $data->update([
            'nama_jurusan' => $request->nama_jurusan ?? $data->nama_jurusan,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Jurusan::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Jurusan deleted successfully']);
    }
}
