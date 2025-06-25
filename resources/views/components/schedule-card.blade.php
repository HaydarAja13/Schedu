{{-- Props Expected:
    - $title: Title of the card (e.g., 'Jadwal Hari Ini')
    - $icon: Font Awesome class for the main icon (e.g., 'fas fa-calendar-day')
    - $schedules: An array or collection of schedule objects/data
    - $emptyMessage: Message to display if schedules are empty (e.g., 'Tidak ada jadwal untuk hari ini.')
    - $emptySubMessage: Sub-message for empty state (e.g., 'Waktunya istirahat atau belajar mandiri!')
    - $emptyIcon: Icon for the empty state (e.g., 'fas fa-hourglass-half')
    - $link: URL for the card link (optional, default '#')
--}}

@props([
    'title',
    'icon',
    'schedules',
    'emptyMessage',
    'emptySubMessage',
    'emptyIcon' => 'fas fa-info-circle', // Default empty icon
    'link' => '#',
])

<a href="{{ $link }}" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:ring-2 hover:ring-[#6B56F6] transition-all duration-300 transform hover:-translate-y-1 group relative z-50 will-change-transform overflow-hidden">
    {{-- Background gradient effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white opacity-70"></div>
    
    <div class="relative z-10"> {{-- Content is above the gradient --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
            <i class="{{ $icon }} text-[#6B56F6] mr-3 group-hover:scale-110 transition-transform duration-200"></i> {{ $title }}
        </h2>
        <div class="space-y-4">
            @forelse ($schedules as $jadwal)
                <div class="border-l-4 border-[#6B56F6] pl-4 py-2 bg-gray-50 rounded-r-md">
                    <p class="font-semibold text-gray-800">{{ $jadwal->mata_kuliah }}</p>
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt text-xs mr-1"></i> {{ $jadwal->ruangan }} &bull;
                        <i class="fas fa-clock text-xs mr-1"></i> {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }} &bull;
                        <i class="fas fa-user-tie text-xs mr-1"></i> {{ $jadwal->nama_dosen }}
                    </p>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                    <i class="{{ $emptyIcon }} text-4xl mb-3 text-orange-500"></i>
                    <p class="text-lg font-semibold">{{ $emptyMessage }}</p>
                    <p class="text-sm mt-1">{{ $emptySubMessage }}</p>
                </div>
            @endforelse
        </div>
    </div>
</a>