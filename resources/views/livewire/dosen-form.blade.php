<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="{{ route('admin.dosen') }}">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">
                    {{ $isEdit ? 'Edit Data Dosen' : 'Tambah Data Dosen' }}
                </h1>
            </div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="p-6 bg-white rounded-xl shadow-md">
            <form wire:submit.prevent="save">
                <!-- Nama Dosen -->
                <div class="mb-4">
                    <label for="nama_dosen" class="block text-sm font-medium text-gray-700 mb-1">Nama Dosen*</label>
                    <input wire:model="nama_dosen" type="text" id="nama_dosen" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('nama_dosen') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- NIP -->
                <div class="mb-4">
                    <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP*</label>
                    <input wire:model="nip" type="text" id="nip" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('nip') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                    <input wire:model="email" type="email" id="email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Nomor HP -->
                <div class="mb-4">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP*</label>
                    <input wire:model="no_hp" type="text" id="no_hp" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('no_hp') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $isEdit ? 'Password (Biarkan kosong jika tidak ingin mengubah)' : 'Password*' }}
                    </label>
                    <input wire:model="password" type="password" id="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Password Confirmation -->
                @if(!$isEdit || $password)
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password*</label>
                    <input wire:model="password_confirmation" type="password" id="password_confirmation" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('password_confirmation') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.dosen') }}" 
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
</x-template>