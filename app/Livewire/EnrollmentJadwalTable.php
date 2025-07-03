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
        $query = EnrollmentMkMhsDsnRng::with(['mataKuliah', 'enrollmentKelas.programStudi', 'enrollmentKelas.kelas', 'enrollmentKelas.angkatan', 'dosen']);
        if ($this->search) {
            $query->whereHas('mataKuliah', function ($q) {
                $q->where('nama_matkul', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('enrollmentKelas.tahunAkademik', function ($q) {
                    $q->where('tahun_ajaran', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('enrollmentKelas.programStudi', function ($q) {
                    $q->where('nama_prodi', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('enrollmentKelas.kelas', function ($q) {
                    $q->where('nama_kelas', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('dosen', function ($q) {
                    $q->where('nama_dosen', 'like', '%' . $this->search . '%');
                })
                // Tambahkan pencarian kelas lengkap
                ->orWhereHas('enrollmentKelas', function ($q) {
                    $q->whereRaw("CONCAT_WS('-', 
                    (SELECT kode_prodi FROM program_studi WHERE program_studi.id = enrollment_kelas.id_program_studi LIMIT 1),
                    (SELECT tahun_angkatan FROM angkatan WHERE angkatan.id = enrollment_kelas.id_angkatan LIMIT 1),
                    (SELECT nama_kelas FROM kelas WHERE kelas.id = enrollment_kelas.id_kelas LIMIT 1)
                ) LIKE ?", ['%' . $this->search . '%']);
                });
        }
        return view('livewire.enrollment-jadwal-table', [
            'enrollmentJadwal' => $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage),
            'selectedEnrollmentJadwal' => $this->selectedEnrollmentJadwal,
        ]);
    }
}
