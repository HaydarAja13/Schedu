<x-template :role="'dosen'" :title="'Dashboard'">
    <x-slot:content>
        <p class="my-2 text-gray-700 text-lg">Selamat datang kembali, Dosen! Siap untuk hari yang produktif di <span class="text-[#6B56F6] font-bold">Schedu</span>.</p>

        <div class="h-[calc(100vh-200px)] overflow-y-auto overflow-x-hidden relative z-0 py-4">
            {{-- Bagian Statistik Utama --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div id="statistics-cards-container" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Statistik Jumlah Mata Kuliah --}}
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-[#6B56F6]">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Mata Kuliah</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">8</p>
                            <p class="text-xs text-gray-400 mt-1">Mata Kuliah Aktif Anda</p>
                        </div>
                        <div class="text-[#6B56F6] text-4xl bg-[#6B56F6]/10 p-3 rounded-full">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>

                    {{-- Statistik Jumlah Kelas --}}
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-teal-500">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Kelas</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">15</p>
                            <p class="text-xs text-gray-400 mt-1">Kelas yang Anda Ampu</p>
                        </div>
                        <div class="text-teal-500 text-4xl bg-teal-500/10 p-3 rounded-full">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                    </div>

                    {{-- Statistik Mahasiswa Diampu --}}
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-yellow-500">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Mahasiswa Diampu</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">320</p>
                            <p class="text-xs text-gray-400 mt-1">Total Mahasiswa Anda</p>
                        </div>
                        <div class="text-yellow-500 text-4xl bg-yellow-500/10 p-3 rounded-full">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>

                    {{-- Statistik Jam Mengajar --}}
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-orange-500">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jam Mengajar</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">12 <span class="text-xl">jam</span></p>
                            <p class="text-xs text-gray-400 mt-1">Per Minggu (Rata-rata)</p>
                        </div>
                        <div class="text-orange-500 text-4xl bg-orange-500/10 p-3 rounded-full">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                </div>

                {{-- Permintaan Waktu Tidak Tersedia --}}
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-times text-red-500 mr-3"></i> Permintaan Waktu Tidak Tersedia
                    </h2>
                    <div class="space-y-4">
                        @php
                            $staticTimeOffRequests = [
                                [
                                    'day' => 'Kamis',
                                    'time' => '10:00 - 12:00',
                                    'reason' => 'Rapat Dosen Jurusan',
                                    'status' => 'Pending',
                                    'statusVariant' => 'warning',
                                ],
                                [
                                    'day' => 'Jumat',
                                    'time' => '13:00 - 15:00',
                                    'reason' => 'Izin Sakit',
                                    'status' => 'Disetujui',
                                    'statusVariant' => 'success',
                                ],
                                [
                                    'day' => 'Senin',
                                    'time' => '08:00 - 10:00',
                                    'reason' => 'Mengikuti Seminar Nasional',
                                    'status' => 'Ditolak',
                                    'statusVariant' => 'danger',
                                ],
                            ];
                        @endphp

                        @forelse($staticTimeOffRequests as $request)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-gray-800">{{ $request['day'] }}, <span class="font-normal text-base">{{ $request['time'] }}</span></p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $request['reason'] }}</p>
                                </div>
                                @php
                                    $statusClass = '';
                                    if ($request['statusVariant'] == 'success') {
                                        $statusClass = 'bg-green-100 text-green-800';
                                    } elseif ($request['statusVariant'] == 'warning') {
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                    } elseif ($request['statusVariant'] == 'danger') {
                                        $statusClass = 'bg-red-100 text-red-800';
                                    } else {
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                    }
                                @endphp
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusClass }}">
                                    {{ $request['status'] }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 bg-green-50 rounded-lg bg-opacity-10 border border-green-200">
                                <i class="fas fa-check-circle text-4xl mb-3 text-green-600"></i>
                                <p class="text-lg font-semibold">Tidak ada permintaan waktu tidak tersedia.</p>
                                <p class="text-sm mt-1">Waktu mengajar Anda saat ini bersih!</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="inline-flex items-center text-[#6B56F6] hover:text-[#5A4AD0] text-sm font-semibold group">
                            <i class="fas fa-plus-circle mr-1 transition-transform group-hover:scale-110"></i> Ajukan Permintaan Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- Jadwal Hari Ini dan Jadwal Besok --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                {{-- Jadwal Hari Ini --}}
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-day text-[#6B56F6] mr-3"></i> Jadwal Ajar Hari Ini
                    </h2>
                    <div class="space-y-4">
                        @php
                            $staticTodaySchedules = [
                                [
                                    'courseName' => 'Algoritma & Struktur Data',
                                    'classInfo' => 'IF-3A (35 Mahasiswa)',
                                    'location' => 'Ruang Teori 301, Gedung F',
                                    'time' => '09:00 - 10:30 WIB',
                                ],
                                [
                                    'courseName' => 'Basis Data Lanjut',
                                    'classInfo' => 'SI-4B (40 Mahasiswa)',
                                    'location' => 'Lab Komputer 2, Gedung G',
                                    'time' => '14:00 - 15:30 WIB',
                                ],
                            ];
                        @endphp

                        @forelse($staticTodaySchedules as $schedule)
                            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="text-[#6B56F6] text-2xl mr-4 mt-1">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-gray-800">{{ $schedule['courseName'] }}</p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-users mr-2 text-gray-400"></i> {{ $schedule['classInfo'] }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> {{ $schedule['location'] }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-clock mr-2 text-gray-400"></i> <span class="font-medium text-[#6B56F6]">{{ $schedule['time'] }}</span>
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg bg-opacity-10 border border-orange-200">
                                <i class="fas fa-hourglass-empty text-4xl mb-3 text-orange-500"></i>
                                <p class="text-lg font-semibold">Tidak ada jadwal mengajar Hari Ini.</p>
                                <p class="text-sm mt-1">Nikmati waktu luang atau persiapkan diri untuk besok!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Jadwal Besok --}}
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-alt text-[#6B56F6] mr-3"></i> Jadwal Ajar Besok
                    </h2>
                    <div class="space-y-4">
                        @php
                            $staticTomorrowSchedules = [
                                [
                                    'courseName' => 'Pemrograman Web',
                                    'classInfo' => 'TI-2C (30 Mahasiswa)',
                                    'location' => 'Lab Komputer 1, Gedung G',
                                    'time' => '10:00 - 11:30 WIB',
                                ],
                                [
                                    'courseName' => 'Sistem Operasi',
                                    'classInfo' => 'IF-3B (32 Mahasiswa)',
                                    'location' => 'Ruang Teori 205, Gedung F',
                                    'time' => '13:00 - 14:30 WIB',
                                ],
                            ];
                        @endphp

                        @forelse($staticTomorrowSchedules as $schedule)
                            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="text-[#6B56F6] text-2xl mr-4 mt-1">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-gray-800">{{ $schedule['courseName'] }}</p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-users mr-2 text-gray-400"></i> {{ $schedule['classInfo'] }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> {{ $schedule['location'] }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-clock mr-2 text-gray-400"></i> <span class="font-medium text-[#6B56F6]">{{ $schedule['time'] }}</span>
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg bg-opacity-10 border border-orange-200">
                                <i class="fas fa-hourglass-empty text-4xl mb-3 text-orange-500"></i>
                                <p class="text-lg font-semibold">Tidak ada jadwal mengajar Besok.</p>
                                <p class="text-sm mt-1">Waktunya untuk istirahat atau persiapan materi!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center px-8 py-4 bg-[#6B56F6] text-white font-semibold rounded-full shadow-lg hover:bg-[#5A4AD0] transform hover:scale-105 transition-all duration-300 ease-in-out group relative z-50 will-change-transform">
                    Lihat Semua Jadwal
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform duration-200"></i>
                </a>
            </div>
        </div>
    </x-slot:content>

    @push('styles')
        {{-- Pastikan Font Awesome dimuat. Jika sudah di layout utama (x-template), ini bisa dihapus --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @endpush

    @push('scripts')
        {{-- Tidak ada JavaScript untuk fetch data awal di sini, karena sudah di-render PHP --}}
    @endpush
</x-template>