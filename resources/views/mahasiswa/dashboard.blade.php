<x-template :role="'mahasiswa'" :title="'Dashboard'">
    <x-slot:content>
      <p class="my-2">Selamat datang, di platform <span class="text-[#6B56F6] font-bold">Schedu.</span> {{ $sidebarUser->nama_mahasiswa ?? '-' }}</p>
  
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
                <h2 class="text-3xl font-bold">Halo, {{ $sidebarUser->nama_mahasiswa ?? '-' }} 👋</h2>
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
                
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
                        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700 z-10">Jumlah Mata Kuliah</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 20l-8-4V4l8 4m0 0l8-4v12l-8 4m0-12v12" />
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $jumlahMataKuliah }}</p>
                    <p class="text-sm text-gray-500">Mata Kuliah Aktif</p>
                </a>

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
                        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700 z-10">Jumlah Dosen Pengampu</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $jumlahDosen }}</p>
                    <p class="text-sm text-gray-500">Dosen Pembimbing</p>
                </a>

                <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
                    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
                        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700 z-10">Total Mahasiswa Sekelas</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $jumlahTemanSekelas }}</p>
                    <p class="text-sm text-gray-500">Mahasiswa di kelas Anda</p>
                </a>
            </div>
  
  
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div
                    class="block bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6]/50 transition-all duration-300 transform hover:-translate-y-1 group will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 mr-3 text-[#6B56F6] group-hover:scale-110 transition-transform duration-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Hari Ini
                    </h2>

                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Algoritma & Struktur Data</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg> Lab Komputer 1</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg> 08:00 - 10:00</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" /></svg> Dr. Budi Santoso</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Basis Data Lanjut</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg> Ruang D-301</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg> 10:30 - 12:30</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" /></svg> Prof. Ani Kurnia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="block bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6]/50 transition-all duration-300 transform hover:-translate-y-1 group will-change-transform">
                    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 mr-3 text-[#6B56F6] group-hover:scale-110 transition-transform duration-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Besok
                    </h2>

                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Pemrograman Web Lanjut</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg> Lab Komputer 2</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg> 09:00 - 11:00</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" /></svg> Ibu Siti Khadijah</p>
                            </div>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                            <p class="font-semibold text-gray-800">Sistem Operasi</p>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg> Ruang C-205</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg> 14:00 - 16:00</p>
                                <p class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" /></svg> Mr. John Doe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                          
                          {{-- Batalkan komentar div di bawah ini untuk menampilkan "Tidak ada jadwal untuk besok" dalam mode statis --}}
                          {{--
                          <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                              <i class="fas fa-hourglass-half text-4xl mb-3 text-orange-500"></i>
                              <p class="text-lg">Tidak ada jadwal untuk besok.</p>
                              <p class="text-sm mt-1">Siapkan diri untuk hari yang produktif!</p>
                          </div>
                          --}}
  
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