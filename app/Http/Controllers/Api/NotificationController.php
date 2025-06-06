<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Notification::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|exists:dosen,id',
            'jam_mulai' => 'required|string|max:255|exists:jam_awal,nama_jam',
            'jam_akhir' => 'required|string|max:255|exists:jam_akhir,nama_jam',
            'hari' => 'required|string|max:10|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'keterangan' => 'required|string',
            'status' => 'required|string|in:Belum Divalidasi,Divalidasi',
        ]);

        $data = Notification::create([
            'id_dosen' => $request->id_dosen,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_akhir,
            'hari' => $request->hari,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Notification::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Notification::findOrFail($id);

        $request->validate([
            'id_dosen' => 'sometimes|required|exists:dosen,id',
            'jam_mulai' => 'sometimes|required|string|max:255|exists:jam_awal,nama_jam',
            'jam_akhir' => 'sometimes|required|string|max:255|exists:jam_akhir,nama_jam',
            'hari' => 'sometimes|required|string|max:10|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'keterangan' => 'sometimes|required|string',
            'status' => 'sometimes|required|string|in:Belum Divalidasi,Divalidasi',
        ]);

        $data->update([
            'id_dosen' => $request->id_dosen->id_dosen ?? $data->id_dosen,
            'jam_mulai' => $request->jam_mulai ?? $data->jam_mulai,
            'jam_selesai' => $request->jam_akhir ?? $data->jam_selesai,
            'hari' => $request->hari ?? $data->hari,
            'keterangan' => $request->keterangan ?? $data->keterangan,
            'status' => $request->status ?? $data->status,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Notification::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
