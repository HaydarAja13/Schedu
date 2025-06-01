<?php

namespace App\Livewire;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class DosenTable extends Component
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

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }
        $this->sortBy = $field;
        $this->sortDirection = 'desc';
    }
    public $selectedDosenId = null;

    public function selectDosen($id)
    {
        $this->selectedDosenId = $id;
    }

    public function getSelectedDosenProperty()
    {
        return $this->selectedDosenId
            ? Dosen::find($this->selectedDoseId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dosen-table', [
            'dosen' => Dosen::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedDosen' => $this->selectedDosen,
        ]);
    }
}
