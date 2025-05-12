<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TahunAkademik::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:50',
            'status' => 'required|in:0,1',
        ]);

        $data = TahunAkademik::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TahunAkademik::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = TahunAkademik::findOrFail($id);

        $request->validate([
            'tahun_ajaran' => 'sometimes|required|string|max:50',
            'status' => 'sometimes|required|in:0,1',
        ]);

        $data->update([
            'tahun_ajaran' => $request->tahun_ajaran ?? $data->tahun_ajaran,
            'status' => $request->status ?? $data->status,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TahunAkademik::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Tahun Akademik deleted successfully']);
    }
}
