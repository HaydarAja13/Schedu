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
    <div class="bg-[#F8F8F8] w-full col-span-2 rounded-r-lg p-8 flex flex-col gap-y-4 items-center justify-center" :class="{ 'hidden': selectedRow }">
        <img src="{{ asset('images/notification-not-select.svg') }}" alt="" class="size-52">
        <p class="text-lg text-gray-500 font-normal">Tidak ada Notifikasi yang dipilih</p>
    </div>
    <div class="bg-[#F8F8F8] w-full col-span-2 rounded-r-lg p-4" :class="{ 'hidden': !selectedRow }">
        @if ($selectedNotifikasi)
        <div>
            <h2 class="font-bold text-lg mb-2">Detail Notifikasi</h2>
            <p><span class="font-semibold">Dosen:</span> {{ $selectedNotifikasi->dosen->nama_dosen ?? '-' }}</p>
            <p><span class="font-semibold">Hari:</span> {{ $selectedNotifikasi->hari ?? '-' }}</p>
            <p><span class="font-semibold">Jam Mulai:</span> {{ $selectedNotifikasi->jamMulai->nama_jam ?? '-' }}</p>
            <p><span class="font-semibold">Jam Selesai:</span> {{ $selectedNotifikasi->jamSelesai->nama_jam ?? '-' }}
            </p>
            <p><span class="font-semibold">Keterangan:</span> {{ $selectedNotifikasi->keterangan ?? '-' }}</p>
            <p><span class="font-semibold">Status:</span> {{ $selectedNotifikasi->status ?? '-' }}</p>
            <p><span class="font-semibold">Dibuat:</span> {{ $selectedNotifikasi->created_at ?? '-' }}</p>
        </div>
        @else
        <p>Pilih notifikasi untuk melihat detail.</p>
        @endif
    </div>
</div>