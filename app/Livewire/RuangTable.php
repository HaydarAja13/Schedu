<?php

namespace App\Livewire;

use App\Models\Ruang;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RuangTable extends Component
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

    public $selectedRuangId = null;

    public function selectRuang($id)
    {
        $this->selectedRuangId = $id;
    }

    public function getSelectedRuangProperty()
    {
        return $this->selectedRuangId
            ? Ruang::with(['kelompokProdi'])->find($this->selectedRuangId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Ruang::with(['kelompokProdi']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_ruang', 'like', '%' . $this->search . '%')
<<<<<<< HEAD
                    ->orWhereHas('kelompok_prodi', function ($q) {
=======
                    ->orWhereHas('kelompokProdi', function ($q) {
>>>>>>> 11d4c02c44be8ec803fe5ac2baf430ac6b6fd911
                        $q->where('nama_kelompok_prodi', 'like', '%' . $this->search . '%');
                    });
            });
        }

        return view('livewire.ruang-table', [
            'ruang' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedRuang' => $this->selectedRuang,
        ]);
    }
}