<?php

namespace App\Livewire;

use App\Models\Mahasiswa;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MahasiswaTable extends Component
{
    use WithPagination;
    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $perPage = 10;
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'desc';

    public function setSortBy($field){
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }
        $this->sortBy = $field;
        $this->sortDirection = 'desc';
    }
    public $selectedMahasiswaId = null;

    public function selectMahasiswa($id)
    {
        $this->selectedMahasiswaId = $id;
    }

    public function getSelectedMahasiswaProperty()
    {
        return $this->selectedMahasiswaId
            ? Mahasiswa::find($this->selectedMahasiswaId)
            : null;
    }

    public function render()
    {
        return view('livewire.mahasiswa-table', [
            'mahasiswa' => Mahasiswa::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedMahasiswa' => $this->selectedMahasiswa,
        ]);
    }
}
