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
                <div class="block bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6]/50 transition-all duration-300 transform hover:-translate-y-1 group will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-[#6B56F6] group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Ajar Hari Ini
                    </h2>
                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Pemrograman Web Lanjut</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" />
                                    </svg>
                                    TI-3A (32 Mahasiswa)
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Lab. Komputer 2, Gedung B
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    09:00 - 11:30 WIB
                                </p>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Sistem Basis Data</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" />
                                    </svg>
                                    SI-2B (28 Mahasiswa)
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Ruang Teori 301, Gedung A
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    13:00 - 15:00 WIB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6]/50 transition-all duration-300 transform hover:-translate-y-1 group will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-[#6B56F6] group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Ajar Besok
                    </h2>
                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Algoritma dan Struktur Data</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" />
                                    </svg>
                                    IF-3C (35 Mahasiswa)
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Lab. Komputer 1, Gedung B
                                </p>
                                <p class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    08:00 - 10:30 WIB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center px-8 py-4 bg-[#6B56F6] text-white font-semibold rounded-full shadow-lg hover:bg-[#5A4AD0] transform hover:scale-105 transition-all duration-300 ease-in-out group relative z-50 will-change-transform">
                    Lihat Semua Jadwal
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
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