<x-template :role="'admin'" :title="'Data Mahasiswa'">
    <x-slot:content>
        {{-- <x-alert titleModal="Berhasil Menyimpan Data" contentModal="Data anda berhasil di simpan" type="success">
        </x-alert> --}}
        <div class="">
            <livewire:mahasiswa-table></livewire:mahasiswa-table>
        </div>
    </x-slot:content>
</x-template>