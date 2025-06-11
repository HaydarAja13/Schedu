<x-template :role="'admin'" title="Edit Mahsiswa">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('mahasiswa.update' , $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2">
                        <div class="grid grid-cols-1 items-center gap-y-4">
                            <p class="text-base font-medium">Atur Foto Profil</p>
                            <div x-data="{ 
                                                            imagePreview: null,
                                                            originalImage: '{{ $mahasiswa->foto_profil ? asset('storage/' . $mahasiswa->foto_profil) : 'https://placehold.co/400' }}',
                                                            handleFileSelect(event) {
                                                                const file = event.target.files[0];
                                                                if (file) {
                                                                    const reader = new FileReader();
                                                                    reader.onload = (e) => {
                                                                        this.imagePreview = e.target.result;
                                                                    };
                                                                    reader.readAsDataURL(file);
                                                                }
                                                            },
                                                            getCurrentImage() {
                                                                return this.imagePreview || this.originalImage;
                                                            }
                                                        }">
                                <label for="File"
                                    class="rounded-full size-20 md:size-28 hover:cursor-pointer flex justify-center items-center bg-no-repeat bg-center bg-cover overflow-hidden"
                                    :style="`background-image: url('${getCurrentImage()}');`">

                                    <input multiple type="file" id="File" class="sr-only" name="foto_profil"
                                        accept="image/*" @change="handleFileSelect($event)"
                                        value="{{ $mahasiswa->foto_profil }}" />
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
                                <input type="text" name="nama_mahasiswa" required
                                    value="{{ $mahasiswa->nama_mahasiswa }}"
                                    class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-72">
                                    <label class="whitespace-nowrap  text-sm md:text-base">NIM <span
                                            class="text-red-500">*</span></label>
                                    <p class="text-xs text-gray-400">Masukan Nomor Induk Mahasiswa</p>
                                </div>
                                <input type="text" name="nim" required value="{{ $mahasiswa->nim }}"
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
                            <input type="email" name="email" required value="{{ $mahasiswa->email }}"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap  text-sm md:text-base">Password Baru</label>
                                <p class="text-xs text-gray-400">Kata sandi terdiri dari minimal 8 karakter, berisi
                                    angka, huruf & simbol</p>
                            </div>
                            <input type="password" name="password" placeholder="Password baru (opsional)"
                                class="w-full rounded-md px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                placeholder="••••••••" />
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap  text-sm md:text-base">Nomor Telepon <span
                                        class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Masukan Nomor Telepon</p>
                            </div>
                            <input type="number" name="no_hp" required value="{{ $mahasiswa->no_hp }}"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                        </div>
                        <x-form.button-group page="mahasiswa" />
                    </div>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>