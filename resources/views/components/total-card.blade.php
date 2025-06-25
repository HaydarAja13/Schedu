<div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform min-h-[140px] flex flex-col justify-between">
    {{-- Opsional: Gradient background samar untuk konsistensi visual yang lebih dalam --}}
    {{-- Jika Anda ingin efek gradient seperti kartu sebelumnya, uncomment baris ini dan sesuaikan warnanya --}}
    {{-- <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-white opacity-70"></div> --}}

    <div class="relative z-10 flex flex-col justify-between h-full">
        <p class="text-4xl font-bold text-[#6B56F6] leading-tight">{{ $total }}</p>
        <p class="text-base font-semibold text-gray-1000 mt-2">{{ $title }}</p>
        
        {{-- Ikon samar di sudut, kini menggunakan prop $iconClass --}}
        <div class="absolute bottom-3 right-3 opacity-20 text-[#6B56F6] text-5xl">
            <i class="{{ $iconClass ?? 'fas fa-info-circle' }}"></i> 
            {{-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ --}}
        </div>
    </div>
</div>