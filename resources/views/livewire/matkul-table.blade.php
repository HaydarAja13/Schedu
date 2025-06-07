<div x-data="{ selectedRow: null }">
    <x-table-properties :subtitle="'Data Mata Kuliah'"></x-table-properties>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.mata-kuliah.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            + Tambah Data
        </a>
    </div>

    <div class="grid grid-cols-4 items-center justify-start gap-x-6 size-full">
        <div class="overflow-x-auto overflow-y-auto bg-white rounded-xl col-span-4 transition-all duration-500">
            <table class="min-w-full divide-y-2 divide-gray-200" @click.away="selectedRow = null">
                <thead class="ltr:text-left rtl:text-right sticky top-0 bg-gray-100 text-gray-700 text-xs uppercase z-10">
                    <tr class="*:font-medium *:text-gray-900">
                        <th class="px-3 py-2 whitespace-nowrap">No</th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('kode_matkul')">
                            Kode Mata Kuliah
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('nama_matkul')">
                            Nama Mata Kuliah
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('sks')">
                            SKS
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('jam')">
                            Jam
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('semester')">
                            Semester
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('id_ruang')">
                            Ruang
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('jenis')">
                            Jenis
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($mata_kuliah as $data)
                        <tr :class="[
                            'cursor-pointer transition-all duration-200 hover:bg-gray-100',
                            selectedRow === '{{ $data->id }}' ? 'border-l-8 border-l-indigo-600' : ''
                        ]" @click="selectedRow = '{{ $data->id }}'; $wire.selectMataKuliah({{ $data->id }})">
                            <td class="px-3 py-2 whitespace-nowrap">{{ $no++ }}</td>
                            <td class="px-3 py-2 whitespace-nowrap font-medium">{{ $data->kode_matkul }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->nama_matkul }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->sks }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->jam }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->semester }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->ruang->nama_ruang ?? '-' }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->jenis == 'T' ? 'Teori' : 'Praktikum' }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.mata-kuliah.edit', $data->id) }}"
                                       class="inline-block rounded-xl bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-4 py-2 text-sm text-center font-medium text-white">
                                        Ubah
                                    </a>
                                    <button wire:click="deleteMataKuliah({{ $data->id }})"
                                            class="inline-block rounded-xl border border-red-600 px-4 py-2 text-sm text-center font-medium text-white bg-red-600">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex items-center justify-between w-full sticky bottom-0 p-4 bg-white">
                <div class="">
                    <label for="perPage" class="block text-sm/6 font-medium text-gray-900">Per Page</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select wire:model.live="perPage" id="perPage" name="perPage" autocomplete="per-page"
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
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
                <div class="text-sm text-gray-800 font-semibold mt-2">
                    Show
                    {{ $mata_kuliah->firstItem() ?? 0 }}
                    to
                    {{ $mata_kuliah->lastItem() ?? 0 }}
                    from
                    {{ $mata_kuliah->total() }}
                </div>
                <ul class="flex justify-end gap-1 text-gray-900">
                    <li>
                        <button type="button"
                                class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                                aria-label="Previous page" wire:click="previousPage" @if ($mata_kuliah->onFirstPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>

                    @php
                        $currentPage = $mata_kuliah->currentPage();
                        $lastPage = $mata_kuliah->lastPage();
                        $start = max(1, $currentPage - 1);
                        $end = min($lastPage, $currentPage + 1);

                        if ($currentPage <= 3) {
                            $start = 1;
                            $end = min(3, $lastPage);
                        } elseif ($currentPage >= $lastPage - 2) {
                            $start = max(1, $lastPage - 2);
                            $end = $lastPage;
                        }
                    @endphp

                    @if ($start > 1)
                        <li>
                            <button type="button"
                                    class="block size-8 rounded-full border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50"
                                    wire:click="gotoPage(1)">
                                1
                            </button>
                        </li>
                        @if ($start > 2)
                            <li class="flex items-center px-2">...</li>
                        @endif
                    @endif

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

                    @if ($end < $lastPage)
                        @if ($end < $lastPage - 1)
                            <li class="flex items-center px-2">...</li>
                        @endif
                        <li>
                            <button type="button"
                                    class="block size-8 rounded-full border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50"
                                    wire:click="gotoPage({{ $lastPage }})">
                                {{ $lastPage }}
                            </button>
                        </li>
                    @endif

                    <li>
                        <button type="button"
                                class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                                aria-label="Next page" wire:click="nextPage" @if ($mata_kuliah->currentPage() == $mata_kuliah->lastPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</xArtifact>
