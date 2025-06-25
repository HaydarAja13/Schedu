<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden min-h-[180px] flex flex-col justify-between">
    {{-- Background gradient effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white opacity-70"></div>

    @if($count > 0)
        <div class="relative z-10 flex items-center justify-between">
            <div>
                {{-- Judul utama --}}
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Mata Kuliah Diampu</p>
                {{-- Angka jumlah mata kuliah --}}
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $count }}</p>
                {{-- Deskripsi tambahan --}}
                <p class="text-xs text-gray-400 mt-1">Jumlah total mata kuliah Anda.</p>
            </div>
            
            {{-- Ikon utama dengan latar belakang lingkaran --}}
            <div class="text-indigo-500 text-4xl bg-indigo-500/10 p-3 rounded-full group-hover:scale-105 transition-transform duration-200">
                <i class="fas fa-book-open"></i> {{-- Menggunakan ikon buku terbuka untuk mata kuliah --}}
            </div>
        </div>

        {{-- Ikon latar belakang besar dan samar --}}
        <div class="absolute bottom-0 right-0 opacity-10 text-indigo-500 text-8xl">
            <i class="fas fa-book"></i>
        </div>
    @else
        {{-- Kondisi jika tidak ada mata kuliah --}}
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center">
            <i class="fas fa-book-reader text-4xl mb-3 text-gray-400"></i>
            <p class="text-lg font-semibold text-gray-600 mb-1">Belum Ada Kelas</p>
            <p class="text-sm text-gray-500">Hubungi admin untuk info lebih lanjut.</p>
        </div>
        {{-- Ikon latar belakang samar untuk kondisi tanpa data --}}
        <div class="absolute bottom-0 right-0 opacity-5 text-gray-300 text-8xl">
            <i class="fas fa-exclamation-circle"></i>
        </div>
    @endif
</div>