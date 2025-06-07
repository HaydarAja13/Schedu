<x-template :role="'admin'" title="Edit Profile">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="" method="POST">
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2">
                        <div class="grid grid-cols-1 items-center gap-y-4">
                            <p class="text-base font-medium">Atur Foto Profil</p>
                            <label for="File"
                                class="rounded-full size-28 bg-gray-200 hover:cursor-pointer flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                                <input multiple type="file" id="File" class="sr-only" />
                            </label>
                            <ul class="text-xs text-gray-400 list-disc pl-4">
                                <li>Resolusi: maksimal 2000 x 2000px</li>
                                <li>Maks. ukuran file 2.0 MB</li>
                                <li>Format foto yang diizinkan: JPG, JPEG, PNG</li>
                            </ul>
                        </div>
                        <div class="col-span-2 pt-8 gap-y-4 grid h-fit">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-72">
                                    <label class=" whitespace-nowrap">Nama Admin <span
                                            class="text-red-500">*</span></label>
                                    <p class="text-xs text-gray-400">Masukan Nama Lengkap Admin</p>
                                </div>
                                <input type="text"
                                    class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                    value="{{ $user->nama_admin }}" />
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-72">
                                    <label class="whitespace-nowrap">NIP <span class="text-red-500">*</span></label>
                                    <p class="text-xs text-gray-400">Masukan Nomor Induk Pegawai</p>
                                </div>
                                <input type="text"
                                    class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                    value="{{ $user->nip }}" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-y-4 mt-4 md:mt-8">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap">Email <span class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Masukan Email</p>
                            </div>
                            <input type="email"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                value="{{ $user->email }}" />
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap">Password Baru</label>
                                <p class="text-xs text-gray-400">Kata sandi terdiri dari minimal 8 karakter, berisi angka, huruf & simbol</p>
                            </div>
                            <input type="password" name="password"
                                class="w-full rounded-md px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                placeholder="Password baru (opsional)" />
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="w-72">
                                <label class="whitespace-nowrap">Nomor Telepon <span
                                        class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-400">Masukan Nomor Telepon</p>
                            </div>
                            <input type="number"
                                class="w-full rounded-md  px-3 py-1.5 text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
                                value="{{ $user->no_hp }}" />
                        </div>
                        <div class="flex justify-end items-center gap-x-4">
                            <a class="inline-block rounded-lg px-6 py-2 text-sm font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                                href="/admin/profile">
                                <div class="flex items-center justify-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p>Simpan</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>