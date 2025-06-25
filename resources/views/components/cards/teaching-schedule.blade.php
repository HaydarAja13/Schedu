<!-- resources/views/components/cards/teaching-schedule.blade.php -->
<div class="bg-white p-6 rounded-xl shadow-lg relative z-50 min-h-[400px]">
    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
        <i class="fas {{ $icon }} text-[#6B56F6] mr-3"></i> {{ $title }}
    </h2>
    <div class="space-y-4">
        @forelse($schedules as $schedule)
            <!-- Konten jadwal seperti sebelumnya -->
        @empty
            <div class="text-center py-8 text-gray-500 h-full flex flex-col justify-center items-center">
                <i class="fas fa-calendar-plus text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg font-semibold">Jadwal belum tersedia</p>
                <p class="text-sm mt-1">Jadwal mengajar belum tergenerate</p>
                @if($title == 'Jadwal Ajar Hari Ini')
                    <button class="mt-4 px-4 py-2 bg-[#6B56F6] text-white rounded-lg hover:bg-[#5A4AD0] transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i> Periksa Kembali
                    </button>
                @endif
            </div>
        @endforelse
    </div>
</div>