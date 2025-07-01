<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 relative overflow-hidden min-h-[400px] flex flex-col">
    {{-- Latar belakang dari tema --}}
    <img src="{{ asset('images/sidebar-background.svg') }}" alt="Background Pattern"
        class="absolute inset-0 w-full h-full object-cover object-top z-0 opacity-70">

    {{-- Konten di atas latar belakang --}}
    <div class="relative z-10 flex flex-col flex-grow">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center flex-shrink-0">
            {{-- Ikon SVG yang sesuai tema --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-[#6B56F6]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Permintaan Izin
        </h2>

        <div class="space-y-2 flex-grow flex flex-col">
            @forelse($requests as $request)
                {{-- Desain baru untuk setiap item permintaan --}}
                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors @if(!$loop->last) border-b border-gray-100 @endif">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ $request['day'] }}, <span class="font-normal text-gray-600">{{ $request['time'] }}</span></p>
                        <p class="text-sm text-gray-500 mt-1">{{ $request['reason'] }}</p>
                    </div>
                    {{-- Badge status tetap dipertahankan karena sudah baik --}}
                    <span class="flex-shrink-0 ml-4 px-3 py-1 text-xs font-bold rounded-full {{ $request['statusVariant'] == 'success' ? 'bg-green-100 text-green-800' : ($request['statusVariant'] == 'warning' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $request['status'] }}
                    </span>
                </div>
            @empty
                {{-- Desain baru untuk status kosong --}}
                <div class="text-center text-gray-500 flex-grow flex flex-col justify-center items-center">
                    <div class="text-gray-300 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-600">Belum ada permintaan izin</p>
                    <p class="text-sm mt-1 text-gray-400">Anda dapat membuat permintaan izin baru.</p>
                    <button class="mt-4 px-5 py-2 bg-[#6B56F6] text-white font-semibold rounded-lg hover:bg-[#5A4AD0] transition-colors flex items-center shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Buat Permintaan
                    </button>
                </div>
            @endforelse
        </div>
    </div>
</div>