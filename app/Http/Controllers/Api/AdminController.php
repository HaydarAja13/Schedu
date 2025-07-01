<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Admin::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:18|unique:admin',
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admin',
            'password' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15|unique:admin',
        ]);

        $data = Admin::create([
            'nip' => $request->nip,
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Admin::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Admin::findOrFail($id);

        $request->validate([
            'nip' => 'sometimes|required|string|max:18|unique:admin,nip,' . $id,
            'nama_admin' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:admin,email,' . $id,
            'password' => 'sometimes|nullable|string|max:10',
            'no_hp' => 'sometimes|required|string|max:15|unique:admin,no_hp,' . $id,
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
            'nama_admin' => $request->nama_admin ?? $data->nama_admin,
            'email' => $request->email ?? $data->email,
            'password' => $request->password ? bcrypt($request->password) : $data->password,
            'no_hp' => $request->no_hp ?? $data->no_hp,
            'foto_profil' => $path,

        ]);

        if (!$data) {
            return redirect()->route('admin.profile')->with('error', 'Profile gagal diperbarui');
        }
        return redirect()->route('admin.profile')->with('update', 'Profile berhasil diperbarui, silahkan Login kembali');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Admin::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Admin deleted successfully']);
    }
}
