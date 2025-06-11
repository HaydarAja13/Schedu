<?php

namespace App\Livewire;

use App\Models\TahunAkademik;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TahunAkademikTable extends Component
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

    public $selectedTahunAkademikId = null;

    public function selectTahunAkademik($id)
    {
        $this->selectedTahunAkademikId = $id;
    }

    public function getSelectedTahunAkademikProperty()
    {
        return $this->selectedTahunAkademikId
            ? TahunAkademik::find($this->selectedTahunAkademikId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tahun-akademik-table', [
            'tahunAkademik' => TahunAkademik::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedTahunAkademik' => $this->selectedTahunAkademik,
        ]);
    }
}
