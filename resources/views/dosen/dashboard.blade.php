<x-template :role="'dosen'" :title="'Dashboard'">
    <x-slot:content>
        <div x-data="{ showAlert: true }">
            @if(session('create'))
            <div x-show="showAlert" class="mb-4">
                <x-alert titleModal="Berhasil Mengirim Requirement" contentModal="{{ session('create') }}"
                    type="success" />
            </div>
            @endif
        </div>
        <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span> {{
            $sidebarUser->nama_dosen ?? '-' }} </p>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-4">
                <div class="h-auto">
                    <div class="grid grid-cols-2 gap-4 lg:grid-cols-2 lg:gap-4">
                        <x-total-card :total="$jumlahMataKuliah" :title="'Mata Kuliah'" />
                        <x-total-card :total="$jumlahKelas" :title="'Kelas'" />
                        <x-total-card :total="$jumlahMahasiswa" :title="'Mahasiswa'" />
                        <x-total-card :total="$jamMengajar" :title="'Jam Mengajar'" />
                    </div>
                </div>
                <div class="h-auto">
                    <x-request-card :notification="$notification" />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 mt-4 lg:grid-cols-2 lg:gap-4">
                <div class="h-32 rounded-lg bg-white shadow-sm"></div>
                <div class="h-32 rounded-lg bg-white shadow-sm"></div>
            </div>
        </div>
    </x-slot:content>
</x-template>