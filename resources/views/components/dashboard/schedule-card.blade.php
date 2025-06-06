<div class="h-full bg-white rounded-lg shadow-sm lg:col-span-2 p-4">
    <p class="text-lg font-semibold">Program Studi</p>
    <div class="flex itenms-center gap-x-4 mt-2">
        <div
            class="rounded-full flex gap-x-2 items-center bg-gray-100  px-2.5 text-xs py-1 whitespace-nowrap text-gray-500">
            <p>Terjadwal</p>
            <div
                class="bg-green-400  rounded-full size-4 text-xs flex items-center justify-center text-white font-semibold">
                <span>{{ $prodiSudahCount }}</span>
            </div>
        </div>
        <div
            class="rounded-full flex gap-x-2 items-center bg-gray-100  px-2.5 text-xs py-1 whitespace-nowrap text-gray-500">
            <p>Belum Terjadwal</p>
            <div
                class="bg-red-400  rounded-full size-4 text-xs flex items-center justify-center text-white font-semibold">
                <span>{{ $prodiBelumCount }}</span>
            </div>
        </div>
    </div>
    <div class="grid gap-y-4 mt-4">
        @foreach ($prodiBelum as $data)
        <div
            class="shadow-md rounded-lg p-2.5 border-l-6 border-purple-600 bg-[#FDFDFD] flex items-center justify-between">
            <p class="text-sm font-medium">{{ $data->nama_prodi }}</p>
            <a class="inline-block rounded-lg bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] px-6 py-2 size-fit text-xs font-medium text-white "
                href="#">
                <div class="flex items-center justify-center gap-x-2">
                    Jadwalkan
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                    </svg>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>