<x-template :role="'admin'" title="Generate Jadwal ">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('schedule.generate') }}" method="POST">
                @csrf
                <div class="mt-4 bg-white rounded-lg p-8">
                    <x-form.select :label="'Kelompok Program Studi'" :description="'Pilih kelompok program studi'" :placeholder="'Pilih'"
                        :options="$kelompokProdi" valueField="id" displayField="nama_kelompok_prodi" id="id_kelompok_prodi"
                        name="id_kelompok_prodi" />
                    <div class="flex justify-end items-center gap-x-4">
                        <a class="inline-block rounded-lg px-5 py-2 text-xs font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                            href="schedule-detail">
                            <div class="flex items-center justify-center gap-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p>Batal</p>
                            </div>
                        </a>
                        <button
                            class="inline-block rounded-lg px-5 py-2 text-xs font-medium bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white shadow-sm"
                            type="submit">
                            <div class="flex items-center justify-center gap-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p>Generate</p>
                            </div>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </x-slot:content>
</x-template>