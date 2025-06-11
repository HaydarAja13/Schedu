<x-template :role="'admin'" :title="'Edit Enrollment Mahasiswa Kelas'">
    <x-slot:content>
        <div class="bg-white rounded-xl h-auto my-4 p-8">
            <form action="{{ route('enrollment-mahasiswa-kelas.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-form.select :label="'Mahasiswa'" :description="'Pilih mahasiswa'" :placeholder="'Pilih'"
                    :options="$mahasiswa" valueField="id" displayField="nama" id="id_mahasiswa" name="id_mahasiswa"
                    :selected="$enrollment->id_mahasiswa" />
                <x-form.select :label="'Enrollment Kelas'" :description="'Pilih kelas'" :placeholder="'Pilih'"
                    :options="$enrollmentKelas" valueField="id" displayField="nama_kelas_display"
                    id="id_enrollment_kelas" name="id_enrollment_kelas" :selected="$enrollment->id_enrollment_kelas" />
                <x-form.button-group page="enrollment-mahasiswa-kelas" />
            </form>
        </div>
    </x-slot:content>
</x-template>