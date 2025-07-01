<div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 min-h-[400px] flex flex-col">
    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center flex-shrink-0">
        {{-- Menggunakan ikon kalender statis untuk konsistensi visual, dengan judul dinamis --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-[#6B56F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ $title }}
    </h2>

    <div class="space-y-4 flex-grow flex flex-col">
        @forelse($schedules as $schedule)
            {{-- Mengadopsi desain "kartu di dalam kartu" --}}
            <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:ring-2 hover:ring-violet-200 transition-all duration-300 border-l-4 border-[#6B56F6]">
                {{--
                    CATATAN PENTING:
                    Sesuaikan nama variabel di bawah ini (cth: $schedule['course_name'])
                    dengan nama properti/kolom dari objek $schedule Anda.
                --}}
                <p class="font-semibold text-gray-800">{{ $schedule['course_name'] ?? 'Nama Mata Kuliah' }}</p>
                <div class="mt-2 space-y-1 text-sm text-gray-600">
                    <p class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                        {{ $schedule['location'] ?? 'Lokasi Kelas' }}
                    </p>
                    <p class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                        {{ $schedule['time'] ?? '00:00 - 00:00' }}
                    </p>
                    <p class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.357.442zM20 15.326a.78.78 0 01-.357-.442c.042-.216.051-.436.028-.658a6.484 6.484 0 00-1.905-3.959 3 3 0 014.308 3.516.78.78 0 01-.358.442zM14 8a2 2 0 11-4 0 2 2 0 014 0zM10 18a6 6 0 00-4.545-5.716 4 4 0 01-3.376 3.42A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.42-2.296 4 4 0 01-3.376-3.42A6 6 0 0010 18z" /></svg>
                        {{ $schedule['lecturer'] ?? 'Nama Dosen' }}
                    </p>
                </div>
            </div>
        @empty
            {{-- Menggunakan logika @empty dari komponen asli, dengan gaya yang disempurnakan --}}
            <div class="text-center text-gray-500 flex-grow flex flex-col justify-center items-center">
                <div class="text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-lg font-semibold text-gray-600">Jadwal belum tersedia</p>
                <p class="text-sm mt-1 text-gray-400">Jadwal mengajar belum tergenerate</p>
                @if($title == 'Jadwal Ajar Hari Ini')
                    <button class="mt-4 px-5 py-2 bg-[#6B56F6] text-white font-semibold rounded-lg hover:bg-[#5A4AD0] transition-colors flex items-center shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Periksa Kembali
                    </button>
                @endif
            </div>
        @endforelse
    </div>
</div>