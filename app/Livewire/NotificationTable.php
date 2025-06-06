<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class NotificationTable extends Component
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

    public $selectedNotifikasiId = null;

    public function selectNotifikasi($id)
    {
        $this->selectedNotifikasiId = $id;
    }

    public function getSelectedNotifikasiProperty()
    {
        return $this->selectedNotifikasiId
            ? Notification::find($this->selectedNotifikasiId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.notification-table', [
            'notifikasi' => Notification::with(['dosen', 'jamMulai', 'jamSelesai'])
                ->search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
            'selectedNotifikasi' => $this->selectedNotifikasi,
        ]);
    }
}
