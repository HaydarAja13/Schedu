<?php

namespace App\Livewire;

use App\Models\EnrollmentMkMhsDsnRng;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentJadwalTable extends Component
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

    public $selectedEnrollmentJadwalId = null;

    public function selectEnrollmentJadwal($id)
    {
        $this->selectedEnrollmentJadwalId = $id;
    }

    public function getSelectedEnrollmentJadwalProperty()
    {
        return $this->selectedEnrollmentJadwalId
            ? EnrollmentMkMhsDsnRng::with(['mataKuliah', 'enrollmentKelas', 'dosen'])->find($this->selectedEnrollmentJadwalId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'enrollmentKelas', 'dosen']);
        if ($this->search) {
            $query->whereHas('mataKuliah', function($q) {
                $q->where('nama_matkul', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('enrollmentKelas.tahunAkademik', function($q) {
                $q->where('tahun_ajaran', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('enrollmentKelas.programStudi', function($q) {
                $q->where('nama_prodi', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('enrollmentKelas.kelas', function($q) {
                $q->where('nama_kelas', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('dosen', function($q) {
                $q->where('nama_dosen', 'like', '%'.$this->search.'%');
            });
        }
        return view('livewire.enrollment-jadwal-table', [
            'enrollmentJadwal' => $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage),
            'selectedEnrollmentJadwal' => $this->selectedEnrollmentJadwal,
        ]);
    }
}
