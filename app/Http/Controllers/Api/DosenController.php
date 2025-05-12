<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        ]);

        $data = Dosen::create([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
        ]);

        return response()->json($data, 201);
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
        ]);

        $data->update([
            'nip' => $request->nip->nip ?? $data->nip,
            'nama_dosen' => $request->nama_dosen ?? $data->nama_dosen,
            'email' => $request->email ?? $data->email,
            'password' => $request->password ? bcrypt($request->password) : $data->password,
            'no_hp' => $request->no_hp ?? $data->no_hp,
        ]);

        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $data = Dosen::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Dosen deleted successfully']);
    }
}
