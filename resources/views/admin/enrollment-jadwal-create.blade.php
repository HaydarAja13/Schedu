<x-template :role="'admin'" :title="'Tambah Enrollment Jadwal Baru'">
    <x-slot:content>
        <div class="bg-white rounded-xl h-auto my-4 p-8">
            <form action="{{ route('enrollment-jadwal.store') }}" method="POST">
                @csrf
                <x-form.select :label="'Mata Kuliah'" :description="'Pilih mata kuliah'" :placeholder="'Pilih'"
                    :options="$mataKuliah" valueField="id" displayField="nama_matkul" id="id_mata_kuliah"
                    name="id_mata_kuliah" />
                <x-form.select :label="'Enrollment Kelas'" :description="'Pilih kelas'" :placeholder="'Pilih'"
                    :options="$enrollmentKelas" valueField="id" displayField="nama_kelas_display"
                    id="id_enrollment_kelas" name="id_enrollment_kelas" />
                <x-form.select :label="'Dosen'" :description="'Pilih dosen'" :placeholder="'Pilih'" :options="$dosen"
                    valueField="id" displayField="nama_dosen" id="id_dosen" name="id_dosen" />
                <x-form.button-group page="enrollment-jadwal" />
            </form>
        </div>
    </x-slot:content>
</x-template>