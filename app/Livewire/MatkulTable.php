<?php

namespace App\Livewire;

use App\Models\MataKuliah;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MatkulTable extends Component
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
    public $selectedMataKuliahId = null;

    public function selectMataKuliah($id)
    {
        $this->selectedMataKuliahId = $id;
    }

    public function getSelectedMataKuliahProperty()
    {
        return $this->selectedMataKuliahId
            ? Dosen::find($this->selectedMataKuliahId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.matkul-table', [
            'matkul' => MataKuliah::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedMataKuliah' => $this->selectedMataKuliah,
        ]);
    }

}
