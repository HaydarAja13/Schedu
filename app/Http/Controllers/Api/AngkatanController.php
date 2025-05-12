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

        return response()->json($data, 201);
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
            'tahun_angkatan' => $request->angkatan->angkatan ?? $data->angkatan,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Angkatan::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Angkatan deleted successfully']);
    }
}
