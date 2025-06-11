<x-template :role="'admin'" title="Edit Mata Kuliah ">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('mata-kuliah.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 items-center md:grid-cols-3 gap-4 mb-4">
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Kode Mata Kuliah <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Kode Mata Kuliah</p>
                        </div>
                        <input type="text" name="kode_matkul" required value="{{ $mataKuliah->kode_matkul }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Nama Mata Kuliah <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Nama Mata Kuliah</p>
                        </div>
                        <input type="text" name="nama_matkul" required value="{{ $mataKuliah->nama_matkul }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">SKS <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan SKS Mata Kuliah ini</p>
                        </div>
                        <input type="number" name="sks" required value="{{ $mataKuliah->sks }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Jam <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan berapa Jam Mata Kuliah ini berlangsung</p>
                        </div>
                        <input type="number" name="jam" required value="{{ $mataKuliah->jam }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Semester <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Semester ke berapa Mata Kuliah ini berada</p>
                        </div>
                        <input type="number" name="semester" required value="{{ $mataKuliah->semester }}"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        <div class="w-72">
                            <label class=" whitespace-nowrap  text-sm md:text-base">Jenis Mata Kuliah <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Pilih Jenis Mata Kuliah</p>
                        </div>
                        <select name="jenis" id="jenis" required
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500">
                            <option value="{{ $mataKuliah->jenis }}" disabled selected>{{ $mataKuliah->jenis == 'T' ?
                                'Teori' : ($mataKuliah->jenis == 'P' ? 'Praktikum' : $mataKuliah->jenis) }}</option>
                            <option value="T">Teori</option>
                            <option value="P">Praktikum</option>
                        </select>
                    </div>
                    <x-form.select :label="'Nama Ruang'" :description="'Pilih Ruang'" :placeholder="'Pilih'"
                        :options="$ruang" valueField="id" displayField="nama_ruang" id="id_ruang" name="id_ruang"
                        :selected="$mataKuliah->id_ruang" />
                    <x-form.button-group page="mata-kuliah" />
                </div>
            </form>

        </div>
    </x-slot:content>
</x-template>