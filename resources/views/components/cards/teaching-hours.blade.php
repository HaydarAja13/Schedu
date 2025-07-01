{{-- Menggunakan <a> sebagai elemen utama agar seluruh kartu bisa di-klik, sesuai tema --}}
<a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
    
    {{-- Latar belakang dari tema --}}
    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
    
    {{-- Konten di atas latar belakang --}}
    <div class="relative z-10">
        <div class="flex items-center justify-between mb-3">
            {{-- Mengambil judul dari kartu asli: "Jam Mengajar" --}}
            <h3 class="text-lg font-semibold text-gray-700">Jam Mengajar</h3>
            
            {{-- Mengganti ikon Font Awesome dengan SVG jam yang sesuai tema --}}
            <div class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        {{-- Mengambil variabel $hours dari kartu asli, dengan gaya teks dari tema --}}
        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $hours }} Jam</p>
        
        {{-- Mengambil sub-teks dari kartu asli --}}
        <p class="text-sm text-gray-500">Per Minggu (Rata-rata)</p>
    </div>
</a>