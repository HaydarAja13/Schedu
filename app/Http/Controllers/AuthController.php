<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,dosen,mahasiswa',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = null;

        switch ($request->role) {
            case 'admin':
                $user = Admin::where('nip', $request->username)->first();
                break;
            case 'dosen':
                $user = Dosen::where('nip', $request->username)->first();
                break;
            case 'mahasiswa':
                $user = Mahasiswa::where('nim', $request->username)->first();
                break;
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'The provided credentials are incorrect.')->withInput();
        }

        $request->session()->regenerate();

        $request->session()->put('user', $user);
        $request->session()->put('role', $request->role);

        if ($request->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($request->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } else {
            return redirect()->route('mahasiswa.dashboard');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/');
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        $role = $request->session()->get('role');

        // Pilih view sesuai role
        if ($role === 'admin') {
            return view('admin.profile', compact('user', 'role'));
        } elseif ($role === 'dosen') {
            return view('dosen.profile', compact('user', 'role'));
        } elseif ($role === 'mahasiswa') {
            return view('mahasiswa.profile', compact('user', 'role'));
        } else {
            abort(404);
        }
    }
}
