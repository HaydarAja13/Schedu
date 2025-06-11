<x-template :role="'admin'" :title="'Edit Enrollment Baru'">
    <x-slot:content>
        <div class="bg-white rounded-xl h-auto my-4 p-8">
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
                    valueField="id" displayField="nama_kelas" id="id_kelas" name="id_kelas"
                    :selected="$enrollment->id_kelas" />
                <x-form.select :label="'Angkatan'" :description="'Pilih angkatan'" :placeholder="'Pilih'"
                    :options="$angkatan" valueField="id" displayField="tahun_angkatan" id="id_angkatan"
                    name="id_angkatan" :selected="$enrollment->id_angkatan" />
                <x-form.button-group page="enrollment-kelas" />
            </form>
        </div>
    </x-slot:content>
</x-template>