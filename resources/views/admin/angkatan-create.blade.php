<x-template :role="'admin'" :title="'Tambah Angkatan Baru'">
    <x-slot:content>
        <p class="my-2">Tambah angkatan baru</p>
        <div class="bg-white rounded-xl h-auto mb-4 p-8">
            <form action="{{ route('angkatan.store') }}" method="POST">
                @csrf
                {{-- <x-form.input :label="'Tahun Angkatan'" :description="'Masukkan tahun angkatan'" :placeholder="'Contoh: 1'" name="tahun_angkatan" id="tahun_angkatan" /> --}}
                <div>
                    <label for="tahun_angkatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Ruang<span class="text-red-500">*</span></label>
                    <input type="text" id="tahun_angkatan" name="tahun_angkatan" placeholder="cth: Angkatan 1" maxlength="50" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>
                <div class="flex justify-end items-center gap-x-4 mt-4">
                    <a class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                        href="/admin/angkatan">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Batal</p>
                        </div>
                    </a>
                    <button
                        class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white shadow-sm"
                        type="submit">
                        <div class="flex items-center justify-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Simpan</p>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>