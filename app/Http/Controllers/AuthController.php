<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        $token = null;

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
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}