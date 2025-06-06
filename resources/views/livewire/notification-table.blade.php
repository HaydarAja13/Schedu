<div class="mt-4 grid grid-cols-1 md:grid-cols-3">
    <table class="w-full">
        @foreach ($notifikasi as $data)
        <tr>
            <td>
                <div class="grid gap-y-2 hover:bg-[#E5E1FF] p-2 rounded-l-lg hover:cursor-pointer">
                    <p class="text-sm"><span class="font-semibold">Permintaan Ubah Jadwal</span> {{
                        $data->dosen->nama_dosen
                        }} tidak dapat mengajar pada {{ $data->hari }}, pukul...</p>
                    @if ($data->status == 'Belum Divalidasi')
                    <span
                        class="inline-flex items-center w-fit justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="-ms-1 me-1.5 size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>

                        <p class="text-sm whitespace-nowrap">Belum Divalidasi</p>
                    </span>
                    @endif
                    <p class="text-xs text-gray-500">{{ $data->created_at }}</p>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="bg-[#F8F8F8] w-full col-span-2 rounded-r-lg p-4">
        aa
    </div>
</div>