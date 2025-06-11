<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DosenController extends Controller
{
    public function index()
    {
        return response()->json(Dosen::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:18|unique:dosen',
            'nama_dosen' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen',
            'password' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15|unique:dosen',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        $path = $request->file('foto_profil')->store('foto_profil', 'public');


        $data = Dosen::create([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'foto_profil' => $path,

        ]);

        if (!$data) {
            return redirect()->route('admin.dosen')->with('error', 'Dosen gagal dibuat');
        }
        return redirect()->route('admin.dosen')->with('create', 'Dosen berhasil dibuat');
    }

    public function show(string $id)
    {
        $data = Dosen::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, string $id)
    {
        $data = Dosen::findOrFail($id);

        $request->validate([
            'nip' => 'sometimes|required|string|max:18|unique:dosen,nip,' . $id,
            'nama_dosen' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:dosen,email,' . $id,
            'password' => 'sometimes|nullable|string|max:10',
            'no_hp' => 'sometimes|required|string|max:15|unique:dosen,no_hp,' . $id,
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
            'nip' => $request->nip->nip ?? $data->nip,
            'nama_dosen' => $request->nama_dosen ?? $data->nama_dosen,
            'email' => $request->email ?? $data->email,
            'password' => $request->password ? bcrypt($request->password) : $data->password,
            'no_hp' => $request->no_hp ?? $data->no_hp,
            'foto_profil' => $path,

        ]);

        if (!$data) {
            return redirect()->route('admin.dosen')->with('error', 'Dosen gagal diperbarui');
        }
        return redirect()->route('admin.dosen')->with('update', 'Dosen berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $data = Dosen::findOrFail($id);
        if ($data->foto_profil && Storage::disk('public')->exists($data->foto_profil)) {
            Storage::disk('public')->delete($data->foto_profil);
        }
        $data->delete();
        if (!$data) {
            return redirect()->route('admin.dosen')->with('error', 'Dosen gagal dihapus');
        }
        return redirect()->route('admin.dosen')->with('delete', 'Dosen berhasil dihapus');
    }
}
