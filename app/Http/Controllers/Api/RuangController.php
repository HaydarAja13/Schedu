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

        // return response()->json($data, 201);
        return redirect()->route('admin.ruang.index')->with('success', 'Ruang created successfully.');
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

        $data->update([
            'nama_ruang' => $request->nama_ruang ?? $data->nama_ruang,
            'keterangan' => $request->keterangan ?? $data->keterangan,
        ]);

        // return response()->json($data);
        return redirect()->route('admin.ruang.index')->with('success', 'Ruang updated successfully.');
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
        $data->delete();
        // return response()->json(['message' => 'Ruang deleted successfully']);
        return redirect()->route('admin.ruang.index')->with('success', 'Ruang deleted successfully.');
    }
}