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

        if ($request->status == 1) {
            TahunAkademik::where('status', 1)->update(['status' => 0]);
        }

        $data = TahunAkademik::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
        ]);

        if (!$data) {
            return redirect()->route('admin.tahun-akademik')->with('error', 'Tahun Ajaran gagal dibuat');
        }
        return redirect()->route('admin.tahun-akademik')->with('create', 'Tahun Ajaran berhasil dibuat');
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

        if (!$data) {
            return redirect()->route('admin.tahun-akademik')->with('error', 'Tahun Ajaran gagal diperbarui');
        }
        return redirect()->route('admin.tahun-akademik')->with('update', 'Tahun Ajaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TahunAkademik::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.tahun-akademik')->with('error', 'Tahun Ajaran gagal dibuat');
        }
        return redirect()->route('admin.tahun-akademik')->with('delete', 'Tahun Ajaran berhasil dibuat');
    }
}
