{{-- resources/views/components/dashboard/simple-card.blade.php --}}
@props([
    'title' => 'Judul',
    'description' => 'Deskripsi',
    'icon' => null,
    'class' => '',
])

<a 
    href="#" 
    class="block p-4 bg-white border border-[#E0E7FF] rounded-lg shadow-sm hover:bg-[#F5F7FF] {{ $class }}"
>
    @if($icon)
        <div class="flex items-center gap-3 mb-2">
            <i class="{{ $icon }} text-[#6B56F6] text-xl"></i>
            <h3 class="text-lg font-semibold text-[#6B56F6]">{{ $title }}</h3>
        </div>
    @else
        <h3 class="text-lg font-semibold text-[#6B56F6] mb-2">{{ $title }}</h3>
    @endif
    <p class="text-gray-600 ml-3">{{ $description }}</p>
</a>