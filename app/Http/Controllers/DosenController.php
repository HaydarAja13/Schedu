<?php 
namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosen', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosenCreate');
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

        Dosen::create([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.dosen')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nip' => 'required|string|max:18|unique:dosen,nip,' . $id,
            'nama_dosen' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen,email,' . $id,
            'password' => 'nullable|string|max:10',
            'no_hp' => 'required|string|max:15|unique:dosen,no_hp,' . $id,
        ]);

        $dosen->update([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $dosen->password,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.dosen')->with('success', 'Dosen berhasil diperbarui');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosenEdit', compact('dosen'));
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('admin.dosen')->with('success', 'Dosen berhasil dihapus');
}

}



