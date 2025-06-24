<?php

namespace App\Livewire;

use App\Models\KelompokProdi;
use App\Models\ProgramStudi;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ScheduleTable extends Component
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.schedule-table', [
            'kelompokProdi' => KelompokProdi::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
