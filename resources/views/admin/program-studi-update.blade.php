<x-template :role="'admin'" title="Edit Program Studi ">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('program-studi.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 items-center md:grid-cols-3 gap-4 mb-4">
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Nama Program Studi <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Nama Program Studi</p>
                        </div>
                        <input type="text" name="nama_prodi" required value="{{ $programStudi->nama_prodi }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Kode Program Studi <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Kode Program Studi</p>
                        </div>
                        <input type="text" name="kode_prodi" required value="{{ $programStudi->kode_prodi }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                    </div>
                    <x-form.select :label="'Nama Jurusan'" :description="'Pilih Jurusan'" :placeholder="'Pilih'"
                        :options="$jurusan" valueField="id" displayField="nama_jurusan" id="id_jurusan"
                        name="id_jurusan" :selected="$programStudi->id_jurusan" />
                    <x-form.select :label="'Nama Kelompok Prodi'" :description="'Pilih Kelompok'" :placeholder="'Pilih'"
                        :options="$kelompokProdi" valueField="id" displayField="nama_kelompok_prodi"
                        id="id_kelompok_prodi" name="id_kelompok_prodi" :selected="$programStudi->id_kelompok_prodi" />
                    <x-form.button-group page="program-studi" />
                </div>
            </form>

        </div>
    </x-slot:content>
</x-template>