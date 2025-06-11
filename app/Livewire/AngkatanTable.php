<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class AngkatanTable extends Component
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

    public $selectedAngkatanId = null;

    public function selectAngkatan($id)
    {
        $this->selectedAngkatanId = $id;
    }

    public function getSelectedAngkatanProperty()
    {
        return $this->selectedAngkatanId
            ? Angkatan::find($this->selectedAngkatanId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.angkatan-table', [
            'angkatan' => Angkatan::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedAngkatan' => $this->selectedAngkatan,
        ]);
    }
}
