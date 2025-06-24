<x-template :role="'mahasiswa'" title="Edit Profile Mahasiswa">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('mahasiswa.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-4 bg-white rounded-lg p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2">
                        <div class="grid grid-cols-1 items-center gap-y-4">
                            <p class="text-base font-medium">Atur Foto Profil</p>
                            <div x-data="{ 
                                imagePreview: null,
                                originalImage: '{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : 'https://placehold.co/100' }}',
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
                                        value="{{ $user->foto_profil }}" />
                                </label>
                            </div>
                            <ul class="text-xs text-gray-400 list-disc pl-4">
                                <li>Resolusi: maksimal 2000 x 2000px</li>
                                <li>Maks. ukuran file 2.0 MB</li>
                                <li>Format foto yang diizinkan: JPG, JPEG, PNG</li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                            Simpan
                        </button>
                        <a href="/mahasiswa/profile"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-200">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-template>
