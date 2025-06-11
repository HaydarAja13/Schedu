<x-template :role="'admin'" title="Tambah Mahsiswa">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2">
                        <div class="grid grid-cols-1 items-center gap-y-4">
                            <p class="text-base font-medium">Atur Foto Profil</p>
                            <div x-data="{ 
                                                            imagePreview: null,
                                                            handleFileSelect(event) {
                                                                const file = event.target.files[0];
                                                                if (file) {
                                                                    const reader = new FileReader();
                                                                    reader.onload = (e) => {
                                                                        this.imagePreview = e.target.result;
                                                                    };
                                                                    reader.readAsDataURL(file);
                                                                }
                                                            }
                                                        }">
                                <label for="File"
                                    class="rounded-full size-20 md:size-28 hover:cursor-pointer flex justify-center items-center overflow-hidden"
                                    :class="imagePreview ? '' : 'bg-gray-200'"
                                    :style="imagePreview ? `background-image: url(${imagePreview}); background-size: cover; background-position: center;` : ''">

                                    <!-- Icon hanya muncul jika belum ada gambar -->
                                    <svg x-show="!imagePreview" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>

                                    <input multiple type="file" id="File" class="sr-only" name="foto_profil"
                                        accept="image/*" required @change="handleFileSelect($event)" />
                                </label>
                            </div>
                            <ul class="text-xs text-gray-400 list-disc pl-4">
                                <li>Resolusi: maksimal 2000 x 2000px</li>
                                <li>Maks. ukuran file 2.0 MB</li>
                                <li>Format foto yang diizinkan: JPG, JPEG, PNG</li>
                            </ul>
                        </div>
                        <div class="col-span-2 pt-8 gap-y-4 grid h-fit">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-72">
                                    <label class=" whitespace-nowrap  text-sm md:text-base">Nama Mahasiswa <span
                                            class="text-red-500">*</span></label>
                                    <p class="text-xs text-gray-400">Masukan Nama Lengkap Mahasiswa</p>
                                </div>
                                <input type="text" name="nama_mahasiswa" required placeholder="cth: Pradodo Wibowo"
                                    class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-72">
                                    <label class="whitespace-nowrap  text-sm md:text-base">NIM <span
                                            class="text-red-500">*</span></label>
                                    <p class="text-xs text-gray-400">Masukan Nomor Induk Mahasiswa</p>
                                </div>
                                <input type="text" name="nim" required placeholder="cth: 4.33.23.0.12"
                                    class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-y-4 mt-4 md:mt-8">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap  text-sm md:text-base">Email <span
                                        class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Masukan Email</p>
                            </div>
                            <input type="email" name="email" required placeholder="cth: mahasiswa@gmail.com"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap  text-sm md:text-base">Password <span
                                        class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Kata sandi terdiri dari minimal 8 karakter, berisi
                                    angka, huruf & simbol</p>
                            </div>
                            <input type="password" name="password" required
                                class="w-full rounded-md px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                placeholder="••••••••" />
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap  text-sm md:text-base">Nomor Telepon <span
                                        class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Masukan Nomor Telepon</p>
                            </div>
                            <input type="number" name="no_hp" required placeholder="cth: 08123456789"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        </div>
                        <x-form.button-group page="mahasiswa" />
                    </div>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>