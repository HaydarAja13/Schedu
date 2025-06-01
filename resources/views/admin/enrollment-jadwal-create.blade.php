<x-template :role="'admin'" :title="'Tambah Enrollment Jadwal Baru'">
    <x-slot:content>
        <p class="my-2">Tambah enrollment jadwal baru</p>
        <div class="bg-white rounded-xl h-auto mb-4 p-8">
            <form action="{{ route('enrollment-jadwal.store') }}" method="POST">
                @csrf
                <x-form.select :label="'Mata Kuliah'" :description="'Pilih mata kuliah'" :placeholder="'Pilih'"
                    :options="$mataKuliah" valueField="id" displayField="nama_matkul" id="id_mata_kuliah"
                    name="id_mata_kuliah" />
                <x-form.select :label="'Enrollment Kelas'" :description="'Pilih kelas'" :placeholder="'Pilih'"
                    :options="$enrollmentKelas" valueField="id"
                    displayField="nama_kelas_display"
                    id="id_enrollment_kelas" name="id_enrollment_kelas" />
                <x-form.select :label="'Dosen'" :description="'Pilih dosen'" :placeholder="'Pilih'" :options="$dosen"
                    valueField="id" displayField="nama_dosen" id="id_dosen" name="id_dosen" />
                <div class="flex justify-end items-center gap-x-4">
                    <a class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                        href="/admin/enrollment-jadwal">
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
