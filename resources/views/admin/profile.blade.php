<x-template :role="'admin'" title="Halo, {{ $user->nama_admin ?? '-' }}">
  <x-slot:content>
    <div class="grid grid-cols-1 w-full mt-4">
      <div class="relative h-28 overflow-hidden rounded-t-lg">
        <div class="absolute inset-0 z-10">
          <img src="{{ asset('images/login-background.svg') }}" alt="background"
            class="w-full h-full object-cover object-bottom opacity-60">
        </div>
        <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#8C4AF2] to-[#6B56F6]"></div>
        <div class="relative flex items-end justify-end size-full z-20 p-4">
          <img src="{{ asset('images/schedu-logo-white.svg') }}" alt="" class="w-20 md:w-26">
        </div>
      </div>
      <div class="bg-white px-10 grid gap-y-2 py-4 rounded-b-lg shadow-lg">
        <div
          class="relative flex items-center justify-center bg-white size-fit p-1.5 -mt-16 z-30 rounded-full">
          <img src="https://placehold.co/100" alt="" class="size-22 md:size-28 rounded-full">
        </div>
        <p class="text-lg md:text-xl font-semibold">{{ $user->nama_admin }}</p>
        <span
          class="rounded-full font-semibold bg-purple-100 px-2.5 uppercase py-0.5 text-sm whitespace-nowrap text-purple-700 w-fit">
          {{ $role }}</span>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-2 items-center">
          <p class="font-medium text-sm md:text-base">NIP</p>
          <div class="mt-2 col-span-2">
            <input type="number" name="nip" id="nip" readonly value="{{ $user->nip }}"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-sm md:text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500 sm:text-sm/6">
          </div>
          <p class="font-medium text-sm md:text-base">Email</p>
          <div class="mt-2 col-span-2">
            <input type="email" name="email" id="email" readonly value="{{ $user->email }}"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-sm md:text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500 sm:text-sm/6">
          </div>
          <p class="font-medium text-sm md:text-base">No Telp</p>
          <div class="mt-2 col-span-2">
            <input type="number" name="no_telp" id="no_telp" readonly value="{{ $user->no_hp }}"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-sm md:text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500 sm:text-sm/6">
          </div>
        </div>
        <div class="flex justify-end items-center">
          <a class="inline-block w-fit rounded-lg  bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] px-6 py-2 text-sm font-medium text-white focus:ring-3 focus:outline-hidden mt-4"
            href="#">
            <div class="flex items-center justify-center gap-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
              <p>Ubah</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </x-slot:content>
</x-template>