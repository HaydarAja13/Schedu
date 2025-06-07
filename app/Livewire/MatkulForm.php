<?php

namespace App\Livewire;

use App\Models\MataKuliah;
use App\Models\Ruang;
use Livewire\Component;

class MataKuliahForm extends Component
{
    public $id_matkul;
    public $kode_matkul;
    public $nama_matkul;
    public $sks;
    public $jam;
    public $semester;
    public $id_ruang;
    public $jenis = 'T'; // Default ke 'T' (Teori)
    public $isEdit = false;

    protected function rules()
    {
        $ruleKodeMatkul = 'required|string|max:10|unique:mata_kuliah,kode_matkul';

        if ($this->isEdit) {
            $ruleKodeMatkul .= ',' . $this->id_matkul;
        }

        return [
            'kode_matkul' => $ruleKodeMatkul,
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:4',
            'jam' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:8',
            'id_ruang' => 'required|exists:ruang,id',
            'jenis' => 'required|in:T,P',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $matkul = MataKuliah::findOrFail($id);
            $this->id_matkul = $matkul->id;
            $this->kode_matkul = $matkul->kode_matkul;
            $this->nama_matkul = $matkul->nama_matkul;
            $this->sks = $matkul->sks;
            $this->jam = $matkul->jam;
            $this->semester = $matkul->semester;
            $this->id_ruang = $matkul->id_ruang;
            $this->jenis = $matkul->jenis;
            $this->isEdit = true;
        }
    }

    public function save()
    {
        $this->validate($this->rules());

        $data = [
            'kode_matkul' => $this->kode_matkul,
            'nama_matkul' => $this->nama_matkul,
            'sks' => $this->sks,
            'jam' => $this->jam,
            'semester' => $this->semester,
            'id_ruang' => $this->id_ruang,
            'jenis' => $this->jenis,
        ];

        if ($this->isEdit) {
            MataKuliah::find($this->id_matkul)->update($data);
            session()->flash('message', 'Mata kuliah berhasil diperbarui.');
        } else {
            MataKuliah::create($data);
            session()->flash('message', 'Mata kuliah berhasil ditambahkan.');
        }

        return redirect()->route('admin.mata-kuliah');
    }

    public function render()
    {
        return view('livewire.mata-kuliah-form', [
            'ruangOptions' => Ruang::all(),
            'jenisOptions' => ['T' => 'Teori', 'P' => 'Praktikum'],
        ]);
    }
}