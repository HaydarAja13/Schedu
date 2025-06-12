<x-template :role="'dosen'" :title="'Dashboard'">
    <x-slot:content>
        <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>

        <div class="h-[calc(100vh-200px)] overflow-y-auto overflow-x-hidden relative z-0">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8"> {{-- Menggunakan lg:grid-cols-3 untuk 2+1 layout --}}
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6"> {{-- Ini akan mencakup 2 kolom untuk kartu 2x2 --}}
                    <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-700">Jumlah Mata Kuliah</h3>
                            <i class="fas fa-book-open text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">5</p>
                        <p class="text-sm text-gray-500">Mata Kuliah Aktif</p>
                    </a>

                    <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-700">Jumlah Kelas</h3>
                            <i class="fas fa-chalkboard text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">3</p>
                        <p class="text-sm text-gray-500">Kelas yang Diampu</p>
                    </a>

                    <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-700">Mahasiswa Diampu</h3>
                            <i class="fas fa-user-graduate text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">90</p>
                        <p class="text-sm text-gray-500">Total Mahasiswa</p>
                    </a>

                    <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-700">Jam Mengajar</h3>
                            <i class="fas fa-hourglass-half text-[#6B56F6] text-2xl group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">12</p>
                        <p class="text-sm text-gray-500">Jam per Minggu</p>
                    </a>
                </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                        <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                            <i class="fas fa-calendar-times text-red-500 mr-3"></i> Permintaan Waktu Tidak Tersedia
                        </h2>
                        <div class="space-y-4">
                            <div class="border-l-4 border-green-600 pl-4 py-2 bg-green-50 rounded-r-md">
                                <p class="font-semibold text-gray-800">Senin, 08:00 - 10:00 WIB</p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Rapat rutin departemen
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-check text-xs mr-1 text-green-600"></i> Status: Disetujui
                                </p>
                            </div>
                            <div class="border-l-4 border-gray-500 pl-4 py-2 bg-black-50 rounded-r-md">
                                <p class="font-semibold text-gray-800">Rabu, 13:00 - 15:00 WIB</p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Mengajar di luar kampus
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-hourglass-half text-xs mr-1 text-orange-500"></i> Status: Menunggu Persetujuan
                                </p>
                            </div>
                            <div class="border-l-4 border-red-600 pl-4 py-2 bg-red-50 rounded-r-md">
                                <p class="font-semibold text-gray-800">Jumat, 09:00 - 12:00 WIB</p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Penelitian pribadi
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-check text-xs mr-1 text-red-600"></i> Status: Ditolak
                                </p>
                            </div>
                            {{-- Add more unavailable time requests here --}}
                            <div class="text-center mt-4">
                                <a href="#" class="inline-flex items-center text-[#6B56F6] hover:text-[#5A4AD0] text-sm font-semibold">
                                    <i class="fas fa-plus-circle mr-1"></i> Ajukan Permintaan Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- {{-- Card "Prioritas Jadwal Saya" (Requirement Dosen) --}}
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50 opacity-60">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-history text-gray-500 mr-3"></i> Prioritas Jadwal Saya
                    </h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Senin, 08:00 - 10:00 WIB</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Rapat rutin departemen
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-check-circle text-xs mr-1 text-green-600"></i> Status: Diterapkan pada jadwal
                            </p>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Rabu, 13:00 - 15:00 WIB</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Mengajar di luar kampus
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-check-circle text-xs mr-1 text-green-600"></i> Status: Diterapkan pada jadwal
                            </p>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 rounded-r-md">
                            <p class="font-semibold text-gray-800">Jumat, 09:00 - 12:00 WIB</p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-xs mr-1"></i> Alasan: Penelitian pribadi
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-check-circle text-xs mr-1 text-green-600"></i> Status: Diterapkan pada jadwal
                            </p>
                        </div>
                        {{-- Tambahkan lebih banyak riwayat permintaan --}}
                        <div class="text-center mt-4">
                            <span class="inline-flex items-center text-gray-400 text-sm font-semibold cursor-not-allowed">
                                <i class="fas fa-plus-circle mr-1"></i> Ajukan Permintaan Baru (Tidak tersedia setelah jadwal dibuat)
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->

            {{-- Jadwal Hari Ini dan Jadwal Besok --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-day text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Ajar Hari Ini
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

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-alt text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Ajar Besok
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
                <a href="#" class="inline-flex items-center px-8 py-4 bg-[#6B56F6] text-white font-semibold rounded-full shadow-lg hover:bg-[#5A4AD0] transform hover:scale-105 transition-all duration-300 ease-in-out group relative z-50 will-change-transform">
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