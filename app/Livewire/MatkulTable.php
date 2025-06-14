<?php

namespace App\Livewire;

use App\Models\MataKuliah;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MatkulTable extends Component
{
    public $role = 'admin';

    use WithPagination;

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $perPage = 10;
    #[Url(history: true)]
    public $sortBy = 'kode_matkul';
    #[Url(history: true)]
    public $sortDirection = 'asc';
    public $selectedMataKuliahId = null;

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function selectMataKuliah($id)
    {
        $this->selectedMataKuliahId = $id;
    }

    public function deleteMataKuliah($id)
    {
        if ($this->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
        $matkul = MataKuliah::findOrFail($id);
        $matkul->delete();
        session()->flash('message', 'Mata kuliah berhasil dihapus.');
        $this->selectedMataKuliahId = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = MataKuliah::with('ruang');

        if ($this->search) {
            $query->where('kode_matkul', 'like', '%' . $this->search . '%')
                  ->orWhere('nama_matkul', 'like', '%' . $this->search . '%');
        }

        $mata_kuliah = $query->orderBy($this->sortBy, $this->sortDirection)
                             ->paginate($this->perPage);

        return view('livewire.matkul-table', [
            'mata_kuliah' => $mata_kuliah,
            'role' => $this->role,
        ]);
    }
}