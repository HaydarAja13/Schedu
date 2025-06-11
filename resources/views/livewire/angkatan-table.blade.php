<div x-data="{ selectedRow: null, showAlert: false }">
    <x-table-properties :subtitle="'Data Angkatan'" link="angkatan-create"></x-table-properties>
    <div class="grid grid-cols-1 items-center justify-start gap-x-6 size-full">
        <div class="overflow-x-auto overflow-y-auto bg-white rounded-xl col-span-4 transition-all duration-500" style="max-height: calc(100vh - 250px);">
            <table class="min-w-full divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right sticky top-0 bg-white z-10 shadow-sm">
                    <tr class="*:font-medium *:text-gray-900">
                        <th class="px-3 py-2 whitespace-nowrap">No</th>
                        <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('tahun_angkatan')">
                            Tahun Angkatan
                        </th>
                        <th class="px-3 py-2 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach ($angkatan as $data)
                        <tr class="cursor-pointer *:text-gray-900 *:first:font-medium transition-all duration-200 hover:bg-gray-200">
                            <td class="px-3 py-2 whitespace-nowrap">{{ $no++ }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $data->tahun_angkatan }}</td>
                            <td class="px-3 py-2 whitespace-nowrap flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.angkatan-update', $data?->id ?? '') }}"
                                    class="inline-flex items-center gap-1 rounded-md bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] text-white px-3 py-1 font-medium text-sm">
                                    Edit
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('angkatan.destroy', $data->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <div x-data="{ showAlert: false }">
                                        <button type="button"
                                            class="inline-flex items-center font-medium gap-1 rounded-md bg-red-600 text-white px-3 py-1 text-sm"
                                            @click="showAlert = true">
                                            Hapus
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                        <div x-show="showAlert" class="mb-4" style="display: none;" x-cloak>
                                            <x-alert titleModal="Peringatan"
                                                contentModal="Apakah anda yakin ingin menghapus data ini?"
                                                type="warning" :route="route('angkatan.destroy', $data->id)" @close-modal="showAlert = false" />
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex items-center justify-between w-full sticky bottom-0 p-4 bg-white">
                <div class="">
                    <label for="perPage" class="block text-sm/6 font-medium text-gray-900">Per Page</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select wire:model.live='perPage' id="perPage" name="perPage" autocomplete="off"
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
                    Menampilkan
                    {{ $angkatan->firstItem() ?? 0 }}
                    hingga
                    {{ $angkatan->lastItem() ?? 0 }}
                    dari
                    {{ $angkatan->total() }}
                </div>
                <ul class="flex justify-end gap-1 text-gray-900">
                    <li>
                        <button type="button"
                            class="grid size-8 place-content-center rounded transition-colors hover:bg-gray-50 rtl:rotate-180"
                            aria-label="Previous page" wire:click="previousPage"
                            @if ($angkatan->onFirstPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </li>
                    @php
                        $currentPage = $angkatan->currentPage();
                        $lastPage = $angkatan->lastPage();
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
                            <li class="block size-8 rounded-full border border-indigo-600 bg-indigo-600 text-center text-sm/8 font-medium text-white">
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
                            class="grid size-8 place-content-center rounded transition-colors hover:bg-gray-50 rtl:rotate-180"
                            aria-label="Next page" wire:click="nextPage"
                            @if ($angkatan->currentPage() == $angkatan->lastPage()) disabled @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>