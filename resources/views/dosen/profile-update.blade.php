<x-template :role="'dosen'" title="Edit dosen">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('dosen.profile.update' , $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2">
                        <div class="grid grid-cols-1 items-center gap-y-4">
                            <p class="text-base font-medium">Atur Foto Profil</p>
                            <div x-data="{ 
                                                            imagePreview: null,
                                                            originalImage: '{{ $dosen->foto_profil ? asset('storage/' . $dosen->foto_profil) : 'https://placehold.co/400' }}',
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
                                        value="{{ $dosen->foto_profil }}" />
                                </label>
                            </div>
                            <ul class="text-xs text-gray-400 list-disc pl-4">
                                <li>Resolusi: maksimal 2000 x 2000px</li>
                                <li>Maks. ukuran file 2.0 MB</li>
                                <li>Format foto yang diizinkan: JPG, JPEG, PNG</li>
                            </ul>
                        </div>

                    </div>
                    <div class="grid grid-cols-1 gap-y-4 mt-4 md:mt-8">
                        <div class="flex justify-end items-center gap-x-4">
                            <a class="inline-block rounded-lg px-5 py-2 text-xs font-medium bg-[#F7F7FF] text-gray-500 shadow-sm"
                                href="/dosen/profile">
                                <div class="flex items-center justify-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p>Batal</p>
                                </div>
                            </a>
                            <button
                                class="inline-block rounded-lg px-5 py-2 text-xs font-medium bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] text-white shadow-sm"
                                type="submit">
                                <div class="flex items-center justify-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
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