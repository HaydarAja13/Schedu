@props(['active' => false, 'title', 'icon'])

<li>
    <a {{ $attributes }} class="{{ $active ? 'bg-white text-[#6B56F6]' : 'text-white bg-transparent hover:text-[#6B56F6] hover:bg-white' }} block rounded-lg p-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false    ' }}">
        <div class="flex w-full gap-x-4 items-center">
            {{ $icon }}
            <p class="font-semibold text-lg">{{ $title }}</p>
        </div>
    </a>
</li>