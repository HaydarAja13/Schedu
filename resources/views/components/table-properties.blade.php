<div class="flex items-center justify-between mb-4 mt-2">
    <p class="text-base text-gray-500 hidden md:block">{{ $subtitle }}</p>
    <div
        class="grid grid-cols-3 md:flex md:flex-row items-center w-full justify-between md:w-fit md:justify-center gap-y-2 gap-x-4 md:gap-x-8">
        <div
            class="col-span-2 flex items-center rounded-lg w-full bg-white px-3 py-2 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 mr-2 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="search"
                class="block w-full bg-transparent text-base outline-none placeholder:text-gray-400 sm:text-sm/6"
                placeholder="Cari...">
        </div>
        <a class="inline-block rounded-lg bg-gradient-to-tr w-full md:w-fit from-[#6B56F6] to-[#8C4AF2] px-4 py-2.5 text-sm font-medium text-white hover:bg-gradient-to-bl hover:from-[#7c3bdd] hover:to-[#6955e8]"
            href="{{ $link }}">
            <div class="flex items-center justify-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah
            </div>
        </a>
    </div>
</div>