<?php

namespace App\Livewire;

use App\Models\Dosen;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class DosenForm extends Component
{
    public $id_dosen;
    public $nama_dosen;
    public $nip;
    public $email;
    public $no_hp;
    public $password;
    public $password_confirmation;
    public $isEdit = false;

    protected function rules()
    {
        $rules = [
            'nama_dosen' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen,email',
            'no_hp' => 'required|string|max:20',
        ];

        // Aturan khusus untuk edit
        if ($this->isEdit) {
            $rules['email'] .= ',' . $this->id_dosen;
            
            // Password tidak wajib diisi saat edit
            if ($this->password) {
                $rules['password'] = 'required|string|min:8|confirmed';
                $rules['password_confirmation'] = 'required';
            }
        } else {
            // Password wajib diisi saat create
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }

    public function mount($id = null)
    {
        if ($id) {
            $dosen = Dosen::findOrFail($id);
            $this->id_dosen = $dosen->id;
            $this->nama_dosen = $dosen->nama_dosen;
            $this->nip = $dosen->nip;
            $this->email = $dosen->email;
            $this->no_hp = $dosen->no_hp;
            $this->isEdit = true;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_dosen' => $this->nama_dosen,
            'nip' => $this->nip,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
        ];

        // Jika password diisi (baik create maupun edit)
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEdit) {
            Dosen::find($this->id_dosen)->update($data);
            session()->flash('message', 'Data dosen berhasil diperbarui.');
        } else {
            Dosen::create($data);
            session()->flash('message', 'Data dosen berhasil ditambahkan.');
        }

        return redirect()->route('admin.dosen');
    }

    public function render()
    {
        return view('livewire.dosen-form');
    }
}