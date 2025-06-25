<!-- resources/views/components/cards/time-off-requests.blade.php -->
<div class="bg-white p-6 rounded-xl shadow-lg relative z-50 min-h-[400px]">
    <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
        <i class="fas fa-calendar-times text-red-500 mr-3"></i> Permintaan Izin
    </h2>
    <div class="space-y-4">
        @forelse($requests as $request)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex-1">
                    <p class="text-lg font-semibold text-gray-800">{{ $request['day'] }}, <span class="font-normal text-base">{{ $request['time'] }}</span></p>
                    <p class="text-sm text-gray-600 mt-1">{{ $request['reason'] }}</p>
                </div>
                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $request['statusVariant'] == 'success' ? 'bg-green-100 text-green-800' : ($request['statusVariant'] == 'warning' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ $request['status'] }}
                </span>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500 h-full flex flex-col justify-center items-center">
                <i class="fas fa-calendar-check text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg font-semibold">Belum ada permintaan izin</p>
                <p class="text-sm mt-1">Ketikkan izin Anda di sini</p>
                <button class="mt-4 px-4 py-2 bg-[#6B56F6] text-white rounded-lg hover:bg-[#5A4AD0] transition-colors">
                    <i class="fas fa-plus mr-2"></i> Buat Permintaan
                </button>
            </div>
        @endforelse
    </div>
</div>

