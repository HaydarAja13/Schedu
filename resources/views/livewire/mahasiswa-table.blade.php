<div x-data="{ selectedRow: null, showAlert: false }" @delete-row.window="$wire.delete(selectedRow); showAlert = false">
    <x-table-properties :subtitle="'Menampilkan Data Mahasiswa'" link="/admin/mahasiswa/create"></x-table-properties>
    <div class="relative grid grid-cols-1 md:grid-cols-4 items-start justify-start gap-x-6 size-full">
        <div :class="selectedRow ? 'overflow-x-hidden overflow-y-auto bg-white rounded-xl md:col-span-3' : 'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-4'"
            class="transition-all duration-500 max-h-[calc(100vh-300px)] md:max-h-[calc(100vh-220px)]">
            <table class="min-w-full divide-y-2 divide-gray-200" @click.away="selectedRow = null">
                <thead class="ltr:text-left rtl:text-right h-12 sticky top-0 bg-gray-100 text-gray-700 text-xs uppercase z-10">
                    <tr class="*:font-medium *:text-gray-500">
                        <th class="px-6 py-2 whitespace-nowrap">No</th>
                        <th class="px-6 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('nama_mahasiswa')">
                            Nama</th>
                        <th class="px-6 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('nim')">NIM
                        </th>
                        <th class="px-6 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('email')">
                            Email
                        </th>
                        <th class="px-6 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('no_hp')"
                            :class="{ 'hidden': selectedRow }">
                            Telp
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#8C4AF2]">
                    @php
                    $no = $mahasiswa->firstItem();
                    @endphp
                    @foreach ($mahasiswa as $data)
                    @php
                        $initials = collect(explode(' ', $data->nama_mahasiswa))
                                        ->filter(fn($n) => !empty($n))
                                        ->map(fn($n) => strtoupper($n[0]))
                                        ->take(2)
                                        ->implode('');
                    @endphp
                    <tr :class="[
                            'border-b border-b-gray-200 hover:bg-gray-50 cursor-pointer',
                            selectedRow === '{{ $data->id }}' ? 'border-l-8 border-l-[#8C4AF2]-600 scale-105 z-10 shadow-[0_8px_8px_0_rgba(140,74,242,0.08),0_-8px_8px_0_rgba(140,74,242,0.08)]' : ''
                        ]" @click="selectedRow = '{{ $data->id }}'; showAlert = false; $wire.selectMahasiswa({{ $data->id }})">
                        <td class="px-6 py-3">{{ $no++ }}</td>
                        <td class="px-6 py-3 flex items-center gap-3 whitespace-nowrap">
                            @if ($data->foto) 
                                <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Profil" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white flex items-center justify-center font-semibold text-xs uppercase">
                                    {{ $initials }}
                                </div>
                            @endif
                            <span class="font-medium text-gray-900">{{ $data->nama_mahasiswa }}</span>
                        </td>
                        <td class="px-6 py-3">{{ $data->nim }}</td>
                        <td class="px-6 py-3 text-purple-600 underline">{{ \Illuminate\Support\Str::limit($data->email, 25) }}</td>
                        <td :class="{ 'hidden': selectedRow }" class="px-6 py-3">{{ $data->no_hp }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div
                class="flex flex-col md:flex-row gap-y-2 items-center justify-between w-full sticky bottom-0 p-4 bg-white">
                <div class="flex gap-x-4 items-center">
                    <label for="country" class="block text-sm/6 font-medium text-gray-900">Halaman</label>
                    <div class="grid grid-cols-1">
                        <select wire:model.live='perPage' id="country" name="country" autocomplete="country-name"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-sm md:text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="text-sm text-gray-800 italic mt-2 font-light mt-2">
                    Menampilkan
                    {{ $mahasiswa->firstItem() ?? 0 }}
                    hingga
                    {{ $mahasiswa->lastItem() ?? 0 }}
                    dari
                    {{ $mahasiswa->total() }}
                </div>
                <ul class="flex justify-end items-center gap-2 text-gray-900">
                    <li>
                        <button type="button"
                            class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                            aria-label="Previous page"
                            wire:click="previousPage"
                            @if ($mahasiswa->onFirstPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>
                
                    @php
                        $currentPage = $mahasiswa->currentPage();
                        $lastPage = $mahasiswa->lastPage();
                        // Tentukan start dan end agar selalu 3 angka
                        if ($lastPage <= 3) {
                            $start = 1;
                            $end = $lastPage;
                        } else {
                            if ($currentPage == 1) {
                                $start = 1;
                                $end = 3;
                            } elseif ($currentPage == $lastPage) {
                                $start = $lastPage - 2;
                                $end = $lastPage;
                            } else {
                                $start = $currentPage - 1;
                                $end = $currentPage + 1;
                            }
                            // Pastikan tidak kurang dari 1
                            $start = max(1, $start);
                            $end = min($lastPage, $end);
                        }
                    @endphp
                
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $currentPage)
                            <li class="block size-8 rounded-full bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] text-center text-sm/8 font-medium text-white">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <button type="button"
                                    class="block size-8 rounded-full border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50"
                                    wire:click="gotoPage({{ $page }})">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endfor
                    <li>
                        <button type="button"
                            class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                            aria-label="Next page"
                            wire:click="nextPage"
                            @if ($mahasiswa->currentPage() == $mahasiswa->lastPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div x-show="selectedRow" x-transition.opacity class="fixed inset-0 bg-black/60 z-40 md:hidden"
            :class="{ 'hidden': !selectedRow }">
        </div>

        <div class="bg-white size-full rounded-xl transition-all duration-500 border-2 border-[#6B56F6]"
            :class="{ 'hidden': !selectedRow }">
            <div class="size-full flex flex-col justify-start p-4">
                @if ($selectedMahasiswa?->foto)
                    <img src="{{ asset('storage/' .$selectedMahasiswa->foto) }}" alt="Foto Profil" class="rounded-full mb-2 size-32 mx-auto">
                @else
                    @php
                        $initials = collect(explode(' ', $selectedMahasiswa?->nama_mahasiswa ?? ''))
                                        ->filter(fn($n) => !empty($n))
                                        ->map(fn($n) => strtoupper($n[0]))
                                        ->take(2)
                                        ->implode('');
                    @endphp
                    <div class="rounded-full mb-2 size-32 mx-auto bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white flex items-center justify-center font-bold text-4xl">
                        {{ $initials }}
                    </div>
                @endif
                    <p class="text-center mb-2 font-semibold text-sm">
                    {{ $selectedMahasiswa?->nama_mahasiswa ?? '-' }}
                </p>
                <span
                    class="bg-[#6B56F6]/25 w-fit mx-auto text-[#6B56F6] text-xs font-medium px-2.5 py-0.5 rounded-full border border-[#6B56F6]">Mahasiswa</span>
                <div class="grid gap-y-2 mt-6">
                    <div>
                        <p class="font-semibold text-sm">NIM</p>
                        <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->nim ?? '-', 30) }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">Email</p>
                        <p class="text-sm text-purple-600">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->email ?? '-', 30) }}
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">No Hp</p>
                        <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->no_hp ?? '-', 30) }}
                        </p>
                    </div>
                    <div class="my-10"></div>
                    <a class="inline-block rounded-xl  bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-12 py-2 text-sm text-center font-medium text-white "
                        href="/admin/mahasiswaUpdate/{{ $selectedMahasiswa?->id }}">
                        Edit Data
                    </a>
                    <button
                        class="hover:cursor-pointer inline-block rounded-xl border border-red-600 px-12 py-2 text-sm text-center font-medium text-white bg-red-600"
                        type="button" @click="showAlert = true">
                        Hapus Data {{ $selectedMahasiswa?->id ?? '-' }}
                    </button>
                </div>
            </div>
        </div>  
    </div>
    <div x-show="showAlert" class="mb-4">
        <x-alert titleModal="Peringatan"
            contentModal="Apakah anda yakin ingin menghapus {{ $selectedMahasiswa?->id ?? '-' }}" type="warning"
            :route="route('mahasiswa.destroy', $selectedMahasiswa?->id ?? '')" />
    </div>
</div>