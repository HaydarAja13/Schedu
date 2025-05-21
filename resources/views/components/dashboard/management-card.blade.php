{{-- resources/views/components/dashboard/schedule-card.blade.php --}}
@props([
    'description' => 'Lorem ipsum dolor sit amet...',
    'buttonText' => 'Mulai',
    'buttonLink' => '#',
    'image' => 'images/Dashboard1.svg',
])

<!-- Single Container with Full Hover -->
<div class="h-full flex flex-col lg:flex-row bg-white border border-[#E0E7FF] rounded-lg shadow-sm hover:bg-[#F5F7FF] transition-colors duration-200">
    <!-- Text Section (Left) -->
    <div class="p-6  lg:w-[75%]">
        <h3 class="text-2xl font-bold mb-3">
            Manajemen <span class="text-[#6B56F6]">Jadwal</span> Kuliah
        </h3>
        <p class="text-gray-600 mb-4 leading-tight">{{ $description }}</p>
        <a href="{{ $buttonLink }}"
           class="px-6 py-2 bg-[#6B56F6] text-white rounded-lg hover:bg-[#5a48d5] transition inline-block">
            {{ $buttonText }}
        </a>
    </div>
    
    <!-- Image Section (Right) -->
    <div class="lg:w-[60%] flex items-center justify-center p-4 bg-gray-50">
        <img src="{{ asset($image) }}" 
             alt="Ilustrasi Jadwal"
             class="h-auto max-h-[160px] object-contain">
    </div>
</div>