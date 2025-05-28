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
    public $sortBy = 'nama_ruang';
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
    public $selectedRuangId = null;

    public function selectRuang($id)
    {
        $this->selectedRuangId = $id;
    }

    public function getSelectedRuangProperty()
    {
        return $this->selectedRuangId
            ? Ruang::find($this->selectedRuangId)
            : null;
    }

    public function render()
    {
        return view('livewire.ruang-table', [
            'ruang' => Ruang::where('nama_ruang', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedRuang' => $this->selectedRuang,
        ]);
    }
}
