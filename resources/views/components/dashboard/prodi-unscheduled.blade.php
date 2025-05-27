@props(['prodis', 'role', 'totalTerjadwal', 'totalBelumTerjadwal'])

<div class="bg-white border border-[#E0E7FF] rounded-lg shadow-sm p-6 h-full flex flex-col">
    <h3 class="text-xl font-semibold text-black mb-4">Prodi Belum Terjadwal</h3>

    {{-- Info total prodi terjadwal dan belum terjadwal --}}
    <div class="mb-4 text-sm text-gray-700">
        <p>Prodi Terjadwal: <span class="font-bold text-green-600">{{ $totalTerjadwal }}</span></p>
        <p>Prodi Belum Terjadwal: <span class="font-bold text-red-600">{{ $totalBelumTerjadwal }}</span></p>
    </div>

    @if (count($prodis) > 0)
        <div class="space-y-3 flex-grow overflow-y-auto pr-2 custom-scrollbar">
            @foreach ($prodis as $prodi)
                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 shadow-sm relative">
                    {{-- Garis ungu di kiri --}}
                    <div class="absolute inset-y-0 left-0 w-1.5 bg-[#6B56F6] rounded-s-lg"></div>

                    <div class="flex items-center ml-3">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $prodi['nama_prodi'] }}</p>
                        </div>
                    </div>
                    {{-- UBAH BAGIAN HREF INI SAJA --}}
                    <a href="/{{ $role }}/schedule"
                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                        Jadwalkan
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center flex-grow flex items-center justify-center">
            Semua program studi sudah terjadwal.
        </p>
    @endif
</div>

{{-- CSS untuk custom-scrollbar (tetap sama) --}}
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