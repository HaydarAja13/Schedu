<div x-data="{ selectedRow: null }" class="mt-4 grid grid-cols-1 md:grid-cols-3" @click.away="selectedRow = null">
    <table class="w-full h-fit">
        @foreach ($notifikasi as $data)
        <tr class="cursor-pointer transition-all duration-200"
            @click="selectedRow = '{{ $data->id }}'; $wire.selectNotifikasi({{ $data->id }})">
            <td>
                <div class="grid gap-y-2 hover:bg-[#E5E1FF] px-2 py-4 hover:cursor-pointer"
                    :class="{ 'bg-[#E5E1FF]': selectedRow === '{{ $data->id }}' }">
                    <p class="text-sm"><span class="font-semibold">Permintaan Ubah Jadwal</span> {{
                        $data->dosen->nama_dosen
                        }} tidak dapat mengajar pada {{ $data->hari }}, pukul...</p>
                    @if ($data->status == 'Belum Divalidasi')
                    <p class="text-sm font-semibold">Verifikasi Dibutuhkan</p>
                    @endif
                    <p class="text-xs text-gray-500">{{ $data->created_at }}</p>
                </div>
                <hr class="border-gray-300">
            </td>
        </tr>
        @endforeach
    </table>
    {{-- detail --}}
    <div class="bg-[#F8F8F8] w-full h-full col-span-2 rounded-r-lg p-8 flex flex-col gap-y-4 items-center justify-center"
        :class="{ 'hidden': selectedRow }">
        <img src="{{ asset('images/notification-not-select.svg') }}" alt="" class="size-52">
        <p class="text-lg text-gray-500 font-normal">Tidak ada Notifikasi yang dipilih</p>
    </div>
    <div class="bg-[#F8F8F8] w-full col-span-2 rounded-r-lg p-4" :class="{ 'hidden': !selectedRow }">
        @if ($selectedNotifikasi)
        <div class="px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                stroke="currentColor" class="size-7 mb-4 hover:cursor-pointer" @click="selectedRow = null">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
            <p class="text-sm mb-4">Permintaan ubah jadwal diajukan oleh <span class="font-semibold">{{
                    $selectedNotifikasi->dosen->nama_dosen ?? '-' }}</span> untuk perkuliahan:</p>
            <p class="text-sm mb-2 text-red-500 italic">*Tidak dapat mengajar mahasiswa pada</p>
            <div class="grid grid-cols-4 mb-4">
                <p class="text-sm font-semibold w-fit">Hari</p>
                <p class="text-sm col-span-3">: {{ $selectedNotifikasi->hari ?? '-' }}</p>
                <p class="text-sm font-semibold w-fit">Jam Mulai</p>
                <p class="text-sm col-span-3">: {{ $selectedNotifikasi->jamMulai->keterangan ?? '-' }}</p>
                <p class="text-sm font-semibold w-fit">Jam Selesai</p>
                <p class="text-sm col-span-3">: {{ $selectedNotifikasi->jamSelesai->keterangan ?? '-' }}</p>
            </div>
            @if ($selectedNotifikasi->status == 'Divalidasi')
            <span
                class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="-ms-1 me-1.5 size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <p class="text-xs whitespace-nowrap">Divalidasi</p>
            </span>
            @elseif($selectedNotifikasi->status == 'Ditolak')
            <span class="inline-flex items-center justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="-ms-1 me-1.5 size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            
                <p class="text-xs whitespace-nowrap">Ditolak</p>
            </span>
            @endif
            @if ($selectedNotifikasi->status == 'Belum Divalidasi')
            <p class="text-sm mb-4">Mohon lakukan verifikasi permintaan ini</p>
            <div class="flex justify-end items-center gap-x-4">
                <form action="{{ route('notification.update', $selectedNotifikasi->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="Ditolak" hidden name="status">
                    <button
                        class="inline-block hover:cursor-pointer rounded-lg px-5 py-2 text-xs font-medium bg-red-500 text-white shadow-sm"
                        type="submit">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Tolak</p>
                        </div>
                    </button>
                </form>
                <form action="{{ route('notification.update', $selectedNotifikasi->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="Divalidasi" hidden name="status">
                    <button
                        class="inline-block hover:cursor-pointer rounded-lg px-5 py-2 text-xs font-medium bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white shadow-sm"
                        type="submit">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Terima</p>
                        </div>
                    </button>
                </form>
            </div>
            @endif
        </div>
        @else
        <p>Pilih notifikasi untuk melihat detail.</p>
        @endif
    </div>
</div>