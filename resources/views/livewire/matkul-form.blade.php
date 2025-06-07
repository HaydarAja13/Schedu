<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/mata-kuliah">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Data Mata Kuliah</h1>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                {{ $isEdit ? 'Edit Data Mata Kuliah' : 'Tambah Data Mata Kuliah' }}
            </h2>

            <form wire:submit.prevent="save">
                <!-- Kode Mata Kuliah -->
                <div class="mb-4">
                    <label for="kode_matkul" class="block text-sm font-medium text-gray-700 mb-1">Kode Mata Kuliah*</label>
                    <input wire:model="kode_matkul" type="text" id="kode_matkul" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('kode_matkul') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Nama Mata Kuliah -->
                <div class="mb-4">
                    <label for="nama_matkul" class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah*</label>
                    <input wire:model="nama_matkul" type="text" id="nama_matkul" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('nama_matkul') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- SKS -->
                <div class="mb-4">
                    <label for="sks" class="block text-sm font-medium text-gray-700 mb-1">SKS*</label>
                    <input wire:model="sks" type="number" id="sks" min="1" max="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('sks') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Jam -->
                <div class="mb-4">
                    <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam*</label>
                    <input wire:model="jam" type="number" id="jam" min="1" max="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('jam') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Semester -->
                <div class="mb-4">
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester*</label>
                    <input wire:model="semester" type="number" id="semester" min="1" max="8"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('semester') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Ruang -->
                <div class="mb-4">
                    <label for="id_ruang" class="block text-sm font-medium text-gray-700 mb-1">Ruang*</label>
                    <select wire:model="id_ruang" id="id_ruang" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Ruang</option>
                        @foreach($ruangOptions as $ruang)
                            <option value="{{ $ruang->id }}">{{ $ruang->nama_ruang }}</option>
                        @endforeach
                    </select>
                    @error('id_ruang') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Jenis -->
                <div class="mb-6">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis*</label>
                    <select wire:model="jenis" id="jenis" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Jenis</option>
                        @foreach($jenisOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('jenis') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.mata-kuliah') }}" 
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