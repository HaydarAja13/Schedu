<?php

namespace App\Livewire;

use App\Models\MataKuliah;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class MataKuliahTable extends Component
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

    public $selectedMataKuliahId = null;

    public function selectMataKuliah($id)
    {
        $this->selectedMataKuliahId = $id;
    }

    public function getSelectedMataKuliahProperty()
    {
        return $this->selectedMataKuliahId
            ? MataKuliah::find($this->selectedMataKuliahId)
            : null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $role = session('role');
        $user = session('user');
        $query = MataKuliah::query();

        if ($role === 'dosen') {
            // Ambil id dosen dari session user
            $idDosen = $user['id'] ?? $user->id_dosen ?? null;

            // Join ke tabel enrollment_mk_mhs_dsn_rng dan filter id_dosen
            $query->whereHas('enrollments', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });
        } elseif ($role === 'mahasiswa') {
            // Ambil id mahasiswa dari session user
            $idMahasiswa = $user['id'] ?? $user->id_mahasiswa ?? null;

            // Join ke tabel enrollment_mahasiswa_kelas dan filter id_mahasiswa
            $query->whereHas('enrollmentMahasiswaKelas', function ($q) use ($idMahasiswa) {
                $q->where('id_mahasiswa', $idMahasiswa);
            });
        }

        // Tambahkan pencarian, sorting, dan pagination
        $mataKuliah = $query
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.mata-kuliah-table', [
            'role' => $role,
            'mataKuliah' => $mataKuliah,
            'selectedMataKuliah' => $this->selectedMataKuliah,
        ]);
    }
}