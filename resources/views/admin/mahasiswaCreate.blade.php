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
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Buat Data Mahasiswa</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <form action="/admin/mahasiswa" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid-cols-1 md:grid-cols-2">
                    <!-- Kolom I -->
                    <div class="flex">
                        <div class="flex flex-col">
                            <div class="relative w-32 h-32 border-2 border-indigo-300 rounded-full overflow-hidden flex items-center justify-center bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm10 3a2 2 0 11-4 0 2 2 0 014 0zM4 15h12v-1.586l-3.293-3.293a1 1 0 00-1.414 0L8 13l-2.293-2.293a1 1 0 00-1.414 0L4 11.586V15z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            
                            <div class="form-group">
                                <input type="file" name="foto" accept="image/jpeg,image/png" class="mt-3 text-sm text-gray-600" />
                                @if ($errors->any())
                                    <div class="alert alert-danger text-red-700">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            

                            <ul class="text-xs text-gray-500 mt-2 space-y-1 mb-4">
                                <li>• Maksimal 2000 × 2000px</li>
                                <li>• Maks. ukuran file 2.0 MB</li>
                                <li>• Format: JPG, JPEG, PNG</li>
                            </ul>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap<span class="text-red-500">*</span></label>
                                <input type="text" name="nama_mahasiswa" placeholder="Nama lengkap" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIM<span class="text-red-500">*</span></label>
                                <input type="text" name="nim" placeholder="43323019" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom II -->
                    <div class="space-y-2 mt-6 md:mt-0">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email<span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="contoh@gmail.com" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password<span class="text-red-500">*</span></label>
                            <input type="password" name="password" placeholder="password" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter, berisi angka, huruf & simbol</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon<span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp" placeholder="081234567809" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="mt-5 flex justify-end gap-8">
                    <a href="/mahasiswa" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 shadow-sm">Batal</a>
                    <button type="submit" class="bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Buat</button>
                </div>
            </form>
        </div>
    </x-slot>
    <x-slot name="content">
    </x-slot>
</x-template>