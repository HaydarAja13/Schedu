@props([
    'title' => 'Judul',
    'description' => 'Deskripsi',
    'icon' => null,
    'class' => '',
    'highlightNumber' => false
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
    
    @if($highlightNumber)
        <p class="text-gray-600 ml-3">
            @php
                echo preg_replace('/(\d+)/', '<strong>$1</strong>', $description);
            @endphp
        </p>
    @else
        <p class="text-gray-600 ml-3">{{ $description }}</p>
    @endif
</a>