{{-- Halaman Dashboard Admin --}}
<x-template :role="'admin'" :title="'Dashboard'">
    <x-slot:content>
        <div class="mt-6">
            {{-- Bagian Ringkasan Data (Kartu Kecil & Kartu Manajemen) --}}
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-4">
                {{-- Kartu Ringkasan Statistik --}}
                <div class="grid grid-cols-2 gap-4">
                    <x-dashboard.simple-card
                        title="Mahasiswa"
                        description="{{ $jumlahMahasiswa }} mahasiswa aktif"
                        icon="fas fa-book"
                        highlightNumber="true"
                        href="{{ route('admin.mahasiswa') }}"
                    />

                    <x-dashboard.simple-card
                        title="Dosen"
                        description="{{$jumlahDosen}} dosen aktif"
                        icon="fas fa-user-tie"
                        highlightNumber="true"
                        href="{{ route('admin.dosen') }}"
                    />

                    <x-dashboard.simple-card
                        title="Ruang"
                        description="{{$jumlahRuang}} ruang tersedia"
                        icon="fas fa-door-open"
                        highlightNumber="true"
                        href="{{ route('admin.ruang') }}"
                    />

                    <x-dashboard.simple-card
                        title="Mata Kuliah"
                        description="{{$jumlahMataKuliah}} mata kuliah tersedia"
                        icon="fas fa-chalkboard"
                        highlightNumber="true"
                        href="{{ route('admin.mata-kuliah') }}"
                    />
                </div>

                {{-- Kartu Manajemen Jadwal Kuliah --}}
                <x-dashboard.management-card
                    description="Kelola dan atur jadwal perkuliahan Anda dengan mudah."
                    buttonText="Mulai"
                    buttonLink="{{ route('admin.schedule') }}"
                    image="images/Dashboard1.svg"
                />
            </div>

            {{-- Bagian Aktivitas & Permintaan --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mt-6">
                {{-- Kartu Prodi Belum Terjadwal (Aktivitas Terkini) --}}
                <div class="lg:col-span-8">
                    <x-dashboard.prodi-unscheduled 
                        :prodis="$programStudiBelumTerjadwal" 
                        :role="'admin'"
                        :totalTerjadwal="$totalTerjadwal"
                        :totalBelumTerjadwal="$totalBelumTerjadwal"
                    />
                </div>

                {{-- Kartu Permintaan Ubah Jadwal --}}
                <div class="lg:col-span-4">
                    <x-dashboard.request-dosen
                        :requests="$permintaanJadwalDosen"
                        :role="'admin'"
                    />
                </div>
            </div>
        </div>
    </x-slot:content>
</x-template>