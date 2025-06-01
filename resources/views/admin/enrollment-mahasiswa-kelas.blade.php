<x-template :role="'admin'" :title="'Data Enrollment Mahasiswa Kelas'">
    <x-slot:content>
        <div x-data="{ showAlert: true }">
            @if(session('create'))
            <div x-show="showAlert" class="mb-4">
                <x-alert titleModal="Berhasil Menyimpan Data" contentModal="{{ session('create') }}" type="success" />
            </div>
            @elseif(session('delete'))
            <div x-show="showAlert" class="mb-4">
                <x-alert titleModal="Berhasil Menghapus Data" contentModal="{{ session('delete') }}" type="success" />
            </div>
            @elseif(session('update'))
            <div x-show="showAlert" class="mb-4">
                <x-alert titleModal="Berhasil Mengubah Data" contentModal="{{ session('update') }}" type="success" />
            </div>
            @endif
        </div>

        <div class="">
            <livewire:enrollment-mahasiswa-kelas-table></livewire:enrollment-mahasiswa-kelas-table>
        </div>
    </x-slot:content>
</x-template>
