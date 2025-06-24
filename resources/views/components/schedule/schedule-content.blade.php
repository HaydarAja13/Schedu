<div class="h-auto rounded-lg bg-white shadow-sm lg:col-span-2 p-4">
    <div class="flex items-center justify-between">
        <p class="text-lg font-semibold">Jadwal</p>
        <a class="inline-block rounded-xl bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] px-6 py-2.5 text-xs font-medium text-white"
            href="schedule-detail">
            <div class="flex items-center justify-center gap-x-2">
                <p class="text-sm">Lihat Semua</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </a>
    </div>
    @foreach($programStudis as $prodi)
        <div class="w-full h-auto flex items-center justify-between bg-[#FDFDFD] rounded-xl mt-3 shadow-md px-6 py-4 border-l-6 border-purple-600">
            <p class="font-semibold text-sm">{{ $prodi->nama_prodi }}</p>
            <a class="inline-block rounded-xl bg-white px-6 py-2.5 text-xs font-medium text-purple-600 shadow-sm" href="schedule-detail">
                <div class="flex items-center justify-center gap-x-2">
                    <p class="text-xs">Detail</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
        </div>
    @endforeach
</div>