<?php

namespace App\Livewire;

use App\Models\ProgramStudi;
use App\Models\Jurusan;
use Livewire\Component;

class ProgramStudiForm extends Component
{
    public $id_prodi;
    public $kode_prodi;
    public $nama_prodi;
    public $id_jurusan;
    public $isEdit = false;

    protected function rules()
    {
        $ruleKodeProdi = 'required|unique:program_studi,kode_prodi';

        if ($this->isEdit) {
            $ruleKodeProdi .= ',' . $this->id_prodi;
        }

        return [
            'kode_prodi' => $ruleKodeProdi,
            'nama_prodi' => 'required',
            'id_jurusan' => 'required|exists:jurusan,id',
        ];
    }


    public function mount($id = null)
    {
        if ($id) {
            $prodi = ProgramStudi::findOrFail($id);
            $this->id_prodi = $prodi->id;
            $this->kode_prodi = $prodi->kode_prodi;
            $this->nama_prodi = $prodi->nama_prodi;
            $this->id_jurusan = $prodi->id_jurusan;
            $this->isEdit = true;
            
            
        }
    }

    public function save()
    {
        $this->validate($this->rules());

        $data = [
            'kode_prodi' => $this->kode_prodi,
            'nama_prodi' => $this->nama_prodi,
            'id_jurusan' => $this->id_jurusan
        ];

        if ($this->isEdit) {
            ProgramStudi::find($this->id_prodi)->update($data);
            session()->flash('message', 'Program studi berhasil diperbarui.');
        } else {
            ProgramStudi::create($data);
            session()->flash('message', 'Program studi berhasil ditambahkan.');
        }

        return redirect()->route('admin.program-studi');
    }

    public function render()
    {
        return view('livewire.program-studi-form', [
            'jurusanOptions' => Jurusan::all()
            
        ]);
    }
}