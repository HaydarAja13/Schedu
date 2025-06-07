<?php

namespace App\Livewire;

use App\Models\ProgramStudi;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramStudiTable extends Component
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
    public $selectedProgramStudiId = null;

    public function selectProgramStudi($id)
    {
        $this->selectedProgramStudiId = $id;
    }

    public function getSelectedProgramStudiProperty()
    {
        return $this->selectedProgramStudiId
            ? ProgramStudi::find($this->selectedProgramStudiId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.program-studi-table', [
            'program_studi' => ProgramStudi::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedProgramStudi' => $this->selectedProgramStudi,
        ]);
    }

    public function editProgramStudi($id)
    {
        return redirect()->route('admin.program-studi.edit', $id);
    }

    
    public function deleteProgramStudi($id)
    {
        $prodi = ProgramStudi::find($id);
        if ($prodi) {
            $prodi->delete();
            session()->flash('message', 'Program studi berhasil dihapus.');
        }
    }
}


