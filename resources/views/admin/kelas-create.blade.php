<x-template :role="'admin'" title="Tambah Kelas ">
    <x-slot:content>
        <div class="overflow-scroll h-[calc(100vh-200px)]">
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="mt-4 bg-white rounded-lg p-8">
                    <div class="grid grid-cols-1 items-center md:grid-cols-3 gap-4 mb-4">
                        <div class="w-72">
                            <label class=" whitespace-nowrap text-sm md:text-base">Nama Kelas <span
                                    class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400">Masukan Nama Kelas</p>
                        </div>
                        <input type="text" name="nama_kelas" required placeholder="cth: A"
                            class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
                    </div>
                    <x-form.button-group page="kelas" />
                </div>
            </form>

        </div>
    </x-slot:content>
</x-template>