{{-- Menggunakan <a> sebagai elemen utama agar seluruh kartu bisa di-klik, sesuai tema --}}
<a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform min-h-[180px] flex flex-col">

    {{-- Latar belakang dari tema --}}
    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">

    {{-- Konten diletakkan di atas latar belakang --}}
    <div class="relative z-10 flex-grow flex flex-col">

        @if($count > 0)
            {{-- TAMPILAN JIKA ADA DATA --}}
            <div class="flex-grow">
                <div class="flex items-center justify-between mb-3">
                    {{-- Judul utama --}}
                    <h3 class="text-lg font-semibold text-gray-700">Mata Kuliah Diampu</h3>
                    
                    {{-- Ikon utama dengan gaya tema --}}
                    <div class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 15c1.255 0 2.443-.29 3.5-.804V4.804zM14.5 4c1.255 0 2.443.29 3.5.804v10A7.969 7.969 0 0114.5 15c-1.255 0-2.443-.29-3.5-.804V4.804A7.968 7.968 0 0114.5 4z" />
                        </svg>
                    </div>
                </div>

                {{-- Angka jumlah --}}
                <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $count }}</p>
                
                {{-- Deskripsi tambahan --}}
                <p class="text-sm text-gray-500">Jumlah total mata kuliah Anda.</p>
            </div>
        @else
            {{-- TAMPILAN JIKA TIDAK ADA DATA --}}
            <div class="flex-grow flex flex-col items-center justify-center text-center">
                {{-- Ikon status kosong --}}
                <div class="text-gray-400 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                
                {{-- Teks status kosong --}}
                <p class="text-lg font-semibold text-gray-600 mb-1">Belum Ada Kelas</p>
                <p class="text-sm text-gray-500">Hubungi admin untuk info lebih lanjut.</p>
            </div>
        @endif

    </div>
</a>