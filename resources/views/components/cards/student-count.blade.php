{{-- Menggunakan <a> sebagai elemen utama agar seluruh kartu bisa di-klik, sesuai tema --}}
<a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
    
    {{-- Latar belakang dari tema --}}
    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
    
    {{-- Konten di atas latar belakang --}}
    <div class="relative z-10">
        <div class="flex items-center justify-between mb-3">
            {{-- Mengambil judul dari kartu asli: "Mahasiswa Diampu" --}}
            <h3 class="text-lg font-semibold text-gray-700">Mahasiswa Diampu</h3>
            
            {{-- Mengganti ikon Font Awesome dengan SVG yang sesuai tema (ikon grup pengguna) --}}
            <div class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
            </div>
        </div>

        {{-- Mengambil variabel $count dari kartu asli, dengan gaya teks dari tema --}}
        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $count }}</p>
        
        {{-- Mengambil sub-teks dari kartu asli: "Total Mahasiswa Anda" --}}
        <p class="text-sm text-gray-500">Total Mahasiswa Anda</p>
    </div>
</a>