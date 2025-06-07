<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/program-studi">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Data Program Studi</h1>
            </div>
        </div>

            <div class="p-6 bg-white rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    {{ $isEdit ? 'Edit Data Prodi' : 'Tambah Data Prodi' }}
                </h2>

                <form wire:submit.prevent="save">
                    <!-- Kode Prodi -->
                    <div class="mb-4">
                        <label for="kode_prodi" class="block text-sm font-medium text-gray-700 mb-1">Kode Prodi*</label>
                        <input wire:model="kode_prodi" type="text" id="kode_prodi" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('kode_prodi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Nama Prodi -->
                    <div class="mb-4">
                        <label for="nama_prodi" class="block text-sm font-medium text-gray-700 mb-1">Nama Prodi*</label>
                        <input wire:model="nama_prodi" type="text" id="nama_prodi" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('nama_prodi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-6">
                        <label for="id_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan*</label>
                        <select wire:model="id_jurusan" id="id_jurusan" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusanOptions as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('id_jurusan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.program-studi') }}" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            {{ $isEdit ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>

        </x-slot>
    <x-slot name="content">
    </x-slot>
</x-template>
