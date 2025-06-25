<!-- resources/views/components/cards/teaching-hours.blade.php -->
<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-white opacity-70"></div>
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">Jam Mengajar</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $hours }} Jam</p>
            <p class="text-xs text-gray-400 mt-1">Per Minggu (Rata-rata)</p>
        </div>
        <div class="text-orange-500 text-4xl bg-orange-500/10 p-3 rounded-full">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    <div class="absolute bottom-0 right-0 opacity-10 text-orange-500 text-8xl">
        <i class="fas fa-hourglass-half"></i>
    </div>
</div>