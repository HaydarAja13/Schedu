<div>
    <div
        x-show="showAlert"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        @keydown.escape.window="showAlert = false"
        class="fixed grid inset-0 z-50 place-content-center bg-black/60 p-4" role="dialog" aria-modal="true"
        aria-labelledby="modalTitle">
        <div
            x-transition:enter="transition ease-out duration-200 delay-150"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-4"
            class="w-full flex flex-col items-center min-w-md rounded-xl bg-white p-6 shadow-lg"
            @click.away="showAlert = false">
            @if ($type == 'success')
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-16 text-green-500 drop-shadow-lg drop-shadow-green-300">
                <path fill-rule="evenodd"
                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                    clip-rule="evenodd" />
            </svg>
            @elseif ($type =='error')
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-16 text-red-500 drop-shadow-lg drop-shadow-red-300">
                <path fill-rule="evenodd"
                    d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                    clip-rule="evenodd" />
            </svg>
            @elseif ($type =='warning')
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-16 text-yellow-500 drop-shadow-lg drop-shadow-yellow-300">
                <path fill-rule="evenodd"
                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                    clip-rule="evenodd" />
            </svg>
            @endif
            <h2 id="modalTitle" class="text-xl font-semibold text-gray-900 sm:text-2xl">
                {{ $titleModal }}
            </h2>
            <p class="text-center text-gray-600">
                {{ $contentModal }}
            </p>
            @if ($type =='success')
            <button type="button" @click="showAlert = false"
                class="inline-block rounded-xl mt-4 cursor-pointer border border-green-600 bg-green-600 px-16 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-green-600 focus:ring-3 focus:outline-hidden">
                Kembali
            </button>
            @elseif ($type =='error')
            <button type="button" @click="showAlert = false"
                class="inline-block rounded-xl mt-4 cursor-pointer border border-red-600 bg-red-600 px-16 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-red-600 focus:ring-3 focus:outline-hidden">
                Kembali
            </button>
            @elseif ($type =='warning')
            <div class="flex items-center justify-center gap-x-4">
                <button type="button" @click="showAlert = false"
                    class="inline-block rounded-xl mt-4 cursor-pointer border border-gray-600 bg-white px-16 py-2 text-sm font-medium text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-3 focus:outline-hidden">
                    Kembali
                </button>
                <form method="POST" action="{{ $route }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-block rounded-xl mt-4 cursor-pointer border border-yellow-600 bg-yellow-600 px-16 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-yellow-600 focus:ring-3 focus:outline-hidden">
                        Lanjutkan
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>