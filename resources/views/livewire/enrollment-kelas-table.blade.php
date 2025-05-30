<div x-data="{ selectedRow: null, showAlert: false }">
    <x-table-properties :subtitle="'Menampilkan Data Enrollment Kelas'" link="enrollment-kelas-create"></x-table-properties>
    <div class="relative grid size-full grid-cols-1 items-center justify-start gap-x-6 md:grid-cols-4">
        <div :class="selectedRow ? 'overflow-x-hidden overflow-y-auto bg-white rounded-xl md:col-span-3' :
            'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-4'"
            class="max-h-[calc(100vh-300px)] transition-all duration-500 md:max-h-[calc(100vh-220px)]">
            <div class="w-full overflow-x-scroll md:overflow-x-hidden">
                <table class="w-full table-auto divide-y-2 divide-gray-200" @click.away="selectedRow = null">
                    <thead
                        class="sticky top-0 z-10 border-0 bg-gray-100 text-xs uppercase text-gray-700 ltr:text-left rtl:text-right">
                        <tr class="*:font-medium *:text-gray-900">
                            <th class="whitespace-nowrap px-3 py-2">No</th>
                            <th class="whitespace-nowrap px-3 py-2 hover:cursor-pointer"
                                wire:click="setSortBy('id_tahun_akademik')">
                                Tahun Akademik</th>
                            <th class="whitespace-nowrap px-3 py-2 hover:cursor-pointer"
                                wire:click="setSortBy('id_program_studi')">
                                Program Studi
                            </th>
                            <th class="whitespace-nowrap px-3 py-2 hover:cursor-pointer"
                                wire:click="setSortBy('id_kelas')">
                                Kelas
                            </th>
                            <th class="whitespace-nowrap px-3 py-2 hover:cursor-pointer"
                                wire:click="setSortBy('id_angkatan')" :class="{ 'hidden': selectedRow }">
                                Angkatan
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($enrollmentKelas as $data)
                            <tr :class="[
                                'cursor-pointer transition-all duration-200 hover:bg-gray-100',
                                selectedRow === '{{ $data->id }}' ?
                                'border-l-8 border-l-indigo-600 scale-105 z-10 shadow-xl shadow-indigo-200' : ''
                            ]"
                                @click="selectedRow = '{{ $data->id }}'; $wire.selectEnrollmentKelas({{ $data->id }})">
                                <td class="whitespace-nowrap py-3 text-sm"
                                    :class="selectedRow === '{{ $data->id }}' ? 'pl-10' : 'px-3'">
                                    {{ $no++ }}</td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm font-medium">
                                    {{ $data->tahunAkademik->tahun_ajaran ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm">
                                    {{ $data->programStudi->nama_prodi ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm">
                                    {{ $data->kelas->nama_kelas ?? '-' }}
                                </td>
                                <td :class="{ 'hidden': selectedRow }" class="whitespace-nowrap px-3 py-3 text-sm">
                                    {{ $data->angkatan->tahun_angkatan ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div
                class="sticky bottom-0 flex w-full flex-col items-center justify-between gap-y-2 bg-white p-4 md:flex-row">
                <div class="flex items-center gap-x-4">
                    <label for="perPage" class="block text-sm/6 font-medium text-gray-900">Halaman</label>
                    <div class="grid grid-cols-1">
                        <select wire:model.live='perPage' id="perPage" name="perPage" autocomplete="off"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-sm text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 md:text-base">
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
                <div class="mt-2 text-sm font-light text-gray-800">
                    Menampilkan
                    {{ $enrollmentKelas->firstItem() ?? 0 }}
                    hingga
                    {{ $enrollmentKelas->lastItem() ?? 0 }}
                    dari
                    {{ $enrollmentKelas->total() }}
                </div>
                <ul class="flex items-center justify-end gap-2 text-gray-900">
                    <li>
                        <button type="button"
                            class="grid size-6 place-content-center rounded text-gray-600 transition-all duration-300 hover:scale-125 hover:text-purple-600 md:size-8 rtl:rotate-180"
                            aria-label="Previous page" wire:click="previousPage"
                            @if ($enrollmentKelas->onFirstPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 md:size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>

                    @php
                        $currentPage = $enrollmentKelas->currentPage();
                        $lastPage = $enrollmentKelas->lastPage();
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
                            <li
                                class="block size-8 rounded-full bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] text-center text-sm/8 font-medium text-white">
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
                            <li class="flex items-center px-2">...
                            </li>
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
                            class="grid size-6 place-content-center rounded text-gray-600 transition-all duration-300 hover:scale-125 hover:text-purple-600 md:size-8 rtl:rotate-180"
                            aria-label="Next page" wire:click="nextPage"
                            @if ($enrollmentKelas->currentPage() == $enrollmentKelas->lastPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 md:size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div x-show="selectedRow" x-transition.opacity class="fixed inset-0 z-40 bg-black/60 md:hidden"
            :class="{ 'hidden': !selectedRow }">
        </div>
        <div class="absolute inset-0 z-50 m-auto h-fit max-w-xs rounded-xl border-2 border-[#6B56F6] bg-white drop-shadow-[#6B56F6] drop-shadow-lg transition-all duration-500 md:static md:size-full"
            :class="{ 'hidden': !selectedRow }">
            <div class="flex size-full h-full flex-col justify-start p-4">
                <img src="https://placehold.co/50" alt="" class="mx-auto mb-2 size-32 rounded-full">
                <p class="mb-2 text-center text-sm font-semibold">
                    {{ $selectedEnrollmentKelas?->kelas->nama_kelas ?? '-' }}
                </p>
                <span
                    class="mx-auto w-fit rounded-full border border-[#6B56F6] bg-[#6B56F6]/25 px-2.5 py-0.5 text-xs font-medium text-[#6B56F6]">Enrollment
                    Kelas</span>
                <div class="mt-2 grid flex-grow gap-y-2">
                    <div>
                        <p class="text-sm font-semibold">Tahun Akademik</p>
                        <p class="text-sm">{{ $selectedEnrollmentKelas?->tahunAkademik->tahun_ajaran ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Program Studi</p>
                        <p class="text-sm">{{ $selectedEnrollmentKelas?->programStudi->nama_prodi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Angkatan</p>
                        <p class="text-sm">{{ $selectedEnrollmentKelas?->angkatan->tahun_angkatan ?? '-' }}</p>
                    </div>
                </div>
                <div class="mt-8 flex flex-col gap-2 md:mt-auto">
                    <a class="inline-block rounded-xl bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-12 py-2 text-center text-sm font-medium text-white"
                        href="{{ route('admin.enrollment-kelas-update', $selectedEnrollmentKelas?->id ?? '') }}">
                        Ubah Data
                    </a>
                    <button
                        class="inline-block rounded-xl border border-red-600 bg-red-600 px-12 py-2 text-center text-sm font-medium text-white hover:cursor-pointer"
                        type="button" @click="showAlert = true">
                        Hapus Data {{ $selectedEnrollmentKelas?->id ?? '-' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-show="showAlert" class="mb-4">
        <x-alert titleModal="Peringatan"
            contentModal="Apakah anda yakin ingin menghapus {{ $selectedEnrollmentKelas?->id ?? '-' }}"
            type="warning" :route="route('enrollment-kelas.destroy', $selectedEnrollmentKelas?->id ?? '')" />
    </div>
</div>
