<x-template :role="'admin'" :title="'Data Enrollment Kelas'">
    <x-slot:content>
        {{-- <x-alert titleModal="Berhasil Menyimpan Data" contentModal="Data anda berhasil di simpan" type="success">
        </x-alert> --}}
        <div class="">
            <livewire:enrollment-kelas-table></livewire:enrollment-kelas-table>
        </div>
    </x-slot:content>
</x-template>