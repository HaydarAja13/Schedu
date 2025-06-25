<!-- resources/views/components/cards/class-count.blade.php -->
<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-teal-50 to-white opacity-70"></div>
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">Jumlah Kelas</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $count }}</p>
            <p class="text-xs text-gray-400 mt-1">Kelas yang Anda Ampu</p>
        </div>
        <div class="text-teal-500 text-4xl bg-teal-500/10 p-3 rounded-full">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
    </div>
    <div class="absolute bottom-0 right-0 opacity-10 text-teal-500 text-8xl">
        <i class="fas fa-school"></i>
    </div>
</div>