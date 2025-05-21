<li>
    <details class="group [&_summary::-webkit-details-marker]:hidden">
        <summary
            class="flex cursor-pointer items-center justify-between rounded-lg p-2 text-white hover:bg-gray-100 hover:text-[#6B56F6]">
            <div class="flex w-full gap-x-4 items-center">
                {{ $icon }}
                <p class="font-semibold text-lg">{{ $title }}</p>
            </div>
            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </summary>  
        <ul class="mt-2  px-4">
            @foreach($children as $child)
            <li>
                <a href="{{ $child['href'] ?? '#' }}"
                    class="block rounded-lg px-4 py-2 text-base font-normal- text-white hover:bg-gray-100 hover:text-[#6B56F6]">
                    {{ $child['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </details>
</li>