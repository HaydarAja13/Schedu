<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/mahasiswa">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Edit Data Mahasiswa</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white px-8 pt-8 pb-6 rounded-xl shadow-lg">
            <form action="{{ route('admin.mahasiswa.update.submit', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex">
                    <div class=" flex gap-14 w-full space-y-10">
                    <!-- Kolom I -->
                        <div class="flex gap-10 space-y-10">
                            <div class="flex-col gap-5">
                                <div class="flex gap-6">
                                    <div class="relative w-32 h-32 border-2 border-indigo-300 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 mb-2">
                                        @if($mahasiswa->foto)
                                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil" class="object-cover w-full h-full">
                                        @else
                                            @php
                                                $initials = collect(explode(' ', $mahasiswa->nama_mahasiswa ?? ''))
                                                    ->filter(fn($n) => !empty($n))
                                                    ->map(fn($n) => strtoupper($n[0]))
                                                    ->take(2)
                                                    ->implode('');
                                            @endphp
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white font-bold text-4xl">
                                                {{ $initials }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center w-36">
                                        <ul class="text-xs italic text-gray-500 mt-2 space-y-1 mb-4">
                                            <li class="font-bold font-xl">Upload Foto Profil</li>
                                            <li>• Maksimal 2000 × 2000px</li>
                                            <li>• Maks. ukuran file 2.0 MB</li>
                                            <li>• Format: JPG, JPEG, PNG</li>
                                        </ul>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <div class="relative flex items-center mt-3 border border-gray-300 rounded-md overflow-hidden">
                                        <label for="foto" class="bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white px-4 py-2 cursor-pointer text-sm">
                                            Pilih File
                                        </label>
                                        <span class="px-3 text-sm text-gray-500 truncate" id="file-name">Tidak ada file dipilih</span>
                                        <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/jpg" class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih'" />
                                    </div>
                                </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger text-red-700 mt-3 w-full max-w-md">
                                                <ul class="text-xs font-light">
                                                    @foreach ($errors->all() as $error)
                                                        <li class="whitespace-normal break-words">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            <div class="space-y-6 w-full">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap<span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_mahasiswa" placeholder="Nama lengkap" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIM<span class="text-red-500">*</span></label>
                                    <input type="text" name="nim" placeholder="43323019" value="{{ old('nim', $mahasiswa->nim) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>                                </div>
                            </div>
                        </div>
                     </div>

                    <!-- Kolom II -->
                    <div class="space-y-4 mt-10 md:mt-0">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email<span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email', $mahasiswa->email) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password<span class="text-red-500">*</span></label>
                            <input type="password" name="password" placeholder="password" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter, berisi angka, huruf & simbol</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon<span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp" placeholder="081234567809" value="{{ old('no_hp', $mahasiswa->no_hp) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                    </div>
                

                <!-- Tombol -->
                <div class="mt-6 flex justify-end gap-8">
                    <a href="/admin/mahasiswa" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 shadow-sm">Batal</a>
                    <button type="submit" class="bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Buat</button>
                </div>
            </div>
            </form>
        </div>
    </x-slot>
    <x-slot name="content">
    </x-slot>
</x-template>