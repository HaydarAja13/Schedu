<?php

namespace App\Livewire;

use App\Models\Jadwal;
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

    public function getKelompokProdiProperty()
    {
        // Query dengan search, sort, dan pagination
        $query = KelompokProdi::with('programStudi')
            ->when($this->search, function ($q) {
                $q->where('nama_kelompok_prodi', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        $kelompokProdi = $query->paginate($this->perPage);

        // Ambil semua program studi yang sudah ada di jadwal
        $prodiIdsInJadwal = Jadwal::with('enrollmentMkMhsDsnRng.enrollmentKelas')
            ->get()
            ->pluck('enrollmentMkMhsDsnRng.enrollmentKelas.id_program_studi')
            ->unique()
            ->toArray();

        // Tambahkan status ke setiap kelompok prodi
        foreach ($kelompokProdi as $kp) {
            $prodiIds = $kp->programStudi->pluck('id')->toArray();
            $kp->status_jadwal = count(array_intersect($prodiIds, $prodiIdsInJadwal)) > 0 ? 'Sudah' : 'Belum';
        }

        return $kelompokProdi;
    }
    public function render()
    {
        return view('livewire.schedule-table', [
            'kelompokProdi' => $this->kelompokProdi, // gunakan accessor
        ]);
    }
}
