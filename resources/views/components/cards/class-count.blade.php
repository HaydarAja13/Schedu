{{-- Menggunakan <a> sebagai elemen utama agar seluruh kartu bisa di-klik, sesuai tema --}}
<a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform">
    
    {{-- Latar belakang dari tema --}}
    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
        class="absolute inset-0 w-full h-full object-cover object-top z-0 rounded-xl opacity-70">
    
    {{-- Konten di atas latar belakang --}}
    <div class="relative z-10">
        <div class="flex items-center justify-between mb-3">
            {{-- Mengambil judul dari kartu asli: "Jumlah Kelas" --}}
            <h3 class="text-lg font-semibold text-gray-700">Jumlah Kelas</h3>
            
            {{-- Mengganti ikon Font Awesome dengan SVG yang sesuai tema --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 bg-white rounded-full text-[#6B56F6] group-hover:scale-110 transition-transform duration-200"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        {{-- Mengambil variabel $count dari kartu asli, dengan gaya teks dari tema --}}
        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $count }}</p>
        
        {{-- Mengambil sub-teks dari kartu asli: "Kelas yang Anda Ampu" --}}
        <p class="text-sm text-gray-500">Kelas yang Anda Ampu</p>
    </div>
</a>