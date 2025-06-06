<?php

namespace App\Livewire;

use App\Models\EnrollmentMahasiswaKelas;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentMahasiswaKelasTable extends Component
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

    public $selectedEnrollmentMahasiswaKelasId = null;

    public function selectEnrollmentMahasiswaKelas($id)
    {
        $this->selectedEnrollmentMahasiswaKelasId = $id;
    }

    public function getSelectedEnrollmentMahasiswaKelasProperty()
    {
        return $this->selectedEnrollmentMahasiswaKelasId
            ? EnrollmentMahasiswaKelas::with(['mahasiswa', 'enrollmentKelas.tahunAkademik', 'enrollmentKelas.programStudi', 'enrollmentKelas.kelas'])->find($this->selectedEnrollmentMahasiswaKelasId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = EnrollmentMahasiswaKelas::with(['mahasiswa', 'enrollmentKelas.tahunAkademik', 'enrollmentKelas.programStudi', 'enrollmentKelas.kelas']);
        if ($this->search) {
            $query->whereHas('mahasiswa', function ($q) {
                $q->where('nama_mahasiswa', 'like', '%' . $this->search . '%')
                    ->orWhere('nim', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('enrollmentKelas.tahunAkademik', function ($q) {
                    $q->where('tahun_ajaran', 'like', '%' . $this->search . '%')->orWhere('status', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('enrollmentKelas.programStudi', function ($q) {
                    $q->where('nama_prodi', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('enrollmentKelas.kelas', function ($q) {
                    $q->where('nama_kelas', 'like', '%' . $this->search . '%');
                });
        }
        return view('livewire.enrollment-mahasiswa-kelas-table', [
            'enrollmentMahasiswaKelas' => $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage),
            'selectedEnrollmentMahasiswaKelas' => $this->selectedEnrollmentMahasiswaKelas,
        ]);
    }
}
