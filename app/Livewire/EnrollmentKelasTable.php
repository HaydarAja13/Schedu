<?php

namespace App\Livewire;

use App\Models\EnrollmentKelas;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentKelasTable extends Component
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

    public $selectedEnrollmentKelasId = null;

    public function selectEnrollmentKelas($id)
    {
        $this->selectedEnrollmentKelasId = $id;
    }

    public function getSelectedEnrollmentKelasProperty()
    {
        return $this->selectedEnrollmentKelasId
            ? EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan'])->find($this->selectedEnrollmentKelasId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = EnrollmentKelas::with(['tahunAkademik', 'programStudi', 'kelas', 'angkatan']);
        if ($this->search) {
            $query->whereHas('tahunAkademik', function($q) {
                $q->where('tahun_ajaran', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('programStudi', function($q) {
                $q->where('nama_prodi', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('kelas', function($q) {
                $q->where('nama_kelas', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('angkatan', function($q) {
                $q->where('tahun_angkatan', 'like', '%'.$this->search.'%');
            });
        }
        return view('livewire.enrollment-kelas-table', [
            'enrollmentKelas' => $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage),
            'selectedEnrollmentKelas' => $this->selectedEnrollmentKelas,
        ]);
    }
}
