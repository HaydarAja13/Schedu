<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AngkatanTable extends Component
{
    use WithPagination;
    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $perPage = 10;
    #[Url(history: true)]
    public $sortBy = 'tahun_angkatan';
    #[Url(history: true)]
    public $sortDirection = 'asc';

    public function setSortBy($field){
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
