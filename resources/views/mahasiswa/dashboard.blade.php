<x-template :role="'mahasiswa'" :title="'Dashboard'">
    <x-slot:content>
      <p class="my-2 text-gray-700 text-lg">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span>, {{ $sidebarUser->nama_mahasiswa ?? '-' }}!</p>
  
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
              <div class="grid grid-cols-1 gap-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    {{-- Kartu: Jumlah Mata Kuliah --}}
                    <x-statistic-card
                        :title="'Jumlah Mata Kuliah'"
                        :value="$jumlahMataKuliah"
                        :description="'Mata Kuliah Aktif'"
                        :mainIcon="'fas fa-book-open'"
                        :bgIcon="'fas fa-book'"
                        :themeColor="'indigo'" {{-- Menggunakan tema warna indigo (ungu) --}}
                        :link="route('mata-kuliah.index')" {{-- Contoh link --}}
                    />

                    {{-- Kartu: Jumlah Dosen Pengampu --}}
                    <x-statistic-card
                        :title="'Jumlah Dosen Pengampu'"
                        :value="$jumlahDosen"
                        :description="'Dosen Pembimbing'"
                        :mainIcon="'fas fa-chalkboard-teacher'"
                        :bgIcon="'fas fa-user-tie'"
                        :themeColor="'blue'" {{-- Menggunakan tema warna biru --}}
                        :link="route('dosen.index')" {{-- Contoh link --}}
                    />

                    {{-- Kartu: Total Mahasiswa Sekelas --}}
                    <x-statistic-card
                        :title="'Total Mahasiswa Sekelas'"
                        :value="$jumlahTemanSekelas"
                        :description="'Mahasiswa di kelas Anda'"
                        :mainIcon="'fas fa-users'"
                        :bgIcon="'fas fa-user-graduate'"
                        :themeColor="'green'" {{-- Menggunakan tema warna hijau --}}
                        :link="route('mahasiswa.index')" {{-- Contoh link --}}
                    />
                </div>
              </div>
  
              {{-- Bagian Kartu Jadwal Hari Ini & Jadwal Besok (dengan data statis) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                {{-- Kartu: Jadwal Hari Ini --}}
                <a class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform overflow-hidden">
                    {{-- Background gradient effect --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white opacity-70"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                            <i class="fas fa-calendar-day text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Hari Ini
                        </h2>
                        <div class="space-y-4">
                            {{-- Data jadwal Hari Ini (statis) --}}
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
                            
                            {{-- Contoh jika tidak ada jadwal (uncomment jika ingin menampilkan ini) --}}
                            {{-- 
                            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                                <i class="fas fa-hourglass-half text-4xl mb-3 text-orange-500"></i>
                                <p class="text-lg font-semibold">Tidak ada jadwal untuk hari ini.</p>
                                <p class="text-sm mt-1">Waktunya istirahat atau belajar mandiri!</p>
                            </div>
                            --}}
                        </div>
                    </div>
                </a>
 
                {{-- Kartu: Jadwal Besok --}}
                <a class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform overflow-hidden">
                    {{-- Background gradient effect --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white opacity-70"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                            <i class="fas fa-calendar-alt text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> Jadwal Besok
                        </h2>
                        <div class="space-y-4">
                            {{-- Data jadwal Besok (statis) --}}
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

                            {{-- Contoh jika tidak ada jadwal (uncomment jika ingin menampilkan ini) --}}
                            {{--
                            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                                <i class="fas fa-hourglass-half text-4xl mb-3 text-orange-500"></i>
                                <p class="text-lg">Tidak ada jadwal untuk besok.</p>
                                <p class="text-sm mt-1">Siapkan diri untuk hari yang produktif!</p>
                            </div>
                            --}}
                        </div>
                    </div>
                </a>
            </div>
 
            {{-- Tombol Aksi Utama --}}
            <div class="text-center mt-6">
                <a class="inline-flex items-center px-8 py-4 bg-[#6B56F6] text-white font-semibold rounded-full shadow-lg hover:bg-[#5A4AD0] transform hover:scale-105 transition-all duration-300 ease-in-out group relative z-50 will-change-transform">
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