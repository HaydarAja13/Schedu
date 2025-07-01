<x-template :role="'dosen'" :title="'Dashboard'">
    <x-slot:content>
        <p class="my-2 text-gray-700 text-lg">Selamat datang kembali, {{ $sidebarUser->nama_dosen ?? '-' }}! Siap untuk hari yang produktif di <span class="text-[#6B56F6] font-bold">Schedu</span>.</p>

            <div class="h-[calc(100vh-200px)] p-2 overflow-y-auto overflow-x-hidden relative z-0"> 
                <div 
                x-data="{
                    activeSlide: 0,
                    totalSlide: 3,
                    startSlider() {
                        setInterval(() => {
                            this.activeSlide = (this.activeSlide + 1) % this.totalSlide
                        }, 5000)
                    }
                }"
                x-init="startSlider"
                class="relative bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] text-white rounded-xl h-48 overflow-hidden mb-4"
            >
                {{-- Slide 1 --}}
                <div 
                    x-show="activeSlide === 0" 
                    x-transition 
                    class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 z-10"
                >
                    <h2 class="text-3xl font-bold">Halo, {{ $sidebarUser->nama_dosen ?? '-' }} 👋</h2>
                    <p class="text-sm mt-2">Selamat datang di platform pembelajaran Schedu.</p>
                </div>
            
                {{-- Slide 2 --}}
                <div 
                    x-show="activeSlide === 1" 
                    x-transition 
                    class="absolute inset-0 flex items-center justify-between px-8 z-10"
                >
                    <div class="text-left">
                        <h2 class="text-2xl font-semibold">Tips Belajar Hari Ini 📘</h2>
                        <p class="text-sm mt-1">Gunakan teknik Pomodoro agar belajar lebih fokus.</p>
                    </div>
                    <div class="text-right">
                        <p> Belajar lebih baik 25 menit fokus</p>
                        <p> dan 5 menit istirahat.</p>
                    </div>
                </div>
            
                {{-- Slide 3 --}}
                <div 
                    x-show="activeSlide === 2" 
                    x-transition 
                    class="absolute inset-0 grid place-items-center p-4 rounded-xl z-10"
                >
                    <div>
                        <h2 class="text-xl font-bold">Jadwal Kuliah</h2>
                        <p class="text-sm mt-1">Cek dan rencanakan kegiatanmu dari sekarang.</p>
                        <a href="#" class="inline-block mt-2 px-4 py-2 bg-white text-[#6B56F6] rounded-full font-semibold">Lihat Jadwal</a>
                    </div>
                </div>
                <img src="{{ asset('images/sidebar-background.svg') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover object-bottom z-0 rounded-xl ">
            </div>

            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" x-transition>
                    <span x-text="slide"></span>
                </div>
            </template>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div id="statistics-cards-container" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-cards.course-count :count="$jumlahMataKuliah" />
                    <x-cards.class-count :count="$jumlahKelas" />
                    <x-cards.student-count :count="$jumlahMahasiswa" />
                    <x-cards.teaching-hours :hours="$jamMengajar" />
                </div>
                
                 <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-times text-red-500 mr-3"></i> Permintaan Izin
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-gray-800">Senin, <span class="font-normal text-base">13:00 - 15:00</span></p>
                                <p class="text-sm text-gray-600 mt-1">Seminar Nasional Pendidikan</p>
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-gray-800">Rabu, <span class="font-normal text-base">08:00 - 10:00</span></p>
                                <p class="text-sm text-gray-600 mt-1">Pelatihan Dosen</p>
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="inline-flex items-center text-[#6B56F6] hover:text-[#5A4AD0] text-sm font-semibold group">
                            <i class="fas fa-plus-circle mr-1 transition-transform group-hover:scale-110"></i> Ajukan Permintaan Baru
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-day text-[#6B56F6] mr-3"></i> Jadwal Ajar Hari Ini
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="text-[#6B56F6] text-2xl mr-4 mt-1">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-gray-800">Pemrograman Web Lanjut</p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-users mr-2 text-gray-400"></i> TI-3A (32 Mahasiswa)
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> Lab. Komputer 2, Gedung B
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-clock mr-2 text-gray-400"></i> <span class="font-medium text-[#6B56F6]">09:00 - 11:30 WIB</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="text-[#6B56F6] text-2xl mr-4 mt-1">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-gray-800">Sistem Basis Data</p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-users mr-2 text-gray-400"></i> SI-2B (28 Mahasiswa)
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> Ruang Teori 301, Gedung A
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-clock mr-2 text-gray-400"></i> <span class="font-medium text-[#6B56F6]">13:00 - 15:00 WIB</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg relative z-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <i class="fas fa-calendar-alt text-[#6B56F6] mr-3"></i> Jadwal Ajar Besok
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="text-[#6B56F6] text-2xl mr-4 mt-1">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-lg font-semibold text-gray-800">Algoritma dan Struktur Data</p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-users mr-2 text-gray-400"></i> IF-3C (35 Mahasiswa)
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> Lab. Komputer 1, Gedung B
                                </p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <i class="fas fa-clock mr-2 text-gray-400"></i> <span class="font-medium text-[#6B56F6]">08:00 - 10:30 WIB</span>
                                </p>
                            </div>
                        </div>
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

  <style>
      /* Pastikan Font Awesome dimuat untuk ikon */
      @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
  </style>