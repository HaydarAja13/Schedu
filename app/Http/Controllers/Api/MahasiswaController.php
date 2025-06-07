<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Mahasiswa::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:18|unique:mahasiswa',
            'nama_mahasiswa' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa',
            'password' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15|unique:mahasiswa',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        $path = $request->file('foto_profil')->store('foto_profil', 'public');

        $data = Mahasiswa::create([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'foto_profil' => $path,
        ]);
        if (!$data) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa gagal dibuat');
        }
        return redirect()->route('admin.mahasiswa')->with('create', 'Mahasiswa berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Mahasiswa::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'sometimes|required|string|max:18|unique:mahasiswa,nim,' . $id,
            'nama_mahasiswa' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:mahasiswa,email,' . $id,
            'password' => 'sometimes|nullable|string|max:10',
            'no_hp' => 'sometimes|required|string|max:15|unique:mahasiswa,no_hp,' . $id,
            'foto_profil' => 'sometimes|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($data->foto_profil && Storage::disk('public')->exists($data->foto_profil)) {
                Storage::disk('public')->delete($data->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
        } else {
            $path = $data->foto_profil;
        }

        $data->update([
            'nim' => $request->nim ?? $data->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa ?? $data->nama_mahasiswa,
            'email' => $request->email ?? $data->email,
            'password' => $request->password ? bcrypt($request->password) : $data->password,
            'no_hp' => $request->no_hp ?? $data->no_hp,
            'foto_profil' => $path,
        ]);

        if (!$data) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa gagal diperbarui');
        }
        return redirect()->route('admin.mahasiswa')->with('update', 'Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Mahasiswa::findOrFail($id);
        if ($data->foto_profil && Storage::disk('public')->exists($data->foto_profil)) {
            Storage::disk('public')->delete($data->foto_profil);
        }
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa gagal dihapus');
        }
        return redirect()->route('admin.mahasiswa')->with('delete', 'Mahasiswa berhasil dihapus');
    }
}
