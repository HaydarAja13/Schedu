<x-template :role="'admin'" :title="'Edit Enrollment Baru'">
    <x-slot:content>
        <p class="my-2">Edit enrollmemt kelas</p>
        <div class="bg-white rounded-xl h-auto mb-4 p-8">
            <form action="{{ route('enrollment-kelas.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-form.select :label="'Tahun Akademik'" :description="'Pilih tahun akademik'" :placeholder="'Pilih'"
                               :options="$tahunAkademik" valueField="id" displayField="tahun_ajaran" id="id_tahun_akademik"
                               name="id_tahun_akademik" :selected="$enrollment->id_tahun_akademik" />
                <x-form.select :label="'Program Studi'" :description="'Pilih program studi'" :placeholder="'Pilih'"
                               :options="$programStudi" valueField="id" displayField="nama_prodi" id="id_program_studi"
                               name="id_program_studi" :selected="$enrollment->id_program_studi" />
                <x-form.select :label="'Kelas'" :description="'Pilih kelas'" :placeholder="'Pilih'" :options="$kelas"
                               valueField="id" displayField="nama_kelas" id="id_kelas" name="id_kelas" :selected="$enrollment->id_kelas" />
                <x-form.select :label="'Angkatan'" :description="'Pilih angkatan'" :placeholder="'Pilih'"
                               :options="$angkatan" valueField="id" displayField="tahun_angkatan" id="id_angkatan"
                               name="id_angkatan" :selected="$enrollment->id_angkatan" />
                <div class="flex justify-end items-center gap-x-4">
                    <a class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                       href="/admin/enrollment-kelas">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Batal</p>
                        </div>
                    </a>
                    <button
                        class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white shadow-sm"
                        type="submit">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Simpan</p>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>
