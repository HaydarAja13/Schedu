<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/ruang">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Tambah Data Ruang</h1>
            </div>
        </div>

        <div class="bg-white px-8 pt-8 pb-6 rounded-xl shadow-lg">
            <form action="{{ route('ruang.store') }}" method="POST">
                @csrf
                <div class="space-y-6 w-full max-w-md">
                    <!-- Nama Ruang -->
                    <div>
                        <label for="nama_ruang" class="block text-sm font-medium text-gray-700 mb-1">Nama Ruang<span class="text-red-500">*</span></label>
                        <input type="text" id="nama_ruang" name="nama_ruang" placeholder="cth: Ruang A" maxlength="50" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan<span class="text-red-500">*</span></label>
                        <select id="keterangan" name="keterangan" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="" disabled selected>Pilih Keterangan</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger text-red-700 mt-4 w-full max-w-md">
                        <ul class="text-xs font-light">
                            @foreach ($errors->all() as $error)
                                <li class="whitespace-normal break-words">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-6 flex justify-end gap-8">
                    <a href="/admin/ruang" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 shadow-sm">Batal</a>
                    <button type="submit" class="bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Buat</button>
                </div>
            </form>
        </div>
    </x-slot>

    <x-slot name="content">
        {{-- Alert Modal jika ada --}}
        @if (session('alert'))
            <x-alert :type="session('alert.type')" :titleModal="session('alert.titleModal')" :contentModal="session('alert.contentModal')" />
        @endif

    </x-slot>
</x-template>
