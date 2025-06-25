{{-- Props yang Diharapkan:
    - $title: Judul kartu (e.g., 'Jumlah Mata Kuliah')
    - $value: Angka atau nilai utama (e.g., $jumlahMataKuliah)
    - $description: Deskripsi singkat (e.g., 'Mata Kuliah Aktif')
    - $mainIcon: Kelas Font Awesome untuk ikon utama (e.g., 'fas fa-book-open')
    - $bgIcon: Kelas Font Awesome untuk ikon latar belakang besar (e.g., 'fas fa-book')
    - $themeColor: Warna Tailwind CSS (e.g., 'indigo', 'teal', 'blue', 'green')
    - $link: URL untuk link kartu (opsional, default '#')
--}}

@props([
    'title',
    'value',
    'description',
    'mainIcon',
    'bgIcon',
    'themeColor' => 'indigo', // Default theme color if not provided
    'link' => '#',
])

<a href="{{ $link }}" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-{{ $themeColor }}-500 transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform overflow-hidden min-h-[180px] flex flex-col justify-between">
    {{-- Background gradient effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-{{ $themeColor }}-50 to-white opacity-70"></div>

    @if($value > 0)
        <div class="relative z-10 flex items-center justify-between">
            <div>
                {{-- Judul utama --}}
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">{{ $title }}</p>
                {{-- Angka jumlah --}}
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $value }}</p>
                {{-- Deskripsi tambahan --}}
                <p class="text-xs text-gray-400 mt-1">{{ $description }}</p>
            </div>
            
            {{-- Ikon utama dengan latar belakang lingkaran --}}
            <div class="text-{{ $themeColor }}-500 text-4xl bg-{{ $themeColor }}-500/10 p-3 rounded-full group-hover:scale-105 transition-transform duration-200">
                <i class="{{ $mainIcon }}"></i>
            </div>
        </div>

        {{-- Ikon latar belakang besar dan samar --}}
        <div class="absolute bottom-0 right-0 opacity-10 text-{{ $themeColor }}-500 text-8xl">
            <i class="{{ $bgIcon }}"></i>
        </div>
    @else
        {{-- Kondisi jika nilai adalah 0 atau kurang --}}
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center">
            <i class="fas fa-exclamation-circle text-4xl mb-3 text-gray-400"></i> {{-- Ikon peringatan umum --}}
            <p class="text-lg font-semibold text-gray-600 mb-1">Data Belum Tersedia</p>
            <p class="text-sm text-gray-500">Silakan cek kembali nanti.</p>
        </div>
        {{-- Ikon latar belakang samar untuk kondisi tanpa data --}}
        <div class="absolute bottom-0 right-0 opacity-5 text-gray-300 text-8xl">
            <i class="fas fa-database"></i> {{-- Ikon database untuk data kosong --}}
        </div>
    @endif
</a>