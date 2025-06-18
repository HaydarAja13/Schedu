<x-template :role="'admin'" title="Tambah Ruang ">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('ruang.store') }}" method="POST">
                @csrf
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 items-center md:grid-cols-3 gap-4 mb-4">
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Nama Ruang <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Nama Ruang</p>
                        </div>
                        <input type="text" name="nama_ruang" required placeholder="cth: GKT 801"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Ketersediaan Ruang <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Ketersediaan Ruang</p>
                        </div>
                        <input type="hidden" name="keterangan" value="0" />
                        <label for="AcceptConditions"
                            class="group relative block h-6 w-12 rounded-full bg-gray-300 transition-colors [-webkit-tap-highlight-color:_transparent] has-checked:bg-purple-500">
                            <input type="checkbox" id="AcceptConditions" class="peer sr-only" name="keterangan"
                                value="1" />

                            <span
                                class="absolute inset-y-0 start-0 m-1 grid size-4 place-content-center rounded-full bg-white text-gray-700 transition-[inset-inline-start] peer-checked:start-6 peer-checked:*:first:hidden *:last:hidden peer-checked:*:last:block">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </span>
                        </label>

                    </div>
                    <x-form.select :label="'Nama Kelompok Prodi'" :description="'Pilih Kelompok'" :placeholder="'Pilih'"
                        :options="$kelompokProdi" valueField="id" displayField="nama_kelompok_prodi" id="id_kelompok_prodi"
                        name="id_kelompok_prodi" />
                    <x-form.button-group page="ruang" />
                </div>
            </form>

        </div>
    </x-slot:content>
</x-template>