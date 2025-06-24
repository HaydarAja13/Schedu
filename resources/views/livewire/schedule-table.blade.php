<div>
    <div class="flex items-center justify-between mb-4 mt-2">
        <p class="text-base text-gray-500 hidden md:block">Menampilkan Data Jadwal</p>
        <div
            class="grid grid-cols-3 md:flex md:flex-row items-center w-full justify-between md:w-fit md:justify-center gap-y-2 gap-x-4 md:gap-x-8">
            <div
                class="col-span-2 flex items-center rounded-lg w-full bg-white px-3 py-2 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 mr-2 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input wire:model.live.debounce.300ms="search" type="search"
                    class="block w-full bg-transparent text-base outline-none placeholder:text-gray-400 sm:text-sm/6"
                    placeholder="Cari...">
            </div>
            <a class="inline-block rounded-lg bg-gradient-to-tr w-full md:w-fit from-[#6B56F6] to-[#8C4AF2] px-4 py-2.5 text-sm font-medium text-white hover:bg-gradient-to-bl hover:from-[#7c3bdd] hover:to-[#6955e8]"
                href="schedule-create">
                <div class="flex items-center justify-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                            clip-rule="evenodd" />
                    </svg>
                    Generate
                </div>
            </a>
        </div>
    </div>

    <div class="relative grid size-full grid-cols-1 items-start justify-start gap-x-6 md:grid-cols-4">
        <div
            class="max-h-[calc(100vh-300px)] min-h-[calc(100vh-300px)] transition-all duration-500  md:min-h-[calc(100vh-220px)] md:max-h-[calc(100vh-220px)] overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-4">
            <div class="w-full overflow-x-scroll md:overflow-x-hidden">
                <table class="w-full table-auto divide-y-2 divide-gray-200">
                    <thead
                        class="sticky top-0 z-10 border-0 bg-gray-100 text-xs uppercase text-gray-700 ltr:text-left rtl:text-right">
                        <tr class="*:font-medium *:text-gray-900">
                            <th class="whitespace-nowrap px-3 py-2">No</th>
                            <th class="whitespace-nowrap px-3 py-2 hover:cursor-pointer"
                                wire:click="setSortBy('nama_kelompok_prodi')">
                                Kelompok Program Studi
                            </th>
                            <th class="text-center whitespace-nowrap px-3 py-2 hover:cursor-pointer">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($kelompokProdi as $data)
                        <tr>
                            <td class="whitespace-nowrap py-3 text-sm pl-3">
                                {{ $no++ }}</td>
                            <td class="whitespace-nowrap px-3 py-3 text-sm font-medium">
                                {{ $data->nama_kelompok_prodi ?? '-' }}
                            </td>
                            <td class="text-right pr-8">
                                <span
                                    class="inline-flex divide-x divide-gray-300 overflow-hidden rounded border border-gray-300 bg-white shadow-sm">
                                    <button type="button"
                                        class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative">
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="px-3 py-1.5 text-sm font-medium text-red-700 transition-colors hover:bg-gray-50 hover:text-red-900 focus:relative">
                                        Hapus
                                    </button>

                                    <button type="button"
                                        class="px-3 py-1.5 text-sm font-medium text-purple-700 transition-colors hover:bg-gray-50 hover:text-purple-900 focus:relative">
                                        Detail
                                    </button>
                                </span>
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
                    {{ $kelompokProdi->firstItem() ?? 0 }}
                    hingga
                    {{ $kelompokProdi->lastItem() ?? 0 }}
                    dari
                    {{ $kelompokProdi->total() }}
                </div>
                <ul class="flex items-center justify-end gap-2 text-gray-900">
                    <li>
                        <button type="button"
                            class="grid size-6 place-content-center rounded text-gray-600 transition-all duration-300 hover:scale-125 hover:text-purple-600 md:size-8 rtl:rotate-180"
                            aria-label="Previous page" wire:click="previousPage" @if ($kelompokProdi->onFirstPage())
                            disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 md:size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>

                    @php
                    $currentPage = $kelompokProdi->currentPage();
                    $lastPage = $kelompokProdi->lastPage();
                    $start = max(1, $currentPage - 1);
                    $end = min($lastPage, $currentPage + 1);

                    if ($currentPage <= 3) { $start=1; $end=min(3, $lastPage); } elseif ($currentPage>= $lastPage - 2) {
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

                        @for ($page = $start; $page <= $end; $page++) @if ($page==$currentPage) <li
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

                            @if ($end < $lastPage) @if ($end < $lastPage - 1) <li class="flex items-center px-2">...
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
                                        aria-label="Next page" wire:click="nextPage" @if ($kelompokProdi->currentPage()
                                        == $kelompokProdi->lastPage()) disabled @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-4 md:size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </li>
                </ul>
            </div>

        </div>
    </div>
</div>