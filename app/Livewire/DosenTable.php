<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DosenTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $page = 1; 
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $selectedDosenId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function selectDosen($id)
    {
        $this->selectedDosenId = $id;
    }

    public function getSelectedDosenProperty()
    {
        if (!$this->selectedDosenId) {
            return null;
        }

        $response = Http::get(url('/api/dosen/' . $this->selectedDosenId));
        return $response->successful() ? (object) $response->json() : null;
    }

    public function fetchAndFilterData(): Collection
{
    try {
        $response = Http::get('http://127.0.0.1:8000/api/dosen');
        $data = collect($response->json());

        // Filter
        if ($this->search) {
            $data = $data->filter(function ($item) {
                return str_contains(strtolower($item['nama_dosen']), strtolower($this->search));
            });
        }

        // Sort
        $data = $data->sortBy($this->sortBy, SORT_REGULAR, $this->sortDirection === 'desc');

        return $data->values(); // reset key agar bisa di-paginate
    } catch (\Exception $e) {
        \Log::error('API fetch error: ' . $e->getMessage());
        return collect();
    }
}

    public function render()
{
    $filteredData = $this->fetchAndFilterData();

    $currentPage = $this->page;
    $paginated = new LengthAwarePaginator(
        $filteredData->forPage($currentPage, $this->perPage)->values(),
        $filteredData->count(),
        $this->perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    return view('livewire.dosen-table', [
        'dosenList' => $paginated,
    ]);
}

}
