<div x-data="{ selectedRow: null }">
    {{-- <x-alert></x-alert> --}}
    <x-table-properties :subtitle="'Data Mahasiswa'"></x-table-properties>
    <div class="grid grid-cols-4 items-center justify-start gap-x-6 size-full">
        <div :class="selectedRow ? 'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-3' : 'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-4'"
            class="transition-all duration-500" style="max-height: calc(100vh - 220px);">
            <table class="min-w-full divide-y-2 divide-gray-200" @click.away="selectedRow = null">
                <thead
                    class="ltr:text-left rtl:text-right sticky top-0 bg-gray-100 border-0 text-gray-700 text-xs uppercase z-10">
                    <tr class="*:font-medium *:text-gray-900">
                        <th class="px-3 py-2 whitespace-nowrap">No</th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer"
                            wire:click="setSortBy('nama_mahasiswa')">
                            Nama</th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('nim')">NIM
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('email')">
                            Email
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('no_hp')"
                            :class="{ 'hidden': selectedRow }">
                            Telp
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($mahasiswa as $data)
                    <tr :class="[
                            'cursor-pointer transition-all duration-200 hover:bg-gray-100',
                            selectedRow === '{{ $data->id }}' ? 'border-l-8 border-l-indigo-600 scale-105 z-10 shadow-xl shadow-indigo-200' : ''
                        ]" @click="selectedRow = '{{ $data->id }}'; $wire.selectMahasiswa({{ $data->id }})">
                        <td class="py-3 whitespace-nowrap text-sm" :class="selectedRow === '{{ $data->id }}' ? 'pl-10' : 'px-3'">{{ $no++ }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium ">
                            <div class="flex items-center gap-x-4">
                                <img src="https://avatar.iran.liara.run/public?seed={{ $data->id }}" alt="" class="size-10">
                                {{ $data->nama_mahasiswa }}
                            </div>
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm">{{ $data->nim }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-[#8C4AF2] underline">{{ $data->email }}</td>
                        <td :class="{ 'hidden': selectedRow }" class="px-3 py-3 whitespace-nowrap text-sm">{{
                            $data->no_hp }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex items-center justify-between w-full sticky bottom-0 p-4 bg-white">
                <div class="flex gap-x-4 items-center">
                    <label for="country" class="block text-sm/6 font-medium text-gray-900">Per Page</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select wire:model.live='perPage' id="country" name="country" autocomplete="country-name"
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
                <div class="text-sm text-gray-800 font-light mt-2">
                    Show
                    {{ $mahasiswa->firstItem() ?? 0 }}
                    to
                    {{ $mahasiswa->lastItem() ?? 0 }}
                    from
                    {{ $mahasiswa->total() }}
                </div>
                <ul class="flex justify-end gap-1 text-gray-900">
                    <li>
                        <button type="button"
                            class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                            aria-label="Previous page" wire:click="previousPage" @if ($mahasiswa->onFirstPage())
                            disabled
                            @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>

                    @php
                    $currentPage = $mahasiswa->currentPage();
                    $lastPage = $mahasiswa->lastPage();
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
                                        class="grid size-8 place-content-center rounded text-gray-600 hover:text-purple-600 hover:scale-125 transition-all duration-300 rtl:rotate-180"
                                        aria-label="Next page" wire:click="nextPage" @if ($mahasiswa->currentPage() ==
                                        $mahasiswa->lastPage()) disabled @endif>
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
        <div class="bg-white size-full rounded-xl transition-all duration-500 border-2 drop-shadow-lg drop-shadow-[#6B56F6] border-[#6B56F6]"
            :class="{ 'hidden': !selectedRow }">
            <div class="size-full flex flex-col justify-start p-4 h-full">
                <img src="https://placehold.co/50" alt="" class="rounded-full mb-2 size-32 mx-auto">
                <p class="text-center mb-2 font-semibold text-sm">
                    {{ $selectedMahasiswa?->nama_mahasiswa ?? '-' }}
                </p>
                <span
                    class="bg-[#6B56F6]/25 w-fit mx-auto text-[#6B56F6] text-xs font-medium px-2.5 py-0.5 rounded-full border border-[#6B56F6]">Mahasiswa</span>
                <div class="grid gap-y-2 mt-2 flex-grow">
                    <div>
                        <p class="font-semibold text-sm">NIM</p>
                        <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->nim ?? '-', 30) }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">Email</p>
                        <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->email ?? '-', 30) }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">No Hp</p>
                        <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedMahasiswa?->no_hp ?? '-', 30) }}</p>
                    </div>
                </div>
                <div class="mt-auto flex flex-col gap-2">
                    <a class="inline-block rounded-xl bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-12 py-2 text-sm text-center font-medium text-white"
                        href="#">
                        Ubah Data
                    </a>
                    <a class="inline-block rounded-xl border border-red-600 px-12 py-2 text-sm text-center font-medium text-white bg-red-600"
                        href="#">
                        Hapus Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>