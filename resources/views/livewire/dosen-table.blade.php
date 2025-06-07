<x-template :role="'admin'">
    <x-slot name="title">
        <x-table-properties :subtitle="'Dosen'" />
    </x-slot>

    <x-slot name="content">
        <div x-data="{ selectedRow: null }">
            {{-- <x-alert></x-alert> --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.dosen.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                    + Tambah Data
                </a>
            </div>
            
            <div class="grid grid-cols-4 items-center justify-start gap-x-6 size-full">
                <div :class="selectedRow ? 'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-3' : 
                     'overflow-x-hidden overflow-y-auto bg-white rounded-xl col-span-4'"
                     class="transition-all duration-500" style="max-height: calc(100vh - 220px);">
                    <table class="min-w-full divide-y-2 divide-gray-200" @click.away="selectedRow = null">
                        <thead class="ltr:text-left rtl:text-right sticky top-0 bg-gray-100 border-0 text-gray-700 text-xs uppercase z-10">
                            <tr class="*:font-medium *:text-gray-900">
                                <th class="px-3 py-2 whitespace-nowrap">No</th>
                                <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('nama_dosen')">
                                    Nama
                                </th>
                                <th class="px-3 py-2 whitespace-nowrap hover:cursor-pointer" wire:click="setSortBy('nip')">
                                    NIP
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
                            @php $no = 1; @endphp
                            @foreach ($dosen as $data)
                                <tr :class="[
                                    'cursor-pointer transition-all duration-200 hover:bg-gray-100',
                                    selectedRow === '{{ $data->id }}' ? 
                                    'border-l-8 border-l-indigo-600 scale-105 z-10 shadow-xl shadow-indigo-200' : ''
                                ]" @click="selectedRow = '{{ $data->id }}'; $wire.selectDosen({{ $data->id }})">
                                    <td class="py-3 whitespace-nowrap text-sm"
                                        :class="selectedRow === '{{ $data->id }}' ? 'pl-10' : 'px-3'">
                                        {{ $no++ }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-x-4">
                                            <img src="https://avatar.iran.liara.run/public?seed={{ $data->id }}"
                                                alt="" class="size-10">
                                            {{ $data->nama_dosen }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-sm">{{ $data->nip }}</td>
                                    <td class="px-3 py-3 whitespace-nowrap text-sm text-[#8C4AF2] underline">
                                        {{ $data->email }}
                                    </td>
                                    <td :class="{ 'hidden': selectedRow }" class="px-3 py-3 whitespace-nowrap text-sm">
                                        {{ $data->no_hp }}
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
                            Show {{ $dosen->firstItem() ?? 0 }} to {{ $dosen->lastItem() ?? 0 }} from {{ $dosen->total() }}
                        </div>
                        <ul class="flex justify-end gap-1 text-gray-900">
                            <!-- Pagination controls -->
                        </ul>
                    </div>
                </div>

                <div class="bg-white size-full rounded-xl transition-all duration-500 border-2 drop-shadow-lg drop-shadow-[#6B56F6] border-[#6B56F6]"
                    :class="{ 'hidden': !selectedRow }">
                    <div class="size-full flex flex-col justify-start p-4 h-full">
                        <img src="https://placehold.co/50" alt="" class="rounded-full mb-2 size-32 mx-auto">
                        <p class="text-center mb-2 font-semibold text-sm">
                            {{ $selectedDosen?->nama_dosen ?? '-' }}
                        </p>
                        <span class="bg-[#6B56F6]/25 w-fit mx-auto text-[#6B56F6] text-xs font-medium px-2.5 py-0.5 rounded-full border border-[#6B56F6]">Dosen</span>
                        
                        <div class="grid gap-y-2 mt-2 flex-grow">
                            <div>
                                <p class="font-semibold text-sm">NIP</p>
                                <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedDosen?->nip ?? '-', 30) }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Email</p>
                                <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedDosen?->email ?? '-', 30) }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">No Hp</p>
                                <p class="text-sm">{{ \Illuminate\Support\Str::limit($selectedDosen?->no_hp ?? '-', 30) }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-auto flex flex-col gap-2">
                            <button wire:click="editDosen({{ $selectedDosen?->id ?? 'null' }})"
                                class="inline-block rounded-xl bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-4 py-2 text-sm text-center font-medium text-white">
                                Ubah Data
                            </button>
                            <button wire:click="deleteDosen({{ $selectedDosen?->id }})"
                                class="inline-block rounded-xl border border-red-600 px-4 py-2 text-sm text-center font-medium text-white bg-red-600">
                                Hapus Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-template>