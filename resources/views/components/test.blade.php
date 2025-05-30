{{-- File: resources/views/components/alert.blade.php --}}
@props([
'titleModal' => 'Judul Default',
'contentModal' => 'Konten default.',
'type' => 'success', // Bisa 'success', 'error', atau 'warning'
])

{{--
Elemen 'show' ini akan mereferensikan variabel 'show'
yang didefinisikan dalam x-data pada saat pemanggilan komponen.
--}}
<div x-show="show" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90"
  class="fixed inset-0 z-50 grid place-content-center bg-black/60 p-4" role="dialog" aria-modal="true"
  aria-labelledby="modalTitle" style="display: none;" {{-- Penting untuk Alpine.js agar mengambil alih display dengan
  benar --}}>
  <div class="w-full flex flex-col items-center min-w-md max-w-lg rounded-xl bg-white p-6 shadow-lg">
    @if ($type == 'success')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
      class="size-16 text-green-500 drop-shadow-lg drop-shadow-green-300">
      <path fill-rule="evenodd"
        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
        clip-rule="evenodd" />
    </svg>
    @elseif ($type == 'error')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
      class="size-16 text-red-500 drop-shadow-lg drop-shadow-red-300">
      <path fill-rule="evenodd"
        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
        clip-rule="evenodd" />
    </svg>
    @elseif ($type == 'warning')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
      class="size-16 text-yellow-500 drop-shadow-lg drop-shadow-yellow-300">
      <path fill-rule="evenodd"
        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
        clip-rule="evenodd" />
    </svg>
    @endif

    <h2 id="modalTitle" class="mt-4 text-xl font-semibold text-gray-900 sm:text-2xl">
      {{ $titleModal }}
    </h2>
    <p class="mt-2 text-center text-gray-600">
      {{ $contentModal }}
    </p>

    <div class="mt-6 flex flex-wrap justify-center gap-x-4 gap-y-2">
      @if ($type == 'success')
      <button @click="show = false" type="button"
        class="inline-block rounded-xl cursor-pointer border border-green-600 bg-green-600 px-16 py-2 text-sm font-medium text-white hover:bg-green-700 hover:border-green-700 focus:ring-3 focus:ring-green-300 focus:outline-none">
        Kembali
      </button>
      @elseif ($type == 'error')
      <button @click="show = false" type="button"
        class="inline-block rounded-xl cursor-pointer border border-red-600 bg-red-600 px-16 py-2 text-sm font-medium text-white hover:bg-red-700 hover:border-red-700 focus:ring-3 focus:ring-red-300 focus:outline-none">
        Kembali
      </button>
      @elseif ($type == 'warning')
      <button @click="show = false" type="button"
        class="inline-block rounded-xl cursor-pointer border border-gray-300 bg-white px-8 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-3 focus:ring-gray-200 focus:outline-none">
        Kembali
      </button>
      <button @click="show = false" {{-- Asumsi "Lanjutkan" juga menutup modal, jika tidak, hapus @click ini atau ubah
        logikanya --}} type="button"
        class="inline-block rounded-xl cursor-pointer border border-yellow-500 bg-yellow-500 px-8 py-2 text-sm font-medium text-white hover:bg-yellow-600 hover:border-yellow-600 focus:ring-3 focus:ring-yellow-300 focus:outline-none">
        Lanjutkan
      </button>
      @endif
    </div>
  </div>
</div>