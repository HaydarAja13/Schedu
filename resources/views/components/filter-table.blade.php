<div class="relative inline-block text-left" x-data="{ open: false }">
    <div>
        <button type="button"
            class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
            id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
            @keydown.escape.window="open = false">
            {{ $judulFilter }}
            <svg :class="{'rotate-180': open, 'rotate-0': !open}"
                class="transition-transform duration-200 -mr-1 ml-1 size-5 shrink-0 text-gray-400 group-hover:text-gray-500"
                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false"
        class="absolute left-0 z-30 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black/5 focus:outline-hidden"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-900" role="menuitem" tabindex="-1"
                id="menu-item-0">Most Popular</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="menu-item-1">Best Rating</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="menu-item-2">Newest</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="menu-item-3">Price: Low to High</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="menu-item-4">Price: High to Low</a>
        </div>
    </div>
</div>