<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        $data = Mahasiswa::create([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'foto' => $fotoPath,
        ]);
        
        if (!$data) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Data Mahasiswa gagal diperbarui');
        }
        return redirect()->route('admin.mahasiswa')->with('create', 'Data Mahasiswa berhasil diperbarui');
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
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswaUpdate', compact('mahasiswa'));
    }
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'sometimes|required|string|max:18|unique:mahasiswa,nim,' . $id,
            'nama_mahasiswa' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:mahasiswa,email,' . $id,
            'password' => 'sometimes|nullable|string|max:10',
            'no_hp' => 'sometimes|required|string|max:15|unique:mahasiswa,no_hp,' . $id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $mahasiswa->foto;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        $mahasiswa->update([
            'nim' => $request->nim ?? $mahasiswa->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa ?? $mahasiswa->nama_mahasiswa,
            'email' => $request->email ?? $mahasiswa->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $mahasiswa->password,
            'no_hp' => $request->no_hp ?? $mahasiswa->no_hp,
            'foto' => $fotoPath,
        ]);

        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Data Mahasiswa gagal diperbarui');
        }
        return redirect()->route('admin.mahasiswa')->with('update', 'Data Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Mahasiswa::findOrFail($id);
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Data Mahasiswa gagal dihapus');
        }
        return redirect()->route('admin.mahasiswa')->with('delete', 'Data Mahasiswa berhasil dihapus');
    }
}
