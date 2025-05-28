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
        return response()->json(Kelas::all()); // API JSON response (commented out)
        // $kelas = Kelas::all();
        // return view('admin.kelas.index', compact('kelas')); // Web view response
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

        // return response()->json($data, 201); // API JSON response (commented out)
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas created successfully');
    }

    public function create()
    {
        return view('admin.kelas.create'); // Web view response
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Kelas::findOrFail($id);
        return response()->json($data); // API JSON response (commented out)
        // return view('admin.kelas.show', compact('data'));
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

        // return response()->json($data); // API JSON response (commented out)
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas updated successfully');
    }
    public function edit(string $id)
    {
        $data = Kelas::findOrFail($id);
        // return response()->json($kelas); // API JSON response (commented out)
        return view('admin.kelas.edit', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();
        // return response()->json(['message' => 'Kelas deleted successfully']); // API JSON response (commented out)
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas deleted successfully');
    }
}