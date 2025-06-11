<?php

namespace App\Livewire;

use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class JurusanTable extends Component
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

    public $selectedJurusanId = null;

    public function selectJurusan($id)
    {
        $this->selectedJurusanId = $id;
    }

    public function getSelectedJurusanProperty()
    {
        return $this->selectedJurusanId
            ? Jurusan::find($this->selectedJurusanId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.jurusan-table', [
            'jurusan' => Jurusan::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedJurusan' => $this->selectedJurusan,
        ]);
    }
}
