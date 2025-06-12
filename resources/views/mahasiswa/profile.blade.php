<x-template :role="'mahasiswa'" :title="'Dashboard'">
  <x-slot:content>
    <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>

        <div class="h-[calc(100vh-200px)] overflow-y-auto overflow-x-hidden relative z-0"> 
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Jumlah Mata Kuliah</h3>
                        <i class="fas fa-book-open text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">5</p>
                    <p class="text-sm text-gray-500">Mata Kuliah Aktif</p>
                </a>

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Jumlah Dosen Pengampu</h3>
                        <i class="fas fa-chalkboard-teacher text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">4</p>
                    <p class="text-sm text-gray-500">Dosen Pembimbing</p>
                </a>

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Total Mahasiswa Sekelas</h3>
                        <i class="fas fa-users text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">30</p>
                    <p class="text-sm text-gray-500">Mahasiswa di kelas Anda</p>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-day text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Hari Ini
                    </h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-[#6B56F6] pl-4 py-2 bg-gray-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Algoritma & Struktur Data</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-xs mr-1"></i> Lab Komputer 1 &bull;
                                <i class="fas fa-clock text-xs mr-1"></i> 08:00 - 10:00 &bull;
                                <i class="fas fa-user-tie text-xs mr-1"></i> Dr. Budi Santoso
                            </p>
                        </div>
                        <div class="border-l-4 border-[#6B56F6] pl-4 py-2 bg-gray-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Basis Data Lanjut</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-xs mr-1"></i> Ruang D-301 &bull;
                                <i class="fas fa-clock text-xs mr-1"></i> 10:30 - 12:30 &bull;
                                <i class="fas fa-user-tie text-xs mr-1"></i> Prof. Ani Kurnia
                            </p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-alt text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Besok
                    </h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-[#6B56F6] pl-4 py-2 bg-gray-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Pemrograman Web Lanjut</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-xs mr-1"></i> Lab Komputer 2 &bull;
                                <i class="fas fa-clock text-xs mr-1"></i> 09:00 - 11:00 &bull;
                                <i class="fas fa-user-tie text-xs mr-1"></i> Ibu Siti Khadijah
                            </p>
                        </div>
                        <div class="border-l-4 border-[#6B56F6] pl-4 py-2 bg-gray-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Sistem Operasi</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-xs mr-1"></i> Ruang C-205 &bull;
                                <i class="fas fa-clock text-xs mr-1"></i> 14:00 - 16:00 &bull;
                                <i class="fas fa-user-tie text-xs mr-1"></i> Mr. John Doe
                            </p>
                        </div>
                        {{-- Batalkan komentar div di bawah ini untuk menampilkan "Tidak ada jadwal untuk besok" dalam mode statis --}}
                        {{--
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                            <i class="fas fa-hourglass-half text-4xl mb-3 text-orange-500"></i>
                            <p class="text-lg">Tidak ada jadwal untuk besok.</p>
                            <p class="text-sm mt-1">Siapkan diri untuk hari yang produktif!</p>
                        </div>
                        --}}
                    </div>
                </a>
            </div>

            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center px-8 py-4 bg-[#6B56F6] text-white font-semibold rounded-full shadow-lg hover:bg-[#5A4AD0] transform hover:scale-105 transition-all duration-300 ease-in-out group relative z-50 will-change-transform"> {{-- z-index lebih tinggi, will-change-transform --}}
                    Lihat Semua Jadwal
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform duration-200"></i>
                </a>
            </div>
        </div> {{-- Akhir dari div utama dengan overflow dan z-index --}}
    </x-slot:content>
</x-template>

<style>
    /* Pastikan Font Awesome dimuat untuk ikon */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>