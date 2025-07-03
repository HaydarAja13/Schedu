<x-template :role="'admin'" :title="'Data Jadwal'">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)] mt-4">
            <div class="container mx-auto px-4 py-6" x-data="scheduleData()" x-init="init()">
                <!-- Header and Filters -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4 gap-x-4">
                        <a href="{{ route('admin.schedule-detail') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg> </a>
                        <h1 class="text-2xl font-bold text-gray-800">Jadwal Kelompok Prodi {{ $id_kelompok_prodi }}
                        </h1>
                    </div>

                    <!-- Filter Hari -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="day in allPossibleDays" :key="day">
                                <button @click="filterByDay(day)"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors" :class="{
                                        'bg-blue-600 text-white': activeDay === day,
                                        'bg-gray-200 text-gray-700 hover:bg-gray-300': activeDay !== day && availableDays.includes(day),
                                        'bg-gray-100 text-gray-400 cursor-not-allowed': !availableDays.includes(day)
                                    }" x-text="day" :disabled="!availableDays.includes(day)"
                                    :title="!availableDays.includes(day) ? 'Tidak ada jadwal di hari ini' : ''"></button>
                            </template>
                            <button @click="resetDayFilter()"
                                class="px-4 py-2 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 text-sm font-medium transition-colors"
                                :class="{'bg-blue-600 text-white': activeDay === null}">
                                Semua Hari
                            </button>
                        </div>
                    </div>

                    <!-- Program Studi Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="prodi in programStudiList" :key="prodi.id">
                                <button @click="filterByProdi(prodi.id)"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors" :class="{
                                        'bg-blue-600 text-white': activeProdi === prodi.id,
                                        'bg-gray-200 text-gray-700 hover:bg-gray-300': activeProdi !== prodi.id
                                    }" x-text="prodi.nama"></button>
                            </template>
                            <button @click="resetProdiFilter()"
                                class="px-4 py-2 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 text-sm font-medium transition-colors"
                                :class="{'bg-blue-600 text-white': activeProdi === null}">
                                Semua Program Studi
                            </button>
                        </div>
                    </div>

                    <!-- Kelas Filter -->
                    <div x-show="filteredKelas.length > 0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="kelas in filteredKelas" :key="kelas">
                                <button @click="filterByKelas(kelas)"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors" :class="{
                                        'bg-blue-600 text-white': activeKelas === kelas,
                                        'bg-gray-200 text-gray-700 hover:bg-gray-300': activeKelas !== kelas
                                    }" x-text="kelas"></button>
                            </template>
                            <button @click="resetKelasFilter()"
                                class="px-4 py-2 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 text-sm font-medium transition-colors"
                                :class="{'bg-blue-600 text-white': activeKelas === null}">
                                Semua Kelas
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6" x-show="filteredSchedules.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-blue-800">Total Jadwal</h3>
                            <p class="text-2xl font-bold text-blue-600" x-text="filteredSchedules.length"></p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-green-800">Total Ruang</h3>
                            <p class="text-2xl font-bold text-green-600" x-text="resources.total_ruang"></p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-purple-800">Slot Waktu</h3>
                            <p class="text-2xl font-bold text-purple-600" x-text="resources.total_jam_slot"></p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-yellow-800">Hari Aktif</h3>
                            <p class="text-2xl font-bold text-yellow-600"
                                x-text="availableDays.length + ' dari ' + allPossibleDays.length"></p>
                        </div>
                    </div>
                </div>

                <!-- Schedule Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" x-show="filteredSchedules.length > 0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Hari</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mata Kuliah</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dosen</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Program Studi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kelas</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ruang</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Durasi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="(schedule, index) in filteredSchedules" :key="index">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.jadwal.hari"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.mata_kuliah"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.dosen"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.program_studi"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.kelas_lengkap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span x-text="schedule.jadwal.jam_awal"></span> - <span
                                                x-text="schedule.jadwal.jam_akhir"></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.jadwal.ruang"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                            x-text="schedule.jadwal.durasi + ' jam'"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Empty State -->
                <div x-show="filteredSchedules.length === 0" class="bg-white rounded-lg shadow-md p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada jadwal</h3>
                    <p class="mt-1 text-sm text-gray-500" x-text="getEmptyStateMessage()"></p>
                    <div class="mt-6">
                        <button @click="resetFilters()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function scheduleData() {
                return {
                    schedules: @json($data['berhasil_ditempatkan']),
                    programStudiList: @json($program_studi_list),
                    kelasList: @json($kelas_list),
                    availableDays: @json($available_days),
                    allPossibleDays: @json($all_possible_days),
                    resources: @json($data['resources']),
                    activeDay: null,
                    activeProdi: null,
                    activeKelas: null,
                    filteredSchedules: [],
                    filteredKelas: [],
                    
                    init() {
                        this.filteredSchedules = this.schedules;
                        this.filteredKelas = this.kelasList;
                    },
                    
                    filterByDay(day) {
                        this.activeDay = day;
                        this.applyFilters();
                    },
                    
                    filterByProdi(prodiId) {
                        this.activeProdi = prodiId;
                        this.activeKelas = null;
                        this.applyFilters();
                    },
                    
                    filterByKelas(kelas) {
                        this.activeKelas = kelas;
                        this.applyFilters();
                    },
                    
                    resetDayFilter() {
                        this.activeDay = null;
                        this.applyFilters();
                    },
                    
                    resetProdiFilter() {
                        this.activeProdi = null;
                        this.activeKelas = null;
                        this.applyFilters();
                    },
                    
                    resetKelasFilter() {
                        this.activeKelas = null;
                        this.applyFilters();
                    },
                    
                    resetFilters() {
                        this.activeDay = null;
                        this.activeProdi = null;
                        this.activeKelas = null;
                        this.applyFilters();
                    },
                    
                    applyFilters() {
                        let filtered = this.schedules;
                        
                        // Filter by hari
                        if (this.activeDay) {
                            filtered = filtered.filter(schedule => schedule.jadwal.hari === this.activeDay);
                        }
                        
                        // Filter by program studi
                        if (this.activeProdi) {
                            filtered = filtered.filter(schedule => schedule.prodi_id === this.activeProdi);
                        }
                        
                        // Filter by kelas
                        if (this.activeKelas) {
                            filtered = filtered.filter(schedule => schedule.kelas_lengkap === this.activeKelas);
                        }
                        
                        this.filteredSchedules = filtered;
                        this.updateFilteredKelas();
                    },
                    
                    updateFilteredKelas() {
                        // Get unique kelas from filtered schedules
                        let schedules = this.schedules;
                        
                        if (this.activeDay) {
                            schedules = schedules.filter(schedule => schedule.jadwal.hari === this.activeDay);
                        }
                        
                        if (this.activeProdi) {
                            schedules = schedules.filter(schedule => schedule.prodi_id === this.activeProdi);
                        }
                        
                        const kelasSet = new Set(schedules.map(schedule => schedule.kelas_lengkap));
                        this.filteredKelas = Array.from(kelasSet).sort();
                    },
                    
                    getEmptyStateMessage() {
                        if (this.activeDay && this.activeProdi && this.activeKelas) {
                            return `Tidak ada jadwal untuk hari ${this.activeDay}, program studi terpilih, dan kelas ${this.activeKelas}`;
                        } else if (this.activeDay && this.activeProdi) {
                            return `Tidak ada jadwal untuk hari ${this.activeDay} dan program studi terpilih`;
                        } else if (this.activeDay && this.activeKelas) {
                            return `Tidak ada jadwal untuk hari ${this.activeDay} dan kelas ${this.activeKelas}`;
                        } else if (this.activeProdi && this.activeKelas) {
                            return `Tidak ada jadwal untuk program studi terpilih dan kelas ${this.activeKelas}`;
                        } else if (this.activeDay) {
                            return `Tidak ada jadwal untuk hari ${this.activeDay}`;
                        } else if (this.activeProdi) {
                            return 'Tidak ada jadwal untuk program studi terpilih';
                        } else if (this.activeKelas) {
                            return `Tidak ada jadwal untuk kelas ${this.activeKelas}`;
                        }
                        return 'Tidak ada jadwal yang tersedia';
                    }
                }
            }
        </script>
    </x-slot:content>
</x-template>