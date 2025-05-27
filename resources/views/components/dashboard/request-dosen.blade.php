@props(['requests', 'role']) {{-- <=== TAMBAHKAN 'role' DI SINI --}}

<div class="bg-white p-6 rounded-lg shadow-md h-full flex flex-col">
    <h3 class="text-xl font-bold mb-4">Permintaan Ubah Jadwal</h3>

    @if (count($requests) > 0)
        <div class="space-y-4 flex-grow overflow-y-auto pr-2 custom-scrollbar">
            @foreach ($requests as $request)
                {{-- Bungkus setiap item dengan <a> tag --}}
                <a href="/{{ $role }}/notification" class="flex items-center justify-between p-2 rounded hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $request['foto_profil'] }}" alt="{{ $request['nama_dosen'] }}"
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $request['nama_dosen'] }}</p>
                            <p class="text-sm text-gray-500">{{ $request['deskripsi'] }}</p>
                        </div>
                    </div>
                    {{-- Status Indicator (Lingkaran) --}}
                    <div class="w-3 h-3 rounded-full
                        @if ($request['status'] == 'pending') bg-red-500
                        @elseif ($request['status'] == 'approved') bg-green-500
                        @else bg-gray-400 @endif
                        ml-4"></div>
                </a> {{-- Tutup <a> tag --}}
            @endforeach
        </div>
        <div class="mt-4 text-center">
            {{-- Ubah href pada link "Lihat Semua" --}}
            <a href="/{{ $role }}/notification" class="text-[#6B56F6] hover:text-[#5244C3] font-semibold text-sm">Lihat Semua</a>
        </div>
    @else
        <p class="text-gray-500 text-center flex-grow flex items-center justify-center">
            Tidak ada permintaan perubahan jadwal saat ini.
        </p>
    @endif
</div>

{{-- CSS untuk custom-scrollbar --}}
<style>
/* For Webkit browsers (Chrome, Safari) */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px; /* width of the scrollbar */
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1; /* color of the track */
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #888; /* color of the scroll thumb */
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #555; /* color of the scroll thumb on hover */
}

/* For Firefox */
.custom-scrollbar {
    scrollbar-width: thin; /* "auto" or "thin" */
    scrollbar-color: #888 #f1f1f1; /* thumb and track color */
}
</style>