<?php

namespace App\Livewire;

use App\Models\Kelas;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class KelasTable extends Component
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

    public $selectedKelasId = null;

    public function selectKelas($id)
    {
        $this->selectedKelasId = $id;
    }

    public function getSelectedKelasProperty()
    {
        return $this->selectedKelasId
            ? Kelas::find($this->selectedKelasId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.kelas-table', [
            'kelas' => Kelas::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedKelas' => $this->selectedKelas,
        ]);
    }
}
